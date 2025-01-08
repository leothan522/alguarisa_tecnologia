<?php

namespace App\Livewire\Dashboard;

use App\Models\Institucion;
use App\Models\Oficio;
use App\Models\Persona;
use App\Traits\LimitRows;
use App\Traits\ModalTable;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\On;
use Livewire\Component;

class PersonasComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;
    use ModalTable;

    public $nombre, $prefijo, $cargo, $instituciones_id, $sexo;

    public function mount()
    {
        $this->setLimit();
        $this->setSize(330);
        $this->modalTitle = "Personas";
        $this->confirmed = 'deletePersonas';
        $this->modulo = 'personas';
    }

    public function render()
    {

        $listar = Persona::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();
        $limit = $listar->count();
        $rows = Persona::buscar($this->keyword)->count();
        $this->btnVerMas($limit, $rows);

        return view('livewire.dashboard.personas-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->limpiarModal();
        $this->reset([
            'nombre', 'prefijo', 'cargo', 'instituciones_id', 'sexo',
        ]);
        $this->resetErrorBag();
        $this->dispatch('personasSelectInstituciones', data: $this->getInstituciones());
    }

    public function save()
    {
        $rules = [
            'nombre' => ['required', 'min:2', 'max:50'/*, Rule::unique('oficios_personas', 'nombre')->ignore($this->personas_id)*/],
            'prefijo' => 'nullable|min:2|max:50',
            'cargo' => 'nullable|min:2|max:50',
            'sexo' => 'required',
        ];

        $this->validate($rules);

        if ($this->tabla_id){
            //editar
            $model = Persona::find($this->tabla_id);
        }else{
            //nuevo
            $model = new Persona();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Persona::where('rowquid', $rowquid)->first();
            }while($existe);
            $model->rowquid = $rowquid;
        }

        if ($model){
            $model->nombre = $this->nombre;
            $model->prefijo = $this->prefijo;
            $model->cargo = $this->cargo;
            $model->instituciones_id = $this->instituciones_id;
            $model->sexo = $this->sexo;
            $model->save();
            $this->dispatch('initSelectsForm')->to(OficiosComponent::class);
            $this->limpiar();
            $this->toastBootstrap();
        }
    }

    public function edit($rowquid)
    {
        $this->limpiar();
        $registro = $this->getRegistro($rowquid);
        if ($registro) {
            $this->tabla_id = $registro->id;
            $this->ocultarTable = true;
            $this->ocultarCard = false;
            $this->nombre = $registro->nombre;
            $this->prefijo = $registro->prefijo;
            $this->cargo = $registro->cargo;
            $this->sexo = $registro->sexo;
            $this->rowquid = $registro->rowquid;
            $this->dispatch('setPersonasSelectInstituciones', rowquid: $registro->institucion->rowquid ?? '');
        }
    }

    #[On('deletePersonas')]
    public function delete($rowquid)
    {
        $this->limpiar();
        $registro = $this->getRegistro($rowquid);
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            $oficio = Oficio::where('dirigido', 'like', "%$registro->rowquid%")
                ->orWhere('copia', 'like', "%$registro->rowquid%")->first();
            if ($oficio){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-uppercase text-warning">'.$registro->numero.'</b>';
                $registro->delete();
                $this->dispatch('initSelectsForm')->to(OficiosComponent::class);
                $this->toastBootstrap('success', "Oficio $nombre Eliminado.");
            }

        }
    }

    protected function getRegistro($rowquid): ?Persona
    {
        return Persona::where('rowquid', $rowquid)->first();
    }

    #[On('personasSelectInstituciones')]
    public function personasSelectInstituciones($data)
    {
        //JS
    }

    #[On('getPersonasSelectInstituciones')]
    public function getPersonasSelectInstituciones($rowquid)
    {
        $institucion = Institucion::where('rowquid', $rowquid)->first();
        if ($institucion){
            $this->instituciones_id = $institucion->id;
        }else{
            $this->reset('instituciones_id');
        }
    }

    #[On('setPersonasSelectInstituciones')]
    public function setPersonasSelectInstituciones($rowquid)
    {
        //JS
    }

    protected function getInstituciones(): array
    {
        $instituciones = Institucion::orderBy('nombre')->get();
        $data = getDataSelect2($instituciones, 'nombre');
        $data[] = ['id' => '', 'text' => 'Seleccione'];
        return $data;
    }

    #[On('initSelectPersonas')]
    public function initSelectPersonas()
    {
        $this->dispatch('personasSelectInstituciones', data: $this->getInstituciones());
        if ($this->instituciones_id){
            $institucion = Institucion::find($this->instituciones_id);
            if ($institucion){
                $this->dispatch('setPersonasSelectInstituciones', rowquid: $institucion->rowquid);
            }
        }
    }

    /*#[On('filtrarPersonasInstitucion')]
    public function filtrarPersonasInstitucion($id)
    {
        $this->cerrarBusqueda();
        $institucion = Institucion::find($id);
        if ($institucion){
            $this->keyword = $institucion->id;
            $this->filtro = $institucion->nombre;
        }
    }*/

}
