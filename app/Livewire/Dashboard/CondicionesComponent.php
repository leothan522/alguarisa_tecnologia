<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Condicion;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class CondicionesComponent extends Component
{
    use LivewireAlert;

    public $rows = 0;
    public $nombre, $keyword;
    public $form = false, $table = true;

    #[Locked]
    public $condiciones_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $condiciones = Condicion::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get()
        ;

        $total = Condicion::buscar($this->keyword)->count();

        $rowsCondiciones = Condicion::count();

        return view('livewire.dashboard.condiciones-component')
            ->with('listarCondiciones', $condiciones)
            ->with('rowsCondiciones', $rowsCondiciones)
            ->with('totalBusqueda', $total);
    }

    public function setLimit()
    {
        if (numRowsPaginate() < 12) { $rows = 12; } else { $rows = numRowsPaginate(); }
        $this->rows = $this->rows + $rows;
    }

    #[On('limpiarCondiciones')]
    public function limpiarCondiciones()
    {
        $this->reset([
            'condiciones_id', 'nombre', 'form', 'table', 'rowquid'
        ]);
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->form = true;
        $this->table = false;
    }

    public function save()
    {
        $rules = [
            'nombre'       =>  ['required', 'min:2', 'max:20'/*, 'alpha_dash:ascii'*/, Rule::unique('condiciones', 'nombre')->ignore($this->condiciones_id)],
        ];
        /*$messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe contener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no debe ser mayor que 15 caracteres.',
            'nombre.alpha_num' => ' El campo nombre sólo debe contener letras y números.'
        ];*/

        $this->validate($rules);
        if (is_null($this->condiciones_id)){
            //nuevo
            $condicion = new Condicion();
            $message = "Condición Creada.";
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Condicion::where('rowquid', '=', $rowquid)->first();
            }while($existe);
            $condicion->rowquid = $rowquid;
        }else{
            //editar
            $condicion = Condicion::find($this->condiciones_id);
            $message = "Condición Actualizada.";
        }

        if ($condicion){
            $condicion->nombre = $this->nombre;
            $condicion->save();
            $this->dispatch('initSelects', select: 'condicion')->to(BienesComponent::class);
            $this->alert('success', $message);
        }

        $this->limpiarCondiciones();
    }

    public function edit($rowquid)
    {
        $condicion = $this->getCondicion($rowquid);
        if ($condicion){
            $this->condiciones_id = $condicion->id;
            $this->nombre = $condicion->nombre;
            $this->form = true;
            $this->table = false;
        }
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedCondicion',
        ]);
    }

    #[On('confirmedCondicion')]
    public function confirmedCondicion()
    {
        $id = null;
        $condicion = $this->getCondicion($this->rowquid);
        if ($condicion){
            $id = $condicion->id;
        }

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $bienes = Bien::where('condiciones_id', $id)->first();

        if ($bienes){
            $vinculado = true;
        }

        if ($vinculado) {
            $this->alert('warning', '¡No se puede Borrar!', [
                'position' => 'center',
                'timer' => '',
                'toast' => false,
                'text' => 'El registro que intenta borrar ya se encuentra vinculado con otros procesos.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'OK',
            ]);
        } else {
            if ($condicion){
                $condicion->delete();
                $this->alert('success', 'Condición Eliminada.');
                $this->dispatch('initSelects', select: 'condicion')->to(BienesComponent::class);
            }
        }

        $this->limpiarCondiciones();
    }

    public function buscar()
    {
        $this->limpiarCondiciones();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
        $this->limpiarCondiciones();
    }

    protected function getCondicion($rowquid): ?Condicion
    {
        return Condicion::where('rowquid', $rowquid)->first();
    }

}
