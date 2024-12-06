<?php

namespace App\Livewire\Dashboard;

use App\Models\BienUbicacion;
use App\Models\Ubicacion;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class UbicacionesComponent extends Component
{
    use ToastBootstrap;

    public $rows = 0;
    public $nombre, $keyword;
    public $form = false, $table = true;

    #[Locked]
    public $ubicaciones_id, $rowquid;

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
            'ubicaciones_id', 'nombre', 'form', 'table', 'rowquid'
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
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Ubicacion::where('rowquid', $rowquid)->first();
            }while($existe);
            $ubicacion->rowquid = $rowquid;
        }else{
            //editar
            $ubicacion = Ubicacion::find($this->ubicaciones_id);
        }

        if ($ubicacion){
            $ubicacion->nombre = $this->nombre;
            $ubicacion->save();
            //$this->dispatch('initSelects', select: 'condicion')->to(BienesComponent::class);
            $this->toastBootstrap();
        }

        $this->limpiarUbicaciones();
    }

    public function edit($rowquid)
    {
        $ubicacion = $this->getUbicacion($rowquid);
        if ($ubicacion){
            $this->ubicaciones_id = $ubicacion->id;
            $this->nombre = $ubicacion->nombre;
            $this->form = true;
            $this->table = false;
        }
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirmToastBootstrap('confirmedUbicacion');
    }

    #[On('confirmedUbicacion')]
    public function confirmedUbicacion()
    {
        $id = null;
        $ubicacion = $this->getUbicacion($this->rowquid);
        if ($ubicacion){
            $id = $ubicacion->id;
        }

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $bienes = BienUbicacion::where('ubicaciones_id', $id)->first();

        if ($bienes){
            $vinculado = true;
        }

        if ($vinculado) {
            $this->htmlToastBoostrap();
        } else {
            if ($ubicacion){
                $nombre = "<b>".mb_strtoupper($ubicacion->nombre)."</b>";
                $ubicacion->delete();
                $this->toastBootstrap('success', "Condición $nombre Eliminada.");
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

    protected function getUbicacion($rowquid): ?Ubicacion
    {
        return Ubicacion::where('rowquid', $rowquid)->first();
    }

}
