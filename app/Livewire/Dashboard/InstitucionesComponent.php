<?php

namespace App\Livewire\Dashboard;

use App\Models\Institucion;
use App\Models\Oficio;
use App\Models\Persona;
use App\Traits\LimitRows;
use App\Traits\ModalTable;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class InstitucionesComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;
    use ModalTable;

    public $nombre, $sufijo;

    public function mount()
    {
        $this->setLimit();
        $this->setSize(330);
        $this->modalTitle = "Instituciones";
        $this->confirmed = 'deleteInstituciones';
        $this->modulo = 'instituciones';
    }

    public function render()
    {
        $listar = Institucion::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();
        $limit = $listar->count();
        $rows = Institucion::buscar($this->keyword)->count();
        $this->btnVerMas($limit, $rows);

        return view('livewire.dashboard.instituciones-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->limpiarModal();
        $this->reset([
            'nombre', 'sufijo'
        ]);
    }

    public function save()
    {
        $rules = [
            'nombre' => ['required', 'min:2', 'max:50', Rule::unique('oficios_instituciones', 'nombre')->ignore($this->tabla_id)],
            'sufijo' => 'nullable|min:2|max:50',
        ];

        $this->validate($rules);


        if ($this->tabla_id){
            //editar
            $model = Institucion::find($this->tabla_id);
        }else{
            //nuevo
            $model = new Institucion();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Institucion::where('rowquid', $rowquid)->first();
            }while($existe);
            $model->rowquid = $rowquid;
        }

        if ($model){
            $model->nombre = $this->nombre;
            $model->sufijo = $this->sufijo;;
            $model->save();
            $this->dispatch('initSelectPersonas')->to(PersonasComponent::class);
            $this->dispatch('initSelectsForm')->to(OficiosComponent::class);
            $this->limpiar();
            $this->toastBootstrap();
        }
    }

    public function edit($rowquid)
    {
        $this->limpiar();
        $registro = $this->getRegistro($rowquid);
        if ($registro){
            $this->tabla_id = $registro->id;
            $this->ocultarTable = true;
            $this->ocultarCard = false;
            $this->nombre = $registro->nombre;
            $this->sufijo = $registro->sufijo;
        }
    }

    #[On('deleteInstituciones')]
    public function delete($rowquid)
    {
        $this->limpiar();
        $registro = $this->getRegistro($rowquid);
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            $personas = Persona::where('instituciones_id', $registro->id)->first();
            $oficio = Oficio::where('dirigido', 'like', "%$registro->rowquid%")
                ->orWhere('copia', 'like', "%$registro->rowquid%")->first();

            if ($personas || $oficio){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-uppercase text-warning">'.$registro->nombre.'</b>';
                $registro->delete();
                $this->dispatch('initSelectPersonas')->to(PersonasComponent::class);
                $this->toastBootstrap('success', "Institución $nombre Eliminada.");
            }

        }
    }

    protected function getRegistro($rowquid): ?Institucion
    {
        return Institucion::where('rowquid', $rowquid)->first();
    }

}
