<?php

namespace App\Livewire\Dashboard;

use App\Models\Institucion;
use App\Models\Oficio;
use App\Models\Persona;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class InstitucionesComponent extends Component
{
    use ToastBootstrap;

    public $rows = 0, $keyword;
    public $form = false, $table = true, $disable;
    public $nombre, $sufijo;

    #[Locked]
    public $instituciones_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $listarRows = Institucion::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get();

        $rowsCount = Institucion::buscar($this->keyword)->count();

        $totalRows = Institucion::count();

        if (($rowsCount > $this->rows)) {
            $this->disable = false;
        }else{
            $this->disable = true;
        }

        return view('livewire.dashboard.instituciones-component')
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

    #[On('limpiarInstituciones')]
    public function limpiarInstituciones()
    {
        $this->reset([
            'form', 'table', 'rowquid', 'instituciones_id',
            'nombre', 'sufijo'
        ]);
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->limpiarInstituciones();
        $this->form = true;
        $this->table = false;
    }

    public function save()
    {
        $rules = [
            'nombre' => ['required', 'min:2', 'max:50', Rule::unique('oficios_instituciones', 'nombre')->ignore($this->instituciones_id)],
            'sufijo' => 'nullable|min:2|max:50',
        ];

        $this->validate($rules);
        if (is_null($this->instituciones_id)) {
            //nuevo
            $table = new Institucion();
            do {
                $rowquid = generarStringAleatorio(16);
                $existe = Institucion::where('rowquid', $rowquid)->first();
            } while ($existe);
            $table->rowquid = $rowquid;
        } else {
            //editar
            $table = Institucion::find($this->instituciones_id);
        }

        if ($table) {
            $table->nombre = $this->nombre;
            $table->sufijo = $this->sufijo;
            $table->save();

            $this->dispatch('initSelectPersonas')->to(PersonasComponent::class);
            $this->dispatch('initSelectsForm')->to(OficiosComponent::class);

            $this->toastBootstrap();
        }

        $this->limpiarInstituciones();
    }

    public function edit($rowquid)
    {
        $this->limpiarInstituciones();
        $table = $this->getInstitucion($rowquid);
        if ($table) {
            $this->instituciones_id = $table->id;
            $this->nombre = $table->nombre;
            $this->sufijo = $table->sufijo;
            $this->form = true;
            $this->table = false;
        }
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirmToastBootstrap('confirmedInstitucion');
    }

    #[On('confirmedInstitucion')]
    public function confirmedInstitucion()
    {
        $id = 0;
        $table = $this->getInstitucion($this->rowquid);
        if ($table) {
            $id = $table->id;
        }

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $personas = Persona::where('instituciones_id', $id)->first();
        if ($personas){
            $vinculado = true;
        }

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
                $this->dispatch('initSelectPersonas')->to(PersonasComponent::class);
                $this->toastBootstrap('success', "Institución $nombre Eliminada.");
            }
        }

        $this->limpiarInstituciones();
    }

    public function buscar()
    {
        $this->limpiarInstituciones();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
        $this->limpiarInstituciones();
    }

    protected function getInstitucion($rowquid): ?Institucion
    {
        return Institucion::where('rowquid', $rowquid)->first();
    }

    public function filtrar($rowquid)
    {
        $institucion = $this->getInstitucion($rowquid);
        if ($institucion){
            $this->dispatch('filtrarPersonasInstitucion', id: $institucion->id)->to(PersonasComponent::class);
        }
    }

}
