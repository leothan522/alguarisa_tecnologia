<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Tipo;
use App\Traits\LimitRows;
use App\Traits\ModalTable;
use App\Traits\ToastBootstrap;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class ModelosComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;
    use ModalTable;

    public $nombre, $tipo, $marca;

    public function mount()
    {
        $this->setLimit();
        $this->setSize(483);
        $this->modalTitle = "Modelos";
        $this->confirmed = 'deleteModelos';
        $this->modulo = 'modelos';
    }

    public function render()
    {
        $listar = Modelo::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();
        $limit = $listar->count();
        $rows = Modelo::buscar($this->keyword)->count();
        $this->btnVerMas($limit, $rows);

        return view('livewire.dashboard.modelos-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->limpiarModal();
        $this->reset([
            'nombre', 'tipo', 'marca',
        ]);

        $tipos = Tipo::orderBy('nombre', 'ASC')->get();
        $data = getDataSelect2($tipos, 'nombre');
        $this->dispatch('initModeloTipos', data: $data);

        $marcas = Marca::orderBy('nombre', 'ASC')->get();
        $data = getDataSelect2($marcas, 'nombre');
        $this->dispatch('initModeloMarcas', data: $data);

    }

    public function save()
    {
        $rules = [
            'nombre' => ['required', 'min:2', 'max:50',
                Rule::unique('modelos', 'nombre')
                    ->where(fn (Builder $query) => $query->where('tipos_id', $this->tipo)->where('marcas_id', $this->marca))
                    ->ignore($this->tabla_id)],
            'tipo' => 'required',
            'marca' => 'required',
        ];
        $this->validate($rules);

        if ($this->tabla_id){
            //editar
            $model = Modelo::find($this->tabla_id);
        }else{
            //nuevo
            $model = new Modelo();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Modelo::where('rowquid', $rowquid)->first();
            }while($existe);
            $model->rowquid = $rowquid;
        }

        if ($model){
            $model->nombre = $this->nombre;
            $model->tipos_id = $this->tipo;
            $model->marcas_id = $this->marca;
            $model->save();
            $this->limpiar();
            $this->toastBootstrap();
        }
    }

    public function edit($rowquid)
    {
        $this->limpiar();
        $registro = $this->getRegistro($rowquid);
        if ($registro){
            $this->tabla_id = $registro->id;
            $this->ocultarTable = true;
            $this->ocultarCard = false;
            $this->nombre = $registro->nombre;
            $this->tipo = $registro->tipos_id;
            $this->marca = $registro->marcas_id;
            $this->dispatch('setModeloTipos', rowquid: $registro->tipo->rowquid);
            $this->dispatch('setModeloMarcas', rowquid: $registro->marca->rowquid);
        }
    }

    #[On('deleteModelos')]
    public function delete($rowquid)
    {
        $this->limpiar();
        $registro = $this->getRegistro($rowquid);
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            $bienes = Bien::where('modelos_id', $registro->id)->first();

            if ($bienes){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-uppercase text-warning">'.$registro->nombre.'</b>';
                $registro->delete();
                $this->toastBootstrap('success', "Modelo $nombre Eliminado.");
            }

        }
    }

    #[On('initModeloTipos')]
    public function initModeloTipos($data)
    {
        //JS
    }

    #[On('getModeloTipos')]
    public function getModeloTipos($rowquid)
    {
        $tipo = $this->getTipo($rowquid);
        if ($tipo){
            $this->tipo = $tipo->id;
        }
    }

    #[On('setModeloTipos')]
    public function setModeloTipos($rowquid)
    {
        //JS
    }

    #[On('initModeloMarcas')]
    public function initModeloMarcas($data)
    {
        //JS
    }

    #[On('getModeloMarcas')]
    public function getModeloMarcas($rowquid)
    {
        $marca = $this->getMarca($rowquid);
        if ($marca){
            $this->marca = $marca->id;
        }
    }

    #[On('setModeloMarcas')]
    public function setModeloMarcas($rowquid)
    {
        //JS
    }

    protected function getRegistro($rowquid): ?Modelo
    {
        return Modelo::where('rowquid', $rowquid)->first();
    }

    protected function getTipo($rowquid): ?Tipo
    {
        return Tipo::where('rowquid', $rowquid)->first();
    }

    protected function getMarca($rowquid): ?Marca
    {
        return Marca::where('rowquid', $rowquid)->first();
    }

}
