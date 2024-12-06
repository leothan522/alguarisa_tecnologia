<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Marca;
use App\Models\Modelo;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class MarcasComponent extends Component
{
    use ToastBootstrap;

    public $rows = 0;
    public $nombre, $keyword;
    public $form = false, $table = true;

    #[Locked]
    public $marcas_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $marcas = Marca::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get()
        ;

        $total = Marca::buscar($this->keyword)->count();

        $rowsMarcas = Marca::count();

        return view('livewire.dashboard.marcas-component')
            ->with('listarMarcas', $marcas)
            ->with('rowsMarcas', $rowsMarcas)
            ->with('totalBusqueda', $total);
    }

    public function setLimit()
    {
        if (numRowsPaginate() < 12) { $rows = 12; } else { $rows = numRowsPaginate(); }
        $this->rows = $this->rows + $rows;
    }

    #[On('limpiarMarcas')]
    public function limpiarMarcas()
    {
        $this->reset([
            'marcas_id', 'nombre', 'form', 'table', 'rowquid'
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
            'nombre'       =>  ['required', 'min:2', 'max:40'/*, 'alpha_dash:ascii'*/, Rule::unique('marcas', 'nombre')->ignore($this->marcas_id)],
        ];
        /*$messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe contener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no debe ser mayor que 15 caracteres.',
            'nombre.alpha_num' => ' El campo nombre sólo debe contener letras y números.'
        ];*/

        $this->validate($rules);
        if (is_null($this->marcas_id)){
            //nuevo
            $marca = new Marca();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Marca::where('rowquid', $rowquid)->first();
            }while($existe);
            $marca->rowquid = $rowquid;
        }else{
            //editar
            $marca = Marca::find($this->marcas_id);
        }

        if ($marca){
            $marca->nombre = $this->nombre;
            $marca->save();
            $this->dispatch('initSelects', select: 'marcas')->to(BienesComponent::class);
            $this->toastBootstrap();
        }

        $this->limpiarMarcas();
    }

    public function edit($rowquid)
    {
        $this->limpiarMarcas();
        $marca = $this->getMarca($rowquid);
        if ($marca){
            $this->marcas_id = $marca->id;
            $this->nombre = $marca->nombre;
            $this->form = true;
            $this->table = false;
        }
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirmToastBootstrap('confirmedMarcas');
    }

    #[On('confirmedMarcas')]
    public function confirmedMarcas()
    {
        $id = null;
        $marca = $this->getMarca($this->rowquid);
        if ($marca){
            $id = $marca->id;
        }

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $modelos = Modelo::where('marcas_id', $id)->first();
        $bienes = Bien::where('marcas_id', $id)->first();

        if ($modelos || $bienes){
            $vinculado = true;
        }

        if ($vinculado) {
            $this->htmlToastBoostrap();
        } else {
            if ($marca){
                $nombre = "<b>".mb_strtoupper($marca->nombre)."</b>";
                $marca->delete();
                $this->dispatch('initSelects', select: 'marcas')->to(BienesComponent::class);
                $this->toastBootstrap('success', "Marca $nombre Eliminada.");
            }
        }

        $this->limpiarMarcas();
    }

    public function buscar()
    {
        $this->limpiarMarcas();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
        $this->limpiarMarcas();
    }

    protected function getMarca($rowquid): ?Marca
    {
        return Marca::where('rowquid', $rowquid)->first();
    }

}
