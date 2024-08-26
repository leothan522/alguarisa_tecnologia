<?php

namespace App\Livewire\Dashboard;

use App\Models\BienUbicacion;
use App\Models\Ubicacion;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class UbicacionesComponent extends Component
{
    use LivewireAlert;

    public $rows = 0;
    public $ubicaciones_id, $nombre, $keyword;
    public $form = false, $table = true;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $ubicaciones = Ubicacion::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get()
        ;

        $total = Ubicacion::buscar($this->keyword)->count();

        $rowsUbicaciones = Ubicacion::count();

        return view('livewire.dashboard.ubicaciones-component')
            ->with('listarUbicaciones', $ubicaciones)
            ->with('rowsUbicaciones', $rowsUbicaciones)
            ->with('totalBusqueda', $total);
    }

    public function setLimit()
    {
        if (numRowsPaginate() < 12) { $rows = 12; } else { $rows = numRowsPaginate(); }
        $this->rows = $this->rows + $rows;
    }

    #[On('limpiarUbicaciones')]
    public function limpiarUbicaciones()
    {
        $this->reset([
            'ubicaciones_id', 'nombre', 'form', 'table'
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
            'nombre'       =>  ['required', 'min:2', 'max:60'/*, 'alpha_dash:ascii'*/, Rule::unique('ubicaciones', 'nombre')->ignore($this->ubicaciones_id)],
        ];
        /*$messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe contener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no debe ser mayor que 15 caracteres.',
            'nombre.alpha_num' => ' El campo nombre sólo debe contener letras y números.'
        ];*/

        $this->validate($rules);
        if (is_null($this->ubicaciones_id)){
            //nuevo
            $ubicacion = new Ubicacion();
            $message = "Ubicación Creada.";
        }else{
            //editar
            $ubicacion = Ubicacion::find($this->ubicaciones_id);
            $message = "Ubicación Actualizada.";
        }

        if ($ubicacion){
            $ubicacion->nombre = $this->nombre;
            $ubicacion->save();
            //$this->dispatch('initSelects', select: 'condicion')->to(BienesComponent::class);
            $this->alert('success', $message);
        }

        $this->limpiarUbicaciones();
    }

    public function edit($id)
    {
        $ubicacion = Ubicacion::find($id);
        if ($ubicacion){
            $this->ubicaciones_id = $ubicacion->id;
            $this->nombre = $ubicacion->nombre;
            $this->form = true;
            $this->table = false;
        }
    }

    public function destroy($id)
    {
        $this->ubicaciones_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedUbicacion',
        ]);
    }

    #[On('confirmedUbicacion')]
    public function confirmedUbicacion()
    {
        $ubicacion = Ubicacion::find($this->ubicaciones_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $bienes = BienUbicacion::where('ubicaciones_id', $this->ubicaciones_id)->first();

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
            if ($ubicacion){
                $ubicacion->delete();
                $this->alert('success', 'Condición Eliminada.');
            }
        }

        $this->limpiarUbicaciones();
    }

    public function buscar()
    {
        $this->limpiarUbicaciones();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
        $this->limpiarUbicaciones();
    }

}
