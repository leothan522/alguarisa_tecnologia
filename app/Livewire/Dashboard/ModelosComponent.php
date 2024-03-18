<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Color;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Tipo;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ModelosComponent extends Component
{
    use LivewireAlert;

    public $rows = 0;
    public $modelos_id, $tipos_id, $marcas_id, $nombre, $keyword;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $modelos = Modelo::buscar($this->keyword)
            ->limit($this->rows)
            ->orderBy('id', 'DESC')
            ->get()
        ;
        $rowsModelos = Modelo::count();
        return view('livewire.dashboard.modelos-component')
            ->with('listarModelos', $modelos)
            ->with('rowsModelos', $rowsModelos);
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
            'modelos_id', 'tipos_id', 'marcas_id', 'nombre', 'keyword'
        ]);
        $this->resetErrorBag();

        $tipos = Tipo::orderBy('nombre', 'ASC')->get();
        $data = dataSelect2($tipos, 'nombre');
        $this->dispatch('modeloSelectTipos', data: $data);

        $marcas = Marca::orderBy('nombre', 'ASC')->get();
        $data = dataSelect2($marcas, 'nombre');
        $this->dispatch('modeloSelectMarcas', data: $data);
    }

    public function save()
    {
        $rules = [
            'nombre'       =>  ['required', 'min:2', 'max:20',
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
            'nombre.max' => 'El modelo no debe ser mayor que 20 caracteres.'
        ];

        $this->validate($rules, $messages);
        if (is_null($this->modelos_id)){
            //nuevo
            $modelos = new Modelo();
            $message = "Modelo Creado.";
        }else{
            //editar
            $modelos = Modelo::find($this->modelos_id);
            $message = "Modelo Actualizado.";
        }
        $modelos->nombre = $this->nombre;
        $modelos->tipos_id = $this->tipos_id;
        $modelos->marcas_id = $this->marcas_id;
        $modelos->save();
        $this->dispatch('initSelects', select: 'modelo')->to(BienesComponent::class);
        $this->limpiarModelos();
        $this->alert('success', $message);
    }

    public function edit($id)
    {
        $modelos = Modelo::find($id);
        $this->modelos_id = $modelos->id;
        $this->nombre = $modelos->nombre;
        $this->tipos_id = $modelos->tipos_id;
        $this->marcas_id = $modelos->marcas_id;
        $this->dispatch('setModeloSelectTipos', id: $this->tipos_id);
        $this->dispatch('setModeloSelectMarcas', id: $this->marcas_id);
    }

    public function destroy($id)
    {
        $this->modelos_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedModelos',
        ]);
    }

    #[On('confirmedModelos')]
    public function confirmedModelos()
    {
        $modelos = Modelo::find($this->modelos_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $bienes = Bien::where('modelos_id', $this->modelos_id)->first();

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
            $modelos->delete();
            $this->alert(
                'success',
                'Modelos Eliminado.'
            );
            $this->dispatch('initSelects', select: 'modelo')->to(BienesComponent::class);
        }

        $this->limpiarModelos();
    }

    public function buscar()
    {
        //
    }

    #[On('modeloSelectTipos')]
    public function modeloSelectTipos($data)
    {
        //JS
    }

    #[On('getModeloSelectTipos')]
    public function getModeloSelectTipos($id)
    {
        $this->tipos_id = $id;
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
        $this->marcas_id = $id;
    }

    #[On('setModeloSelectMarcas')]
    public function setModeloSelectMarcas($id)
    {
        //JS
    }

}
