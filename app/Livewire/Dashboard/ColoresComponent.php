<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Color;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ColoresComponent extends Component
{
    use LivewireAlert;

    public $rows = 0;
    public $colores_id, $nombre, $keyword;
    public $form = false, $table = true;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $colores = Color::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get()
        ;

        $total = Color::buscar($this->keyword)->count();

        $rowsColores = Color::count();

        return view('livewire.dashboard.colores-component')
            ->with('listarColores', $colores)
            ->with('rowsColores', $rowsColores)
            ->with('totalBusqueda', $total);
    }

    public function setLimit()
    {
        if (numRowsPaginate() < 12) { $rows = 12; } else { $rows = numRowsPaginate(); }
        $this->rows = $this->rows + $rows;
    }

    #[On('limpiarColores')]
    public function limpiarColores()
    {
        $this->reset([
            'colores_id', 'nombre', 'form', 'table'
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
            'nombre'       =>  ['required', 'min:2', 'max:20'/*, 'alpha_dash:ascii'*/, Rule::unique('colores', 'nombre')->ignore($this->colores_id)],
        ];
        /*$messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe contener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no debe ser mayor que 15 caracteres.',
            'nombre.alpha_num' => ' El campo nombre sólo debe contener letras y números.'
        ];*/

        $this->validate($rules);
        if (is_null($this->colores_id)){
            //nuevo
            $color = new Color();
            $message = "Color Creado.";
        }else{
            //editar
            $color = Color::find($this->colores_id);
            $message = "Color Actualizado.";
        }

        if ($color){
            $color->nombre = $this->nombre;
            $color->save();
            $this->dispatch('initSelects', select: 'color')->to(BienesComponent::class);
            $this->alert('success', $message);
        }

        $this->limpiarColores();
    }

    public function edit($id)
    {
        $color = Color::find($id);
        if ($color){
            $this->colores_id = $color->id;
            $this->nombre = $color->nombre;
            $this->form = true;
            $this->table = false;
        }
    }

    public function destroy($id)
    {
        $this->colores_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedColores',
        ]);
    }

    #[On('confirmedColores')]
    public function confirmedColores()
    {
        $color = Color::find($this->colores_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $bienes = Bien::where('colores_id', $this->colores_id)->first();

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
            if ($color){
                $color->delete();
                $this->alert('success', 'Color Eliminado.');
                $this->dispatch('initSelects', select: 'color')->to(BienesComponent::class);
            }
        }

        $this->limpiarColores();
    }

    public function buscar()
    {
        $this->limpiarColores();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
        $this->limpiarColores();
    }

}
