<?php

namespace App\Livewire\Dashboard;

use App\Models\Color;
use App\Models\Condicion;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Tipo;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class BienesComponent extends Component
{
    use LivewireAlert;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $view = true, $form = false, $show = false, $nuevo = false, $editar = false, $footer = false, $keyword;
    public $tipos_id, $marcas_id, $modelos_id, $colores_id, $serial, $identificador, $condiciones_id, $adicional;
    public $bienes_id;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        /*if ($rowsTiendas > $this->numero) {
            $this->tableStyle = true;
        }*/
        return view('livewire.dashboard.bienes-component');
    }

    public function setLimit()
    {
        if (numRowsPaginate() < $this->numero) {
            $rows = $this->numero;
        } else {
            $rows = numRowsPaginate();
        }
        $this->rows = $this->rows + $rows;
    }

    public function limpiar()
    {
        $this->reset([
            'view', 'form', 'show', 'nuevo', 'editar', 'footer', 'keyword',
            'tipos_id', 'marcas_id', 'modelos_id', 'colores_id', 'serial', 'identificador', 'condiciones_id', 'adicional',
            'bienes_id'
        ]);
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->limpiar();
        $this->view = false;
        $this->form = true;
        $this->nuevo = true;
        $this->initSelects();
    }


    public function rules()
    {
        return [
            'serial'       =>  [
                Rule::requiredIf(empty($this->identificador)),
                'max:20',
                Rule::unique('bienes', 'serial')
                    ->ignore($this->bienes_id)],
            'identificador' =>  [
                Rule::requiredIf(empty($this->serial)),
                'max:20',
                Rule::unique('bienes', 'identificador')
                    ->ignore($this->bienes_id)],
            'tipos_id'      => 'required',
            'marcas_id'      => 'required',
            'modelos_id'      => 'required',
            'colores_id'      => 'required',
            'condiciones_id'      => 'required',
        ];
    }

    public function save()
    {
        $this->validate();
        $numero = 'hola';
        if ($this->serial == '*'){
            $numero = nextCodigo(null, 'sin_serial');
        }
        $this->alert('success', 'guardar-'. $numero);
    }

    #[On('initSelects')]
    public function initSelects($select = null)
    {
        switch ($select) {

            case 'tipos';
                $this->dispatch('selectTipos', data: $this->dataTipos());
                if ($this->tipos_id) {
                    $this->dispatch('setSelectTipos', id: $this->tipos_id);
                }
                break;

            case 'marcas';
                $this->dispatch('selectMarcas', data: $this->dataMarcas());
                if ($this->marcas_id) {
                    $this->dispatch('setSelectMarcas', id: $this->marcas_id);
                }
                break;

            case 'color':
                $this->dispatch('selectColores', data: $this->dataColor());
                if ($this->colores_id) {
                    $this->dispatch('setSelectColores', id: $this->colores_id);
                }
                break;

            case 'condicion':
                $this->dispatch('selectCondiciones', data: $this->dataCondicion());
                if ($this->condiciones_id) {
                    $this->dispatch('setSelectCondiciones', id: $this->condiciones_id);
                }
                break;

            case 'modelo':
                if ($this->tipos_id && $this->marcas_id){
                    $data = $this->dataModelo(true);
                }else{
                    $data = $this->dataModelo();
                }
                $this->dispatch('selectModelos', data: $data);
                if ($this->modelos_id) {
                    $this->dispatch('setSelectModelos', id: $this->modelos_id);
                }
                break;

            default:

                $this->dispatch('selectTipos', data: $this->dataTipos());
                if ($this->tipos_id) {
                    $this->dispatch('setSelectTipos', id: $this->tipos_id);
                }

                $this->dispatch('selectMarcas', data: $this->dataMarcas());
                if ($this->marcas_id) {
                    $this->dispatch('setSelectMarcas', id: $this->marcas_id);
                }

                $this->dispatch('selectColores', data: $this->dataColor());
                if ($this->colores_id) {
                    $this->dispatch('setSelectColores', id: $this->colores_id);
                }

                $this->dispatch('selectCondiciones', data: $this->dataCondicion());
                if ($this->condiciones_id) {
                    $this->dispatch('setSelectCondiciones', id: $this->condiciones_id);
                }

                if ($this->tipos_id && $this->marcas_id){
                    $data = $this->dataModelo(true);
                }else{
                    $data = $this->dataModelo();
                }
                $this->dispatch('selectModelos', data: $data);
                if ($this->modelos_id) {
                    $this->dispatch('setSelectModelos', id: $this->modelos_id);
                }

                break;
        }
    }

    protected function dataTipos(): array
    {
        $tipos = Tipo::orderBy('nombre', 'ASC')->get();
        return dataSelect2($tipos, 'nombre');
    }

    #[On('selectTipos')]
    public function selectTipos($data)
    {
        //JS
    }

    #[On('getselectTipos')]
    public function getselectTipos($id)
    {
        $this->tipos_id = $id;
        if ($this->marcas_id){
            $this->dispatch('selectModelos', data: $this->dataModelo(true));
            if ($this->modelos_id) {
                $this->dispatch('setSelectModelos', id: $this->modelos_id);
            }
        }
    }

    #[On('setSelectTipos')]
    public function setSelectTipos($id)
    {
        //JS
    }

    protected function dataMarcas(): array
    {
        $marcas = Marca::orderBy('nombre', 'ASC')->get();
        return dataSelect2($marcas, 'nombre');
    }

    #[On('selectMarcas')]
    public function selectMarcas($data)
    {
        //JS
    }

    #[On('getselectMarcas')]
    public function getselectMarcas($id)
    {
        $this->marcas_id = $id;
        if ($this->tipos_id){
            $this->dispatch('selectModelos', data: $this->dataModelo(true));
            if ($this->modelos_id) {
                $this->dispatch('setSelectModelos', id: $this->modelos_id);
            }
        }
    }

    #[On('setSelectMarcas')]
    public function setSelectMarcas($id)
    {
        //JS
    }

    protected function dataColor(): array
    {
        $colores = Color::orderBy('nombre', 'ASC')->get();
        return dataSelect2($colores, 'nombre');
    }

    #[On('selectColores')]
    public function selectColores($data)
    {
        //JS
    }

    #[On('getselectColores')]
    public function getselectColores($id)
    {
        $this->colores_id = $id;
    }

    #[On('setSelectColores')]
    public function setSelectColores($id)
    {
        //JS
    }

    protected function dataCondicion(): array
    {
        $condiciones = Condicion::orderBy('nombre', 'ASC')->get();
        return dataSelect2($condiciones, 'nombre');
    }

    #[On('selectCondiciones')]
    public function selectCondiciones($data)
    {
        //JS
    }

    #[On('getselectCondiciones')]
    public function getselectCondiciones($id)
    {
        $this->condiciones_id = $id;
    }

    #[On('setSelectCondiciones')]
    public function setSelectCondiciones($id)
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

    #[On('selectModelos')]
    public function selectModelos($data)
    {
        //JS
    }

    #[On('getselectModelos')]
    public function getselectModelos($id)
    {
        $this->modelos_id = $id;
    }

    #[On('setSelectModelos')]
    public function setSelectModelos($id)
    {
        //JS
    }

}
