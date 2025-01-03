<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\BienUbicacion;
use App\Models\Color;
use App\Models\Condicion;
use App\Models\Equipo;
use App\Models\Imagen;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Parametro;
use App\Models\Tipo;
use App\Traits\LimitRows;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class BienesComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;

    public $sizeFooter = 55; //60;
    public $ocultarTable = false, $ocultarCard = false;
    public $keyword, $btnNuevo = true, $btnCancelar = false, $btnEditar = true, $title = "Ver Bienes", $form = false;
    public $verTipo, $verMarca, $verModelo, $verColor, $verSerial, $verIdentificador, $verCondicion, $verUbicacion, $verAdicional;
    public $imagenes = false, $imagenFrontal, $imagenPosterior, $miniFrontal, $miniPosterior;
    public $tipo, $marca, $modelo, $color, $serial, $identificador, $condicion, $adicional;

    #[Locked]
    public $bienes_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
        $this->setSize(250);
        $this->lastBien();
    }

    public function render()
    {
        $bienes = Bien::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();
        $limit = $bienes->count();
        $rows = Bien::buscar($this->keyword)->count();
        $this->btnVerMas($limit, $rows);

        return view('livewire.dashboard.bienes-component')
            ->with('listar', $bienes)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->reset([
            'btnNuevo', 'btnCancelar', 'btnEditar', 'title', 'form',
            'verTipo', 'verMarca', 'verModelo', 'verColor', 'verSerial', 'verIdentificador', 'verCondicion', 'verUbicacion', 'verAdicional',
            'imagenes', 'imagenFrontal', 'imagenPosterior', 'miniFrontal', 'miniPosterior',
            'tipo', 'marca', 'modelo', 'color', 'serial', 'identificador', 'condicion', 'adicional',
            'bienes_id',
        ]);
        $this->resetErrorBag();
    }

    public function show($rowquid)
    {
        $this->setSizeFooter();
        $this->limpiar();
        $bien = $this->getBien($rowquid);
        if ($bien){
            $this->verTipo = $bien->tipo->nombre;
            $this->verMarca = $bien->marca->nombre;
            $this->verModelo = $bien->modelo->nombre;
            $this->verColor = $bien->color->nombre;
            $this->verSerial = $bien->serial;
            $this->verIdentificador = $bien->identificador;
            $this->verCondicion = $bien->condicion->nombre;
            $this->verAdicional = $bien->adicional;

            $ubicaciones = BienUbicacion::where('bienes_id', $bien->id)->orderBy('created_at', 'DESC')->first();
            if ($ubicaciones){
                $this->verUbicacion = $ubicaciones->ubicacion->nombre;
            }

            $imagen = Imagen::where('bienes_id', $bien->id)->where('nombre', 'frontal')->first();
            if ($imagen){
                $this->imagenFrontal = $imagen->imagen;
                $this->miniFrontal = $imagen->mini;
            }

            $imagen = Imagen::where('bienes_id', $bien->id)->where('nombre', 'posterior')->first();
            if ($imagen){
                $this->imagenPosterior = $imagen->imagen;
                $this->miniPosterior = $imagen->mini;
            }

            $this->bienes_id = $bien->id;
            $this->rowquid = $bien->rowquid;
            $this->tipo = $bien->tipos_id;
            $this->marca = $bien->marcas_id;
            $this->modelo = $bien->modelos_id;
            $this->color = $bien->colores_id;
            $this->serial = $bien->serial;
            $this->identificador = $bien->identificador;
            $this->condicion = $bien->condiciones_id;
            $this->adicional = $bien->adicional;

        }
    }

    public function create()
    {
        $this->limpiar();
        $this->title = "Registrar Bienes";
        $this->btnNuevo = false;
        $this->btnCancelar = true;
        $this->btnEditar = false;
        $this->form = true;
        $this->sizeFooter = 0;
        $this->initSelects();
    }

    public function save()
    {
        $rules = [
            'serial'        =>  ['nullable', 'alpha_dash:ascii', Rule::requiredIf(empty($this->identificador)), 'max:50', Rule::unique('bienes', 'serial')->ignore($this->bienes_id)],
            'identificador' =>  ['nullable', 'alpha_dash:ascii', Rule::requiredIf(empty($this->serial)), 'max:50', Rule::unique('bienes', 'identificador')->ignore($this->bienes_id)],
            'tipo'          => 'required',
            'marca'         => 'required',
            'modelo'        => 'required',
            'color'         => 'required',
            'condicion'     => 'required',
        ];

        $this->serial = str_replace('/', '_-_', $this->serial);
        $this->validate($rules);
        $this->serial = str_replace('_-_', '/', $this->serial);
        $this->validate(['serial'   =>  Rule::unique('bienes', 'serial')->ignore($this->bienes_id)]);

        if ($this->serial == '_'){
            $serial = $this->getSerial();
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

        if ($this->bienes_id){
            //editar
            $bien = Bien::find($this->bienes_id);
            if (is_null($bien->auditoria)){
                $auditoria = "[ 'accion' => 'edit', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
            }else{
                $auditoria = $bien->auditoria.", [ 'accion' => 'edit', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
            }
        }else{
            //nuevo
            $bien = new Bien();
            $auditoria = "[ 'accion' => 'create', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Bien::where('rowquid', $rowquid)->first();
            }while($existe);
            $bien->rowquid = $rowquid;
        }

        if ($bien){
            $bien->tipos_id = $this->tipo;
            $bien->marcas_id = $this->marca;
            $bien->modelos_id = $this->modelo;
            $bien->colores_id = $this->color;
            $bien->serial = $serial;
            $bien->identificador = $this->identificador;
            $bien->condiciones_id = $this->condicion;
            $bien->adicional = $this->adicional;
            $bien->auditoria = $auditoria;
            $bien->save();

            if ($this->serial == '_'){
                $this->setSerial();
            }
            $this->reset('keyword');
            $this->show($bien->rowquid);
            $this->toastBootstrap();
        }
    }

    public function edit()
    {
        $this->title = "Editar Bienes";
        $this->btnNuevo = true;
        $this->btnCancelar = true;
        $this->btnEditar = false;
        $this->form = true;
        $this->sizeFooter = 0;
        $this->initSelects();
    }

    #[On('deleteBienes')]
    public function delete($rowquid)
    {
        $bien = $this->getBien($rowquid);
        if ($bien){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            $oficios = Equipo::where('bienes_id', $bien->id)->first();
            if ($oficios){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {

                if (!empty($bien->serial)){
                    $bien->serial = "*".$bien->serial;
                }

                if (!empty($bien->identificador)){
                    $bien->identificador = "*".$bien->identificador;
                }

                if (is_null($bien->auditoria)){
                    $auditoria = "[ 'accion' => 'delete', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
                }else{
                    $auditoria = $bien->auditoria.", [ 'accion' => 'delete', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
                }

                $bien->auditoria = $auditoria;
                $bien->save();
                $bien->delete();
                $this->lastBien();
                $this->toastBootstrap('success', 'Registro Eliminado.');
            }
        }
    }

    #[On('buscar')]
    public function buscar($keyword)
    {
        $this->keyword = $keyword;
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
    }

    public function actualizar()
    {
        //refresh
    }

    public function cancel()
    {
        if ($this->rowquid){
            $this->show($this->rowquid);
        }else{
            $this->create();
        }
    }

    public function btnImagenes()
    {
        $this->title = "Cambiar Imagenes";
        $this->btnNuevo = false;
        $this->btnEditar = false;
        $this->btnCancelar = true;
        $this->imagenes = true;
        $this->sizeFooter = 0;
        $this->dispatch('initImagenes', id: $this->bienes_id)->to(BienesImagenesComponent::class);
    }

    #[On('cerrarImagenes')]
    public function cerrarImagenes()
    {
        $this->cancel();
    }

    protected function setSizeFooter()
    {
        if ($this->ocultarTable){
            $this->sizeFooter = 125;
        }else{
            $this->sizeFooter = 55;
        }
    }

    protected function getBien($rowquid): ?Bien
    {
        return Bien::where('rowquid', $rowquid)->first();
    }

    protected function lastBien()
    {
        $bien = Bien::orderBy('created_at', 'DESC')->first();
        if ($bien){
            $this->show($bien->rowquid);
        }
    }

    protected function getSerial(): string
    {
        $parametro = Parametro::where('nombre', 'sin_serial')->first();
        if ($parametro){
            $numero = $parametro->tabla_id;
            $formato = $parametro->valor;
        }else{
            $numero = 1;
            $formato = 'S/S-';
        }
        return $formato . cerosIzquierda($numero, numSizeCodigo());
    }

    protected function setSerial(): void
    {
        $parametro = Parametro::where('nombre', 'sin_serial')->first();
        if ($parametro){
            $num = $parametro->tabla_id + 1;
            $parametro->tabla_id = $num;
        }else{
            $parametro = new Parametro();
            $parametro->nombre = 'sin_serial';
            $parametro->tabla_id = 2;
            $parametro->valor = 'S/S-';
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Parametro::where('rowquid', $rowquid)->first();
            }while($existe);
            $parametro->rowquid = $rowquid;
        }
        $parametro->save();
    }

    #[On('initSelects')]
    public function initSelects($select = null)
    {
        switch ($select) {

            case 'tipos';
                $this->dispatch('selectTipos', data: $this->dataTipos());
                if ($this->tipo) {
                    $this->dispatch('setSelectTipos', id: $this->tipo);
                }
                break;

            case 'marcas';
                $this->dispatch('selectMarcas', data: $this->dataMarcas());
                if ($this->marca) {
                    $this->dispatch('setSelectMarcas', id: $this->marca);
                }
                break;

            case 'color':
                $this->dispatch('selectColores', data: $this->dataColor());
                if ($this->color) {
                    $this->dispatch('setSelectColores', id: $this->color);
                }
                break;

            case 'condicion':
                $this->dispatch('selectCondiciones', data: $this->dataCondicion());
                if ($this->condicion) {
                    $this->dispatch('setSelectCondiciones', id: $this->condicion);
                }
                break;

            case 'modelo':
                if ($this->tipo && $this->marca){
                    $data = $this->dataModelo(true);
                }else{
                    $data = $this->dataModelo();
                }
                $this->dispatch('selectModelos', data: $data);
                if ($this->modelo) {
                    $this->dispatch('setSelectModelos', id: $this->modelo);
                }
                break;

            default:

                $this->dispatch('selectTipos', data: $this->dataTipos());
                if ($this->tipo) {
                    $this->dispatch('setSelectTipos', id: $this->tipo);
                }

                $this->dispatch('selectMarcas', data: $this->dataMarcas());
                if ($this->marca) {
                    $this->dispatch('setSelectMarcas', id: $this->marca);
                }

                $this->dispatch('selectColores', data: $this->dataColor());
                if ($this->color) {
                    $this->dispatch('setSelectColores', id: $this->color);
                }

                $this->dispatch('selectCondiciones', data: $this->dataCondicion());
                if ($this->condicion) {
                    $this->dispatch('setSelectCondiciones', id: $this->condicion);
                }

                if ($this->tipo && $this->marca){
                    $data = $this->dataModelo(true);
                }else{
                    $data = $this->dataModelo();
                }
                $this->dispatch('selectModelos', data: $data);
                if ($this->modelo) {
                    $this->dispatch('setSelectModelos', id: $this->modelo);
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
        $this->tipo= $id;
        if ($this->marca){
            $this->dispatch('selectModelos', data: $this->dataModelo(true));
            if ($this->modelo) {
                $this->dispatch('setSelectModelos', id: $this->modelo);
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
        $this->marca = $id;
        if ($this->tipo){
            $this->dispatch('selectModelos', data: $this->dataModelo(true));
            if ($this->modelo) {
                $this->dispatch('setSelectModelos', id: $this->modelo);
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
        $this->color = $id;
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
        $this->condicion = $id;
    }

    #[On('setSelectCondiciones')]
    public function setSelectCondiciones($id)
    {
        //JS
    }

    protected function dataModelo($filtrar = false): array
    {
        if ($filtrar){
            $modelos = Modelo::where('tipos_id', $this->tipo)
                ->where('marcas_id', $this->marca)
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
        $this->modelo = $id;
    }

    #[On('setSelectModelos')]
    public function setSelectModelos($id)
    {
        //JS
    }

}
