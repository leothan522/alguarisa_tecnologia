<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Modelo;
use App\Models\Tipo;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class TiposComponent extends Component
{
    use LivewireAlert;
    use ToastBootstrap;

    public $rows = 0;
    public $nombre, $keyword;
    public $form = false, $table = true;

    #[Locked]
    public $tipos_id, $rowquid;

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
            'tipos_id', 'nombre', 'form', 'table', 'rowquid'
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
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Tipo::where('rowquid', $rowquid)->first();
            }while($existe);
            $tipo->rowquid = $rowquid;
        }else{
            //editar
            $tipo = Tipo::find($this->tipos_id);
        }

        if ($tipo){
            $tipo->nombre = $this->nombre;
            $tipo->save();
            $this->dispatch('initSelects', select: 'tipos')->to(BienesComponent::class);
            $this->toastBootstrap();
        }

        $this->limpiarTipos();
    }

    public function edit($rowquid)
    {
        $this->limpiarTipos();
        $tipo = $this->getTipo($rowquid);
        if ($tipo){
            $this->tipos_id = $tipo->id;
            $this->nombre = $tipo->nombre;
            $this->form = true;
            $this->table = false;
        }
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirmToastBootstrap('confirmedTipos');
    }

    #[On('confirmedTipos')]
    public function confirmedTipos()
    {
        $id = null;
        $tipo = $this->getTipo($this->rowquid);
        if ($tipo){
            $id = $tipo->id;
        }

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $modelos = Modelo::where('tipos_id', $id)->first();
        $bienes = Bien::where('tipos_id', $id)->first();

        if ($modelos || $bienes){
            $vinculado = true;
        }

        if ($vinculado) {
            $this->htmlToastBoostrap();
        } else {
            if ($tipo){
                $nombre = '<b>'.mb_strtoupper($tipo->nombre).'</b>';
                $tipo->delete();
                $this->dispatch('initSelects', select: 'tipos')->to(BienesComponent::class);
                $this->toastBootstrap('success', "Tipo $nombre Eliminado.");
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

    protected function getTipo($rowquid): ?Tipo
    {
        return Tipo::where('rowquid', $rowquid)->first();
    }

}
