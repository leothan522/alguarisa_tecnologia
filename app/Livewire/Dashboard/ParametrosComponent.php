<?php

namespace App\Livewire\Dashboard;

use App\Models\Parametro;
use App\Traits\TableStyle;
use App\Traits\ToastBootstrap;
use Illuminate\Support\Sleep;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ParametrosComponent extends Component
{
    use ToastBootstrap;
    use TableStyle;

    public $view = "create", $keyword;
    public $nombre, $tabla_id, $valor;
    public $verToast = false;

    #[Locked]
    public $parametros_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $parametros = Parametro::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();

        $rows = Parametro::buscar($this->keyword)->count();
        $limit = $parametros->count();

        $this->btnVermas($limit, $rows);

        return view('livewire.dashboard.parametros-component')
            ->with('ListarParametros', $parametros)
            ->with('rows', $rows);
    }



    public function limpiar()
    {
        $this->reset([
            'parametros_id', 'nombre', 'tabla_id', 'valor', 'view', 'rowquid',
            'verToast'
        ]);
        $this->resetErrorBag();
    }

    protected function rules($id = null): array
    {
        $rules = [
            'nombre' => ['required', 'min:3', 'alpha_dash', Rule::unique('parametros', 'nombre')->ignore($id)],
            'tabla_id' => 'nullable|integer',
            'valor' => 'required_if:tabla_id,null',
        ];
        return $rules;
    }

    protected function messages(){
        return [
            'valor.required_if' => 'El campo valor es obligatorio cuando tabla id esta vacio.',
        ];
    }

    public function save()
    {

        $this->validate($this->rules($this->parametros_id));

        if (is_null($this->parametros_id)){
            //nuevo
            $parametro = new Parametro();
            $reset = true;
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Parametro::where('rowquid', '=', $rowquid)->first();
            }while($existe);
            $parametro->rowquid = $rowquid;
        }else{
            //editar
            $parametro = Parametro::find($this->parametros_id);
            $reset = false;
        }

        if ($parametro){
            $parametro->nombre = $this->nombre;
            if (!empty($this->tabla_id)){
                $parametro->tabla_id = $this->tabla_id;
            }
            $parametro->valor = $this->valor;
            $parametro->save();

            if ($reset){
                $this->reset('keyword');
            }

            $this->verToast = true;
            $this->dispatch('cerrarModal');

        }else{
            $this->limpiar();
            $this->dispatch('cerrarModal');
        }

    }

    public function edit($rowquid)
    {
        $this->limpiar();
        $parametro = $this->getParametro($rowquid);
        if ($parametro){
            $this->parametros_id = $parametro->id;
            $this->nombre = $parametro->nombre;
            $this->tabla_id = $parametro->tabla_id;
            $this->valor = $parametro->valor;
            $this->rowquid = $parametro->rowquid;
            $this->view = "edit";
        }else{
            Sleep::for(500)->millisecond();
            $this->dispatch('cerrarModal');
        }

    }

    #[On('buscar')]
    public function buscar($keyword)
    {
        $this->keyword = $keyword;
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirmToastBootstrap('delete');
    }

    #[On('delete')]
    public function delete()
    {
        $parametro = $this->getParametro($this->rowquid);
        if ($parametro){
            $parametro->delete();
            $this->limpiar();
            $this->toastBootstrap('success', 'Parametro Eliminado.');
        }
    }

    #[On('cerrarModal')]
    public function cerrarModal()
    {
        //JS
        if ($this->verToast){
            $this->toastBootstrap();
            $this->reset(['verToast']);
        }

    }

    public function cerrarBusqueda()
    {
        $this->reset('keyword');
        $this->limpiar();
    }

    protected function getParametro($rowquid): ?Parametro
    {
        return Parametro::where('rowquid', $rowquid)->first();
    }

    public function actualizar()
    {
        //Refresh
    }

}
