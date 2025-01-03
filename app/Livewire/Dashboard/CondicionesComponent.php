<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Condicion;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class CondicionesComponent extends Component
{
    use ToastBootstrap;

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
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Condicion::where('rowquid', '=', $rowquid)->first();
            }while($existe);
            $condicion->rowquid = $rowquid;
        }else{
            //editar
            $condicion = Condicion::find($this->condiciones_id);
        }

        if ($condicion){
            $condicion->nombre = $this->nombre;
            $condicion->save();
            $this->dispatch('initSelects', select: 'condicion')->to(BienesOldComponent::class);
            $this->toastBootstrap();
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
        $this->confirmToastBootstrap('confirmedCondicion');
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
            $this->htmlToastBoostrap();
        } else {
            if ($condicion){
                $nombre = "<b>".mb_strtoupper($condicion->nombre)."</b>";
                $condicion->delete();
                $this->dispatch('initSelects', select: 'condicion')->to(BienesOldComponent::class);
                $this->toastBootstrap('success', "Condición $nombre Eliminada.");
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
