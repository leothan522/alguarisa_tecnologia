<?php

namespace App\Livewire\Dashboard;

use App\Models\Municipio;
use App\Models\Parroquia;
use App\Traits\LimitRows;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class TerritorioComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;

    public int $limitMunicipios = 0, $limitParroquias = 0;
    public bool $btnDisabledMunicipios = false, $btnDisabledParroquias = false;
    public bool $verMunicipios = true, $verParroquias = false;
    public $keywordMunicipios, $keywordParroquias, $idMunicipio, $verMunicipio;
    public bool $verToast = false;
    public $nombreMunicipio, $miniMunicipio, $familiasMunicipio, $cantidadParroquias;
    public $municipioParroquia, $nombreParroquia, $miniParroquia, $familiasParroquia;

    #[Locked]
    public $municipios_id, $parroquias_id, $rowquid, $estatus;

    public function mount()
    {
        $this->setLimit(['limitMunicipios', 'limitParroquias']);
        $this->setSize(334);
    }

    public function render()
    {
        $municipios = Municipio::buscar($this->keywordMunicipios)
            ->orderBy('nombre', 'ASC')
            ->limit($this->limitMunicipios)
            ->get();
        $rowsMunicipios = Municipio::buscar($this->keywordMunicipios)->count();
        $limit = $municipios->count();
        $this->btnVerMas($limit, $rowsMunicipios, ['btnDisabledMunicipios']);

        $parroquias = Parroquia::buscar($this->keywordParroquias, $this->idMunicipio)
            ->orderBy('nombre', 'ASC')
            ->limit($this->limitParroquias)
            ->get();
        $rowsParroquias = Parroquia::buscar($this->keywordParroquias, $this->idMunicipio)->count();
        $limit = $parroquias->count();
        $this->btnVerMas($limit, $rowsParroquias, ['btnDisabledParroquias']);

        return view('livewire.dashboard.territorio-component')
            ->with('listarMunicipios', $municipios)
            ->with('rowsMunicipios', $rowsMunicipios)
            ->with('listarParroquias', $parroquias)
            ->with('rowsParroquias', $rowsParroquias);
    }

    public function limpiar()
    {
        $this->reset([
            'verToast',
            'nombreMunicipio', 'miniMunicipio', 'familiasMunicipio', 'cantidadParroquias',
            'municipioParroquia', 'nombreParroquia', 'miniParroquia', 'familiasParroquia',
            'municipios_id', 'parroquias_id', 'rowquid', 'estatus'
        ]);
        $this->resetErrorBag();
    }

    public function saveMunicipios()
    {
        $rules = [
            'nombreMunicipio' => ['required', 'min:4', Rule::unique('municipios', 'nombre')->ignore($this->municipios_id)],
            'miniMunicipio' => ['required', 'min:4', Rule::unique('municipios', 'mini')->ignore($this->municipios_id)],
            'familiasMunicipio' => 'required|integer'
        ];
        $messages = [
            'nombreMunicipio.required' => 'El nombre del municipio es obligatorio.',
            'nombreMunicipio.min' => 'El nombre del municipio debe contener al menos 4 caracteres.',
            'nombreMunicipio.unique' => 'El nombre del municipio ya ha sido registrado.',
            'miniMunicipio.required' => 'La abreviatura del municipio es obligatoria.',
            'miniMunicipio.min' => 'La abreviatura del municipio debe contener al menos 4 caracteres.',
            'miniMunicipio.unique' => 'La abreviatura del municipio ya ha sido registrada.',
            'familiasMunicipio.required' => 'El nro. de familias del municipio es obligatorio.',
            'familiasMunicipio.integer' => 'El nro. de familias del municipio debe ser un número entero.',
        ];
        $this->validate($rules, $messages);

        if ($this->municipios_id){
            //editar
            $municipio = Municipio::find($this->municipios_id);
        }else{
            //nuevo
            $municipio = new Municipio();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Municipio::where('rowquid', $rowquid)->first();
            }while($existe);
            $municipio->rowquid = $rowquid;
        }

        if ($municipio){
            $municipio->nombre = $this->nombreMunicipio;
            $municipio->mini = $this->miniMunicipio;
            $municipio->familias = $this->familiasMunicipio;
            $municipio->save();
            $this->verToast = true;
            $this->dispatch('cerrarModalMunicipios');
        }

    }

    public function saveParroquias()
    {
        //primera Validacion
        $rules = [
            'municipioParroquia' => 'required',
            'nombreParroquia' => ['required', 'min:4', Rule::unique('parroquias', 'nombre')->ignore($this->parroquias_id)],
            'miniParroquia' => ['nullable', 'min:4', Rule::unique('parroquias', 'mini')->ignore($this->parroquias_id)],
            'familiasParroquia' => 'required|integer',
        ];
        $messages = [
            'municipioParroquia.required' => 'El municipio es obligatorio.',
            'nombreParroquia.required' => 'El nombre de la parroquia es obligatorio.',
            'nombreParroquia.min' => 'El nombre de la parroquia debe contener al menos 4 caracteres.',
            'nombreParroquia.unique' => 'El nombre de la parroquia ya ha sido registrado.',
            'miniParroquia.required' => 'La abreviatura de la parroquia es obligatoria.',
            'miniParroquia.min' => 'La abreviatura de la parroquia debe contener al menos 4 caracteres.',
            'miniParroquia.unique' => 'La abreviatura de la parroquia ya ha sido registrada.',
            'familiasParroquia.required' => 'El nro. de familias de la parroquia es obligatorio.',
            'familiasParroquia.integer' => 'El nro. de familias de la parroquia debe ser un número entero.',
        ];
        $this->validate($rules, $messages);

        //segunda validacion
        $max = 0;
        $municipio = $this->getMunicipio($this->municipioParroquia);
        if ($municipio){
            $actual = Parroquia::where('municipios_id', $municipio->id)
                ->where('id', '!=', $this->parroquias_id)
                ->sum('familias');
            if (!is_null($municipio->familias)){
                $max = $municipio->familias - $actual;
            }
        }

        $rules = [
            'familiasParroquia' => 'integer|max:' . $max,
        ];
        $messages = [
            'familiasParroquia.max' => 'El nro. de familias de las parroquias no debe ser mayor a la del municipio.',
        ];
        $this->validate($rules, $messages);

        //Procesamos

        if ($this->parroquias_id){
            //editar
            $parroquia = Parroquia::find($this->parroquias_id);
            $editar = true;
        }else{
            $parroquia = new Parroquia();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Parroquia::where('rowquid', $rowquid)->first();
            }while($existe);
            $parroquia->rowquid = $rowquid;
            $editar = false;
        }

        if ($parroquia){

            if ($editar){
                if ($parroquia->municipios_id != $municipio->id){
                    $anterior = Municipio::find($parroquia->municipios_id);
                    $anterior->parroquias = $anterior->parroquias - 1;
                    $anterior->save();
                    $municipio->parroquias = $municipio->parroquias + 1;
                    $municipio->save();
                }
            }else{
                $municipio->parroquias = $municipio->parroquias + 1;
                $municipio->save();
            }

            $parroquia->nombre = $this->nombreParroquia;
            $parroquia->mini = $this->miniParroquia;
            $parroquia->familias = $this->familiasParroquia;
            $parroquia->municipios_id = $municipio->id;
            $parroquia->save();

            $this->verToast = true;
            $this->dispatch('cerrarModalParroquias');
        }

    }

    public function editMunicipios($rowquid)
    {
        $this->limpiar();
        $municipio = $this->getMunicipio($rowquid);
        if ($municipio){

            $this->municipios_id = $municipio->id;
            $this->nombreMunicipio = $municipio->nombre;
            $this->miniMunicipio = $municipio->mini;
            $this->familiasMunicipio = $municipio->familias;
            $this->cantidadParroquias = $municipio->parroquias;
            $this->rowquid = $municipio->rowquid;
            $this->estatus = $municipio->estatus;

        }else{
            $this->dispatch('cerrarModalMunicipios');
        }
    }

    public function editParroquias($rowquid)
    {
        $this->formParroquias();
        $parroquia = $this->getParroquia($rowquid);
        if ($parroquia){
            $this->dispatch('setSelectMunicipio', rowquid: $parroquia->municipio->rowquid);
            $this->parroquias_id = $parroquia->id;
            $this->nombreParroquia = $parroquia->nombre;
            $this->miniParroquia = $parroquia->mini;
            $this->familiasParroquia = $parroquia->familias;
            $this->rowquid = $parroquia->rowquid;
            $this->estatus = $parroquia->estatus;
            $this->miniMunicipio = $parroquia->municipio->mini;
        }else{
            $this->dispatch('cerrarModalParroquias');
        }
    }

    public function setLimitMunicipios()
    {
        $this->setLimit(['limitMunicipios']);
    }

    public function setLimitParroquias()
    {
        $this->setLimit(['limitParroquias']);
    }

    public function setEstatusMunicipio($rowquid)
    {
        $this->setEstatus($rowquid);
    }

    public function setEstatusParroquia($rowquid)
    {
        $this->setEstatus($rowquid, true);
    }

    #[On('destroyMunicipio')]
    public function destroyMunicipio($rowquid)
    {
        $this->delete($rowquid);
    }

    #[On('destroyParroquia')]
    public function destroyParroquia($rowquid)
    {
        $this->delete($rowquid, true);
    }

    #[On('buscar')]
    public function buscar($keyword)
    {
        $this->keywordMunicipios = $keyword;
        $this->keywordParroquias = $keyword;
        $this->reset('idMunicipio');
    }

    public function filtrar($rowquid)
    {
        $municipio = $this->getMunicipio($rowquid);
        if ($municipio){
            $this->idMunicipio = $municipio->id;
            $this->verMunicipio = $municipio->mini;
        }
    }

    public function formParroquias()
    {
        $this->limpiar();
        $rows = Municipio::orderBy('nombre', 'ASC')->get();
        $municipios = getDataSelect2($rows, 'nombre');
        $this->dispatch('initSelectMunicipios', data: $municipios);
    }

    public function cerrarBusquedaMunicipios()
    {
        $this->reset(['keywordMunicipios']);
    }

    public function cerrarBusquedaParroquias()
    {
        $this->reset(['keywordParroquias', 'idMunicipio', 'verMunicipio']);
    }

    #[On('cerrarModalMunicipios')]
    public function cerrarModalMunicipios()
    {
        if ($this->verToast){
            $this->toastBootstrap();
        }
    }

    #[On('cerrarModalParroquias')]
    public function cerrarModalParroquias()
    {
        if ($this->verToast){
            $this->toastBootstrap();
        }
    }

    #[On('verTabla')]
    public function verTabla($tabla = "parroquia")
    {
        if ($tabla == "parroquia"){
            $this->verMunicipios = false;
            $this->verParroquias = true;
        }else{
            $this->verMunicipios = true;
            $this->verParroquias = false;
        }
    }

    public function actualizar()
    {
        //refresh
    }

    #[On('initSelectMunicipios')]
    public function initSelectMunicipios($data)
    {
        //JS
    }

    #[On('getSelectMunicipios')]
    public function getSelectMunicipios($rowquid)
    {
        $this->municipioParroquia = $rowquid;
    }

    #[On('setSelectMunicipio')]
    public function setSelectMunicipio($rowquid)
    {
        //JS
    }

    protected function delete($rowquid, $parroquia = false)
    {
        if (!$parroquia){
            $row = $this->getMunicipio($rowquid);
            $id = null;
            $title = "Municipio";
        }else{
            $row = $this->getParroquia($rowquid);
            $id = $row->municipios_id;
            $title = "Parroquia";
        }

        if ($row){
            $nombre = '<b class="text-warning text-uppercase">'.$row->nombre.'</b>';
            $row->delete();
            if ($id){
                $municipio = Municipio::find($id);
                if ($municipio){
                    $municipio->parroquias = $municipio->parroquias - 1;
                    $municipio->save();
                }
            }
            $this->toastBootstrap('success', "$title $nombre Eliminado.");
        }
    }

    protected function setEstatus($rowquid, $parroquia = false)
    {
        if (!$parroquia){
            //municipio
            $row = $this->getMunicipio($rowquid);
            $title = "Municipio";
        }else{
            //parroquia
            $row = $this->getParroquia($rowquid);
            $title = "Parroquia";
        }

        if ($row){
            $nombre = '<b class="text-warning text-uppercase">'.$row->nombre.'</b>';
            $estatus = $row->estatus;
            if ($estatus){
                $row->estatus = 0;
                $type = "info";
                $message = "$title $nombre Inactivo.";
            }else{
                $row->estatus = 1;
                $type = "success";
                $message = "$title $nombre Activo.";
            }
            $row->save();
            $this->toastBootstrap($type, $message);
            $this->estatus = $row->estatus;
        }

    }

    protected function getMunicipio($rowquid): ?Municipio
    {
        return Municipio::where('rowquid', $rowquid)->first();
    }

    protected function getParroquia($rowquid): ?Parroquia
    {
        return Parroquia::where("rowquid", $rowquid)->first();
    }

}
