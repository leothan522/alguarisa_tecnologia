<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Color;
use App\Models\Condicion;
use App\Models\Equipo;
use App\Models\Imagen;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Oficio;
use App\Models\Parametro;
use App\Models\Tipo;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class BienesComponent extends Component
{
    use LivewireAlert;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $view = true, $form = false, $ver = false, $nuevo = false, $editar = false, $cancelar = false, $footer = false, $keyword;
    public $tipos_id, $marcas_id, $modelos_id, $colores_id, $serial, $identificador, $condiciones_id, $adicional;
    public $bienes_id, $verTipo, $verMarca, $verModelo, $verColor, $verCondicion;
    public $imagenes = false, $imagenFrontal, $imagenPosterior;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $bienes = Bien::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get();
        $rowsBienes = Bien::count();

        if ($rowsBienes > $this->numero) {
            $this->tableStyle = true;
        }
        return view('livewire.dashboard.bienes-component')
            ->with('listarBienes', $bienes)
            ->with('total', $rowsBienes);
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
            'view', 'form', 'ver', 'nuevo', 'editar', 'cancelar', 'footer',
            'tipos_id', 'marcas_id', 'modelos_id', 'colores_id', 'serial', 'identificador', 'condiciones_id', 'adicional',
            'verTipo', 'verMarca', 'verModelo', 'verColor', 'verCondicion',
            'imagenes', 'imagenFrontal', 'imagenPosterior'
        ]);
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->limpiar();
        $this->view = false;
        $this->form = true;
        $this->nuevo = true;
        $this->cancelar = true;
        $this->ver = false;
        $this->initSelects();
    }

    public function show($id)
    {
        $this->limpiar();
        $bien = Bien::find($id);
        $this->bienes_id = $bien->id;
        $this->tipos_id = $bien->tipos_id;
        $this->verTipo = $bien->tipo->nombre;
        $this->marcas_id = $bien->marcas_id;
        $this->verMarca = $bien->marca->nombre;
        $this->modelos_id = $bien->modelos_id;
        $this->verModelo = $bien->modelo->nombre;
        $this->colores_id = $bien->colores_id;
        $this->verColor = $bien->color->nombre;
        $this->serial = $bien->serial;
        $this->identificador = $bien->identificador;
        $this->condiciones_id = $bien->condiciones_id;
        $this->verCondicion = $bien->condicion->nombre;
        $this->adicional = $bien->adicional;
        $this->view = false;
        $this->ver = true;
        $this->editar = true;
        $this->footer = true;

        $imagen = Imagen::where('bienes_id', $id)->where('nombre', 'frontal')->first();
        if ($imagen){
            $this->imagenFrontal = $imagen->mini;
        }

        $imagen = Imagen::where('bienes_id', $id)->where('nombre', 'posterior')->first();
        if ($imagen){
            $this->imagenPosterior = $imagen->mini;
        }

    }

    public function rules()
    {
        return [
            'serial'       =>  [
                'nullable',
                'alpha_dash:ascii',
                Rule::requiredIf(empty($this->identificador)),
                'max:50',
                Rule::unique('bienes', 'serial')
                    ->ignore($this->bienes_id)],
            'identificador' =>  [
                'nullable',
                'alpha_dash:ascii',
                Rule::requiredIf(empty($this->serial)),
                'max:50',
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

        $this->serial = str_replace('/', '_-_', $this->serial);

        $this->validate();

        $this->serial = str_replace('_-_', '/', $this->serial);

        if ($this->serial == '_'){
            $serial = nextCodigo('sin_serial', null, 'S/S-');
        }else{
            if (!empty($this->serial)){
                $serial = $this->serial;
            }else{
                $serial = null;
            }
        }

        if (empty($this->identificador)){
            $this->identificador = null;
        }

        if ($this->bienes_id && !$this->nuevo){
            $bien = Bien::find($this->bienes_id);
            if (is_null($bien->auditoria)){
                $auditoria = "[ 'accion' => 'edit', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
            }else{
                $auditoria = $bien->auditoria.", [ 'accion' => 'edit', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
            }
        }else{
            $bien = new Bien();
            $auditoria = "[ 'accion' => 'create', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
        }

        $bien->tipos_id = $this->tipos_id;
        $bien->marcas_id = $this->marcas_id;
        $bien->modelos_id = $this->modelos_id;
        $bien->colores_id = $this->colores_id;
        $bien->serial = $serial;
        $bien->identificador = $this->identificador;
        $bien->condiciones_id = $this->condiciones_id;
        $bien->adicional = $this->adicional;
        $bien->auditoria = $auditoria;
        $bien->save();

        if ($this->serial == '_'){
            $parametro = Parametro::where('nombre', 'sin_serial')->first();
            if ($parametro){
                $num = $parametro->tabla_id + 1;
                $parametro->tabla_id = $num;
            }else{
                $parametro = new Parametro();
                $parametro->nombre = 'sin_serial';
                $parametro->tabla_id = 2;
                $parametro->valor = 'S/S-';
            }
            $parametro->save();
        }

        $this->serial = $serial;
        $this->show($bien->id);
        $this->reset('keyword');
        $this->alert('success', 'Datos Guardados. ');
    }

    public function edit()
    {
        $this->ver = false;
        $this->imagenes = false;
        $this->editar = false;
        $this->footer = false;
        $this->form = true;
        $this->cancelar = true;
        $this->initSelects();
    }

    public function destroy()
    {
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
        ]);
    }

    #[On('confirmed')]
    public function confirmed()
    {
        $bien = Bien::find($this->bienes_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $oficios = Equipo::where('bienes_id', $this->bienes_id)->first();
        if ($oficios){
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
            $bien->delete();
            $this->alert(
                'success',
                'Registro Eliminado.'
            );
            $this->limpiar();
            $this->reset('keyword');
        }
    }

    public function btnCancelar()
    {
        if ($this->bienes_id){
            $this->show($this->bienes_id);
        }else{
            $this->limpiar();
        }
    }

    public function btnImagenes()
    {
        $this->ver = false;
        $this->cancelar = true;
        $this->imagenes = true;
        $this->dispatch('showImagenes', id: $this->bienes_id)->to(ImagenesComponent::class);
    }

    public function btnUbicacion()
    {
        $this->dispatch('getBienesUbicaciones', bienID: $this->bienes_id)->to(ModalUbicacionesComponent::class);
    }

    public function btnOficios()
    {
        $this->dispatch('getBienesOficios', bienID: $this->bienes_id)->to(ModalOficiosVinculadosComponent::class);
    }

    #[On('buscar')]
    public function buscar($keyword)
    {
        $this->keyword = $keyword;
    }

    public function limpiarBuscar()
    {
        $this->reset('keyword');
        $this->btnCancelar();
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
        $condiciones = Condicion::get();
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
