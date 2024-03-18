<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Tipo;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class MarcasComponent extends Component
{
    use LivewireAlert;

    public $rows = 0;
    public $marcas_id, $nombre, $keyword;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $marcas = Marca::buscar($this->keyword)
            ->limit($this->rows)
            ->get()
        ;
        $rowsMarcas = Marca::count();
        return view('livewire.dashboard.marcas-component')
            ->with('listarMarcas', $marcas)
            ->with('rowsMarcas', $rowsMarcas);
    }

    public function setLimit()
    {
        if (numRowsPaginate() < 12) { $rows = 12; } else { $rows = numRowsPaginate(); }
        $this->rows = $this->rows + $rows;
    }

    #[On('limpiarMarcas')]
    public function limpiarMarcas()
    {
        $this->reset([
            'marcas_id', 'nombre', 'keyword'
        ]);
        $this->resetErrorBag();
    }

    public function save()
    {
        $rules = [
            'nombre'       =>  ['required', 'min:2', 'max:20'/*, 'alpha_dash:ascii'*/, Rule::unique('marcas', 'nombre')->ignore($this->marcas_id)],
        ];
        /*$messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe contener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no debe ser mayor que 15 caracteres.',
            'nombre.alpha_num' => ' El campo nombre sólo debe contener letras y números.'
        ];*/

        $this->validate($rules);
        if (is_null($this->marcas_id)){
            //nuevo
            $marca = new Marca();
            $message = "Marca Creada.";
        }else{
            //editar
            $marca = Marca::find($this->marcas_id);
            $message = "Marca Actualizada.";
        }
        $marca->nombre = $this->nombre;

        $marca->save();
        $this->dispatch('initSelects', select: 'marcas')->to(BienesComponent::class);
        $this->limpiarMarcas();
        $this->alert('success', $message);
    }

    public function edit($id)
    {
        $marca = Marca::find($id);
        $this->marcas_id = $marca->id;
        $this->nombre = $marca->nombre;
    }

    public function destroy($id)
    {
        $this->marcas_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedMarcas',
        ]);
    }

    #[On('confirmedMarcas')]
    public function confirmedMarcas()
    {
        $marca = Marca::find($this->marcas_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $modelos = Modelo::where('marcas_id', $this->marcas_id)->first();
        $bienes = Bien::where('marcas_id', $this->marcas_id)->first();

        if ($modelos || $bienes){
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
            $marca->delete();
            $this->alert(
                'success',
                'Marca Eliminada.'
            );
            $this->dispatch('initSelects', select: 'marcas')->to(BienesComponent::class);
        }

        $this->limpiarMarcas();
    }

    public function buscar()
    {
        //
    }

}
