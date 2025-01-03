<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Tipo;
use App\Traits\ToastBootstrap;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ModelosComponent extends Component
{
    use ToastBootstrap;

    public $rows = 0;
    public $tipos_id, $tipoRowquid, $marcas_id, $marcaRowquid, $nombre, $keyword;
    public $form = false, $table = true, $show = false, $verTipo, $verMarca;

    #[Locked]
    public $modelos_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $modelos = Modelo::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get()
        ;
        $total = Modelo::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->count();

        $rowsModelos = Modelo::count();
        return view('livewire.dashboard.modelos-component')
            ->with('listarModelos', $modelos)
            ->with('rowsModelos', $rowsModelos)
            ->with('totalBusqueda', $total);
    }

    public function setLimit()
    {
        if (numRowsPaginate() < 12) { $rows = 12; } else { $rows = numRowsPaginate(); }
        $this->rows = $this->rows + $rows;
    }

    #[On('limpiarModelos')]
    public function limpiarModelos()
    {
        $this->reset([
            'modelos_id', 'tipos_id', 'marcas_id', 'nombre', 'form', 'table', 'show', 'verTipo', 'verMarca'
        ]);
        $this->resetErrorBag();

        $tipos = Tipo::orderBy('nombre', 'ASC')->get();
        $data = getDataSelect2($tipos, 'nombre');
        $this->dispatch('modeloSelectTipos', data: $data);

        $marcas = Marca::orderBy('nombre', 'ASC')->get();
        $data = getDataSelect2($marcas, 'nombre');
        $this->dispatch('modeloSelectMarcas', data: $data);
    }

    public function create()
    {
        $this->form = true;
        $this->table = false;
    }

    public function save()
    {
        $rules = [
            'nombre'       =>  ['required', 'min:2', 'max:40',
                Rule::unique('modelos', 'nombre')
                    ->where(fn (Builder $query) =>
                    $query->where('tipos_id', $this->tipos_id)
                        ->where('marcas_id', $this->marcas_id))
                    ->ignore($this->modelos_id)],
            'tipos_id'     => 'required',
            'marcas_id'     => 'required',
        ];
        $messages = [
            'tipos_id.required' => 'El Tipo es obligatorio.',
            'marcas_id.required' => 'La Marca es obligatoria.',
            'nombre.required' => 'La Modelo es obligatorio.',
            'nombre.min' => 'El modelo debe contener al menos 2 caracteres.',
            'nombre.max' => 'El modelo no debe ser mayor que 40 caracteres.'
        ];

        $this->validate($rules, $messages);
        if (is_null($this->modelos_id)){
            //nuevo
            $modelos = new Modelo();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Modelo::where('rowquid', $rowquid)->first();
            }while($existe);
            $modelos->rowquid = $rowquid;
        }else{
            //editar
            $modelos = Modelo::find($this->modelos_id);
        }

        if ($modelos){
            $modelos->nombre = $this->nombre;
            $modelos->tipos_id = $this->tipos_id;
            $modelos->marcas_id = $this->marcas_id;
            $modelos->save();
            $this->dispatch('initSelects', select: 'modelo')->to(BienesOldComponent::class);
            $this->toastBootstrap();
        }

        $this->limpiarModelos();
    }

    public function verModel($rowquid)
    {
        $this->limpiarModelos();
        $modelos = $this->getModelo($rowquid);
        if ($modelos){
            $this->modelos_id = $modelos->id;
            $this->nombre = $modelos->nombre;
            $this->tipos_id = $modelos->tipos_id;
            $this->marcas_id = $modelos->marcas_id;
            $this->verMarca = $modelos->marca->nombre;
            $this->verTipo = $modelos->tipo->nombre;
            $this->rowquid = $modelos->rowquid;
            $this->form = false;
            $this->table = false;
            $this->show = true;
        }
    }

    public function edit($rowquid)
    {
        $this->limpiarModelos();
        $modelos = $this->getModelo($rowquid);
        if ($modelos){
            $this->modelos_id = $modelos->id;
            $this->nombre = $modelos->nombre;
            $this->tipos_id = $modelos->tipos_id;
            $this->tipoRowquid = $modelos->tipo->rowquid;
            $this->marcas_id = $modelos->marcas_id;
            $this->marcaRowquid = $modelos->marca->rowquid;
            $this->dispatch('setModeloSelectTipos', id: $this->tipoRowquid);
            $this->dispatch('setModeloSelectMarcas', id: $this->marcaRowquid);
            $this->table = false;
            $this->form = true;
        }
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirmToastBootstrap('confirmedModelos');
    }

    #[On('confirmedModelos')]
    public function confirmedModelos()
    {
        $id = null;
        $modelos = $this->getModelo($this->rowquid);
        if ($modelos){
            $id = $modelos->id;
        }

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $bienes = Bien::where('modelos_id', $id)->first();

        if ($bienes){
            $vinculado = true;
        }

        if ($vinculado) {
            $this->htmlToastBoostrap();
        } else {
            if ($modelos){
                $nombre = "<b>".mb_strtoupper($modelos->nombre)."</b>";
                $modelos->delete();
                $this->dispatch('initSelects', select: 'modelo')->to(BienesOldComponent::class);
                $this->toastBootstrap('success', "Modelo $nombre Eliminado.");
            }
        }

        $this->limpiarModelos();
    }

    public function buscar()
    {
        $this->limpiarModelos();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
        $this->limpiarModelos();
    }

    public function btnCancelar($show = false)
    {
        if (!$show){
            $this->limpiarModelos();
        }else{
            $this->verModel($this->rowquid);
        }
    }

    #[On('modeloSelectTipos')]
    public function modeloSelectTipos($data)
    {
        //JS
    }

    #[On('getModeloSelectTipos')]
    public function getModeloSelectTipos($id)
    {
        $tipo = $this->getTipo($id);
        if ($tipo){
            $this->tipos_id = $tipo->id;
        }
    }

    #[On('setModeloSelectTipos')]
    public function setModeloSelectTipos($id)
    {
        //JS
    }

    #[On('modeloSelectMarcas')]
    public function modeloSelectMarcas($data)
    {
        //JS
    }

    #[On('getModeloSelectMarcas')]
    public function getModeloSelectMarcas($id)
    {
        $marca = $this->getMarca($id);
        if ($marca){
            $this->marcas_id = $marca->id;
        }
    }

    #[On('setModeloSelectMarcas')]
    public function setModeloSelectMarcas($id)
    {
        //JS
    }

    protected function getTipo($rowquid): ?Tipo
    {
        return Tipo::where('rowquid', $rowquid)->first();
    }

    protected function getMarca($rowquid): ?Marca
    {
        return Marca::where('rowquid', $rowquid)->first();
    }

    protected function getModelo($rowquid): ?Modelo
    {
        return Modelo::where('rowquid', $rowquid)->first();
    }

}
