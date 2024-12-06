<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Color;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ColoresComponent extends Component
{
    use ToastBootstrap;

    public $rows = 0;
    public $nombre, $keyword;
    public $form = false, $table = true;

    #[Locked]
    public $colores_id, $rowquid;

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
            'colores_id', 'nombre', 'form', 'table', 'rowquid'
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
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Color::where('rowquid', $rowquid)->first();
            }while($existe);
            $color->rowquid = $rowquid;
        }else{
            //editar
            $color = Color::find($this->colores_id);
        }

        if ($color){
            $color->nombre = $this->nombre;
            $color->save();
            $this->dispatch('initSelects', select: 'color')->to(BienesComponent::class);
            $this->toastBootstrap();
        }

        $this->limpiarColores();
    }

    public function edit($rowquid)
    {
        $color = $this->getColor($rowquid);
        if ($color){
            $this->colores_id = $color->id;
            $this->nombre = $color->nombre;
            $this->form = true;
            $this->table = false;
        }
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirmToastBootstrap('confirmedColores');
    }

    #[On('confirmedColores')]
    public function confirmedColores()
    {
        $id = null;
        $color = $this->getColor($this->rowquid);
        if ($color){
            $id = $color->id;
        }

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $bienes = Bien::where('colores_id', $id)->first();

        if ($bienes){
            $vinculado = true;
        }

        if ($vinculado) {
            $this->htmlToastBoostrap();
        } else {
            if ($color){
                $nombre = "<b>".mb_strtoupper($color->nombre)."</b>";
                $color->delete();
                $this->dispatch('initSelects', select: 'color')->to(BienesComponent::class);
                $this->toastBootstrap('success', "Color $nombre Eliminado.");
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

    protected function getColor($rowquid): ?Color
    {
        return Color::where('rowquid', $rowquid)->first();
    }

}
