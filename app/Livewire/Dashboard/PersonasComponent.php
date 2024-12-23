<?php

namespace App\Livewire\Dashboard;

use App\Models\Institucion;
use App\Models\Oficio;
use App\Models\Persona;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class PersonasComponent extends Component
{
    use ToastBootstrap;

    public $rows = 0, $keyword;
    public $form = false, $table = true, $disable;
    public $nombre, $prefijo, $cargo, $instituciones_id, $sexo;
    public $filtro = '';

    #[Locked]
    public $personas_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {

        $listarRows = Persona::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get();

        $rowsCount = Persona::buscar($this->keyword)->count();

        $totalRows = Persona::count();

        if (($rowsCount > $this->rows)) {
            $this->disable = false;
        }else{
            $this->disable = true;
        }

        return view('livewire.dashboard.personas-component')
            ->with('listarRows', $listarRows)
            ->with('rowsCount', $rowsCount)
            ->with('totalRows', $totalRows);
    }

    public function setLimit()
    {
        if (numRowsPaginate() < 12) {
            $rows = 12;
        } else {
            $rows = numRowsPaginate();
        }
        $this->rows = $this->rows + $rows;
    }

    #[On('limpiarPersonas')]
    public function limpiarPersonas()
    {
        $this->reset([
            'form', 'table', 'rowquid', 'personas_id',
            'nombre', 'prefijo', 'cargo', 'instituciones_id', 'sexo',
        ]);
        $this->resetErrorBag();
        $this->dispatch('personasSelectInstituciones', data: $this->getInstituciones());
    }

    public function create()
    {
        $this->limpiarPersonas();
        $this->form = true;
        $this->table = false;
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
        if (is_null($this->personas_id)) {
            //nuevo
            $table = new Persona();
            do {
                $rowquid = generarStringAleatorio(16);
                $existe = Persona::where('rowquid', $rowquid)->first();
            } while ($existe);
            $table->rowquid = $rowquid;
        } else {
            //editar
            $table = Persona::find($this->personas_id);
        }

        if ($table) {
            $table->nombre = $this->nombre;
            $table->prefijo = $this->prefijo;
            $table->cargo = $this->cargo;
            $table->instituciones_id = $this->instituciones_id;
            $table->sexo = $this->sexo;
            $table->save();
            $this->dispatch('initSelectsForm')->to(OficiosComponent::class);
            $this->toastBootstrap();
        }

        $this->limpiarPersonas();
    }

    public function edit($rowquid)
    {
        $this->limpiarPersonas();
        $table = $this->getPersona($rowquid);
        if ($table) {
            $this->personas_id = $table->id;
            $this->nombre = $table->nombre;
            $this->prefijo = $table->prefijo;
            $this->cargo = $table->cargo;
            $this->sexo = $table->sexo;
            $this->rowquid = $table->rowquid;
            $this->dispatch('setPersonasSelectInstituciones', rowquid: $table->institucion->rowquid ?? '');
            $this->form = true;
            $this->table = false;
        }
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirmToastBootstrap('confirmedPersonas');
    }

    #[On('confirmedPersonas')]
    public function confirmedPersonas()
    {
        $table = $this->getPersona($this->rowquid);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $oficio = Oficio::where('dirigido', 'like', "%$this->rowquid%")
            ->orWhere('copia', 'like', "%$this->rowquid%")->first();
        if ($oficio){
            $vinculado = true;
        }

        if ($vinculado) {
            $this->htmlToastBoostrap();
        } else {
            if ($table) {
                $nombre = "<b>".mb_strtoupper($table->nombre)."</b>";
                $table->delete();
                $this->dispatch('initSelectsForm')->to(OficiosComponent::class);
                $this->toastBootstrap('success', "Registro $nombre Eliminado.");
            }
        }

        $this->limpiarPersonas();
    }

    public function buscar()
    {
        $this->limpiarPersonas();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
        $this->limpiarPersonas();
    }

    protected function getPersona($rowquid): ?Persona
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

    #[On('filtrarPersonasInstitucion')]
    public function filtrarPersonasInstitucion($id)
    {
        $this->cerrarBusqueda();
        $institucion = Institucion::find($id);
        if ($institucion){
            $this->keyword = $institucion->id;
            $this->filtro = $institucion->nombre;
        }
    }

}
