<?php

namespace App\Livewire\Dashboard;

use App\Models\Color;
use App\Models\Condicion;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Tipo;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalBusquedaComponent extends Component
{
    use ToastBootstrap;

    public $tipos_id, $marcas_id, $colores_id, $condiciones_id, $modelos_id, $serial, $identificador;

    public function render()
    {
        return view('livewire.dashboard.modal-busqueda-component');
    }

    public function limpiarBusqueda()
    {
        $this->reset([
            'tipos_id', 'marcas_id', 'colores_id', 'condiciones_id', 'modelos_id', 'serial', 'identificador'
        ]);
        $this->modalBusqueda();
    }

    #[On('modalBusqueda')]
    public function modalBusqueda()
    {
        $tipos = Tipo::orderBy('nombre', 'ASC')->get();
        $data = dataSelect2($tipos, 'nombre');
        $this->dispatch('busquedaSelectTipos', data: $data);
        if ($this->tipos_id){
            $this->dispatch('setBusquedaSelectTipos', id: $this->tipos_id);
        }

        $marcas = Marca::orderBy('nombre', 'ASC')->get();
        $data = dataSelect2($marcas, 'nombre');
        $this->dispatch('busquedaSelectMarcas', data: $data);
        if ($this->marcas_id){
            $this->dispatch('setBusquedaSelectMarcas', id: $this->marcas_id);
        }

        $color = Color::orderBy('nombre', 'ASC')->get();
        $data = dataSelect2($color, 'nombre');
        $this->dispatch('busquedaSelectColor', data: $data);
        if ($this->colores_id){
            $this->dispatch('setBusquedaSelectColor', id: $this->colores_id);
        }

        $condicion = Condicion::orderBy('nombre', 'ASC')->get();
        $data = dataSelect2($condicion, 'nombre');
        $this->dispatch('busquedaSelectCondicion', data: $data);
        if ($this->condiciones_id){
            $this->dispatch('setBusquedaSelectCondicion', id: $this->condiciones_id);
        }

        $data = $this->dataModelo();
        $this->dispatch('busquedaSelectModelo', data: $data);
        if ($this->modelos_id){
            $this->dispatch('setBusquedaSelectModelo', id: $this->modelos_id);
        }

    }

    public function initBusqueda()
    {
        if ($this->tipos_id || $this->marcas_id || $this->modelos_id || $this->colores_id || $this->condiciones_id){
            $data = [
                'tipo' => $this->tipos_id,
                'marca' => $this->marcas_id,
                'modelo' => $this->modelos_id,
                'color' => $this->colores_id,
                'condicion' => $this->condiciones_id,
                'serial' => $this->serial,
                'identificador' => $this->identificador
            ];
            $this->dispatch('busquedaAvanzada', data: $data)->to(BienesOldComponent::class);
            $this->dispatch('cerrarBusqueda');
        }else{
            $this->toastBootstrap('warning', 'Debes Establecer al menos un filtro para la busqueda.');
        }
    }

    #[On('cerrarBusqueda')]
    public function cerrarBusqueda()
    {
        //JS
    }

    #[On('busquedaSelectTipos')]
    public function busquedaSelectTipos($data)
    {
        //JS
    }

    #[On('getBusquedaSelectTipos')]
    public function getBusquedaSelectTipos($id)
    {
        $this->tipos_id = $id;
        if ($this->marcas_id){
            $this->dispatch('busquedaSelectModelo', data: $this->dataModelo(true));
            if ($this->modelos_id) {
                $this->dispatch('setBusquedaSelectModelo', id: $this->modelos_id);
            }
        }
    }

    #[On('setBusquedaSelectTipos')]
    public function setBusquedaSelectTipos($id)
    {
        //JS
    }

    #[On('busquedaSelectMarcas')]
    public function busquedaSelectMarcas($data)
    {
        //JS
    }

    #[On('getBusquedaSelectMarcas')]
    public function getBusquedaSelectMarcas($id)
    {
        $this->marcas_id = $id;
        if ($this->tipos_id){
            $this->dispatch('busquedaSelectModelo', data: $this->dataModelo(true));
            if ($this->modelos_id) {
                $this->dispatch('setBusquedaSelectModelo', id: $this->modelos_id);
            }
        }
    }

    #[On('setBusquedaSelectMarcas')]
    public function setBusquedaSelectMarcas($id)
    {
        //JS
    }

    #[On('busquedaSelectColor')]
    public function busquedaSelectColor($data)
    {
        //JS
    }

    #[On('getBusquedaSelectColor')]
    public function getBusquedaSelectColor($id)
    {
        $this->colores_id = $id;
    }

    #[On('setBusquedaSelectColor')]
    public function setBusquedaSelectColor($id)
    {
        //JS
    }

    #[On('busquedaSelectCondicion')]
    public function busquedaSelectCondicion($data)
    {
        //JS
    }

    #[On('getBusquedaSelectCondicion')]
    public function getBusquedaSelectCondicion($id)
    {
        $this->condiciones_id = $id;
    }

    #[On('setBusquedaSelectCondicion')]
    public function setBusquedaSelectCondicion($id)
    {
        //JS
    }

    #[On('busquedaSelectModelo')]
    public function busquedaSelectModelo($data)
    {
        //JS
    }

    #[On('getBusquedaSelectModelo')]
    public function getBusquedaSelectModelo($id)
    {
        $this->modelos_id = $id;
    }

    #[On('setBusquedaSelectModelo')]
    public function setBusquedaSelectModelo($id)
    {
        //JS
    }

    protected function dataModelo($filtrar = false): array
    {
        if ($filtrar){
            $modelos = Modelo::where('tipos_id', $this->tipos_id)
                ->where('marcas_id', $this->marcas_id)
                ->orderBy('nombre', 'ASC')->get();
        }else{
            $modelos = Modelo::orderBy('nombre', 'ASC')->get();
        }
        return dataSelect2($modelos, 'nombre');
    }

}
