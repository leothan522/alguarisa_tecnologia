<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Condicion;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class CondicionesComponent extends Component
{
    use LivewireAlert;

    public $rows = 0;
    public $condiciones_id, $nombre, $keyword;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $condiciones = Condicion::buscar($this->keyword)
            ->limit($this->rows)
            ->get()
        ;
        $rowsCondiciones = Condicion::count();
        return view('livewire.dashboard.condiciones-component')
            ->with('listarCondiciones', $condiciones)
            ->with('rowsCondiciones', $rowsCondiciones);
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
            'condiciones_id', 'nombre', 'keyword'
        ]);
        $this->resetErrorBag();
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
        }else{
            //editar
            $condicion = Condicion::find($this->condiciones_id);
            $message = "Condición Actualizada.";
        }
        $condicion->nombre = $this->nombre;

        $condicion->save();
        $this->dispatch('initSelects', select: 'condicion')->to(BienesComponent::class);
        $this->limpiarCondiciones();
        $this->alert('success', $message);
    }

    public function edit($id)
    {
        $condicion = Condicion::find($id);
        $this->condiciones_id = $condicion->id;
        $this->nombre = $condicion->nombre;
    }

    public function destroy($id)
    {
        $this->condiciones_id = $id;
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
        $condicion = Condicion::find($this->condiciones_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $bienes = Bien::where('condiciones_id', $this->condiciones_id)->first();

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
            $condicion->delete();
            $this->alert(
                'success',
                'Condición Eliminada.'
            );
            $this->dispatch('initSelects', select: 'condicion')->to(BienesComponent::class);
        }

        $this->limpiarCondiciones();
    }

    public function buscar()
    {
        //
    }

}
