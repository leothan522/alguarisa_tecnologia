<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Modelo;
use App\Models\Tipo;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class TiposComponent extends Component
{
    use LivewireAlert;

    public $rows = 0;
    public $tipos_id, $nombre, $keyword;
    public $form = false, $table = true;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $tipos = Tipo::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get()
        ;

        $total = Tipo::buscar($this->keyword)->count();

        $rowsTipos = Tipo::count();

        return view('livewire.dashboard.tipos-component')
            ->with('listarTipos', $tipos)
            ->with('rowsTipos', $rowsTipos)
            ->with('totalBusqueda', $total);
    }

    public function setLimit()
    {
        if (numRowsPaginate() < 12) { $rows = 12; } else { $rows = numRowsPaginate(); }
        $this->rows = $this->rows + $rows;
    }

    #[On('limpiarTipos')]
    public function limpiarTipos()
    {
        $this->reset([
            'tipos_id', 'nombre', 'form', 'table'
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
            'nombre'       =>  ['required', 'min:2', 'max:50'/*, 'alpha_dash:ascii'*/, Rule::unique('tipos', 'nombre')->ignore($this->tipos_id)],
        ];
        /*$messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe contener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no debe ser mayor que 15 caracteres.',
            'nombre.alpha_num' => ' El campo nombre sólo debe contener letras y números.'
        ];*/

        $this->validate($rules);
        if (is_null($this->tipos_id)){
            //nuevo
            $tipo = new Tipo();
            $message = "Tipo Creado.";
        }else{
            //editar
            $tipo = Tipo::find($this->tipos_id);
            $message = "Tipo Actualizado.";
        }

        if ($tipo){
            $tipo->nombre = $this->nombre;
            $tipo->save();
            $this->dispatch('initSelects', select: 'tipos')->to(BienesComponent::class);
            $this->alert('success', $message);
        }

        $this->limpiarTipos();
    }

    public function edit($id)
    {
        $this->limpiarTipos();
        $tipo = Tipo::find($id);
        if ($tipo){
            $this->tipos_id = $tipo->id;
            $this->nombre = $tipo->nombre;
            $this->form = true;
            $this->table = false;
        }
    }

    public function destroy($id)
    {
        $this->tipos_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedTipos',
        ]);
    }

    #[On('confirmedTipos')]
    public function confirmedTipos()
    {
        $tipo = Tipo::find($this->tipos_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $modelos = Modelo::where('tipos_id', $this->tipos_id)->first();
        $bienes = Bien::where('tipos_id', $this->tipos_id)->first();

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
            if ($tipo){
                $tipo->delete();
                $this->alert('success', 'Tipo Eliminado.');
                $this->dispatch('initSelects', select: 'tipos')->to(BienesComponent::class);
            }
        }

        $this->limpiarTipos();
    }

    public function buscar()
    {
        $this->limpiarTipos();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
        $this->limpiarTipos();
    }

}
