<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Condicion;
use App\Traits\LimitRows;
use App\Traits\ModalTable;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class CondicionesComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;
    use ModalTable;

    public $nombre;

    public function mount()
    {
        $this->setLimit();
        $this->setSize(330);
        $this->modalTitle = "Condiciones";
        $this->confirmed = 'deleteCondiciones';
        $this->modulo = 'condiciones';
    }

    public function render()
    {
        $listar = Condicion::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();
        $limit = $listar->count();
        $rows = Condicion::buscar($this->keyword)->count();
        $this->btnVerMas($limit, $rows);

        return view('livewire.dashboard.condiciones-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->limpiarModal();
        $this->reset([
            'nombre',
        ]);
    }

    public function save()
    {
        $rules = [
            'nombre' => ['required', 'min:2', 'max:50', Rule::unique('condiciones', 'nombre')->ignore($this->tabla_id)],
        ];
        $this->validate($rules);

        if ($this->tabla_id){
            //editar
            $model = Condicion::find($this->tabla_id);
        }else{
            //nuevo
            $model = new Condicion();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Condicion::where('rowquid', $rowquid)->first();
            }while($existe);
            $model->rowquid = $rowquid;
        }

        if ($model){
            $model->nombre = $this->nombre;
            $model->save();
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
        }
    }

    #[On('deleteCondiciones')]
    public function delete($rowquid)
    {
        $this->limpiar();
        $registro = $this->getRegistro($rowquid);
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            $bienes = Bien::where('condiciones_id', $registro->id)->first();

            if ($bienes){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-uppercase text-warning">'.$registro->nombre.'</b>';
                $registro->delete();
                $this->toastBootstrap('success', "Condicion $nombre Eliminada.");
            }

        }
    }

    protected function getRegistro($rowquid): ?Condicion
    {
        return Condicion::where('rowquid', $rowquid)->first();
    }

}
