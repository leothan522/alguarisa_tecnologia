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
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class BienesComponent extends Component
{
    use LivewireAlert;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $view = true, $form = false, $ver = false, $nuevo = false, $editar = false, $cancelar = false, $footer = false, $keyword;
    public $tipos_id, $marcas_id, $modelos_id, $colores_id, $serial, $identificador, $condiciones_id, $adicional;
    public $verTipo, $verMarca, $verModelo, $verColor, $verCondicion, $verUbicacion;
    public $imagenes = false, $imagenFrontal, $imagenPosterior, $miniFrontal, $miniPosterior, $imagenTitle, $imagenFooter;
    public $busqueda, $totalBusqueda;

    #[Locked]
    public $bienes_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $bienes = $this->listarBienes();
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

    public function listarBienes()
    {
        if (empty($this->busqueda)){
            $bienes = Bien::buscar($this->keyword)
                ->orderBy('created_at', 'DESC')
                ->limit($this->rows)
                ->get();
            $bienes->each(function ($bien) {
                $bien->verTipo = $bien->tipo->nombre;
                $bien->verMarca = $bien->marca->nombre;
                $bien->verModelo = $bien->modelo->nombre;
            });
            $this->totalBusqueda = Bien::buscar($this->keyword)->count();
        }else{
            $tipo = $this->busqueda['tipo'];
            $marca = $this->busqueda['marca'];
            $modelo = $this->busqueda['modelo'];
            $color = $this->busqueda['color'];
            $condicion = $this->busqueda['condicion'];
            $serial = $this->busqueda['serial'];
            $identidicador = $this->busqueda['identificador'];

            $bienes = DB::table('bienes')
                ->when($tipo, function (Builder $query, string $tipo) {
                    $query->where('tipos_id', $tipo);
                })
                ->when($marca, function (Builder $query, string $marca) {
                    $query->where('marcas_id', $marca);
                })
                ->when($modelo, function (Builder $query, string $modelo) {
                    $query->where('modelos_id', $modelo);
                })
                ->when($color, function (Builder $query, string $color) {
                    $query->where('colores_id', $color);
                })
                ->when($condicion, function (Builder $query, string $condicion) {
                    $query->where('condiciones_id', $condicion);
                })
                ->when($condicion, function (Builder $query, string $condicion) {
                    $query->where('condiciones_id', $condicion);
                })
                ->whereNull('deleted_at')
                ->orderBy('created_at', 'DESC')
                ->limit($this->rows)
                ->get();

            $bienes->each(function ($bien) {
                $tipo = Tipo::find($bien->tipos_id);
                $bien->verTipo = $tipo->nombre;
                $marca = Marca::find($bien->marcas_id);
                $bien->verMarca = $marca->nombre;
                $modelo = Modelo::find($bien->modelos_id);
                $bien->verModelo = $modelo->nombre;
            });

            $this->totalBusqueda = DB::table('bienes')
                ->when($tipo, function (Builder $query, string $tipo) {
                    $query->where('tipos_id', $tipo);
                })
                ->when($marca, function (Builder $query, string $marca) {
                    $query->where('marcas_id', $marca);
                })
                ->when($modelo, function (Builder $query, string $modelo) {
                    $query->where('modelos_id', $modelo);
                })
                ->when($color, function (Builder $query, string $color) {
                    $query->where('colores_id', $color);
                })
                ->when($condicion, function (Builder $query, string $condicion) {
                    $query->where('condiciones_id', $condicion);
                })
                ->when($condicion, function (Builder $query, string $condicion) {
                    $query->where('condiciones_id', $condicion);
                })
                ->whereNull('deleted_at')
                ->count();
        }
        return $bienes;
    }

    public function limpiar()
    {
        $this->reset([
            'view', 'form', 'ver', 'nuevo', 'editar', 'cancelar', 'footer',
            'tipos_id', 'marcas_id', 'modelos_id', 'colores_id', 'serial', 'identificador', 'condiciones_id', 'adicional',
            'verTipo', 'verMarca', 'verModelo', 'verColor', 'verCondicion', 'verUbicacion',
            'imagenes', 'imagenFrontal', 'imagenPosterior', 'miniFrontal', 'miniPosterior', 'rowquid'
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

    #[On('showBien')]
    public function show($rowquid)
    {
        $this->limpiar();
        $this->reset(['bienes_id']);
        $bien = $this->getBien($rowquid);
        if ($bien){
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
            $this->rowquid = $bien->rowquid;

            $this->view = false;
            $this->ver = true;
            $this->editar = true;
            $this->footer = true;

            $imagen = Imagen::where('bienes_id', $this->bienes_id)->where('nombre', 'frontal')->first();
            if ($imagen){
                $this->imagenFrontal = $imagen->imagen;
                $this->miniFrontal = $imagen->mini;
            }

            $imagen = Imagen::where('bienes_id', $this->bienes_id)->where('nombre', 'posterior')->first();
            if ($imagen){
                $this->imagenPosterior = $imagen->imagen;
                $this->miniPosterior = $imagen->mini;
            }

            $ubicaciones = BienUbicacion::where('bienes_id', $this->bienes_id)->orderBy('created_at', 'DESC')->first();
            if ($ubicaciones){
                $this->verUbicacion = $ubicaciones->ubicacion->nombre;
            }
        }

    }

    public function rules(): array
    {
        return [
            'serial'       =>  [
                'nullable',
                'alpha_dash:ascii',
                Rule::requiredIf(empty($this->identificador)),
                'max:50',
                Rule::unique('bienes', 'serial')
                    ->ignore($this->bienes_id)
            ],
            'identificador' =>  [
                'nullable',
                'alpha_dash:ascii',
                Rule::requiredIf(empty($this->serial)),
                'max:50',
                Rule::unique('bienes', 'identificador')
                    ->ignore($this->bienes_id)
            ],
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
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Bien::where('rowquid', $rowquid)->first();
            }while($existe);
            $bien->rowquid = $rowquid;
        }

        if ($bien){

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
                $this->setSerial();
            }

            $this->serial = $serial;
            $this->show($bien->rowquid);
            $this->reset('keyword');
            $this->alert('success', 'Datos Guardados. ');

        }else{
            $this->limpiar();
        }

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

            if ($bien){
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
                $this->alert('success', 'Registro Eliminado.');
                $this->reset('keyword');
            }

            $this->limpiar();
        }
    }

    public function btnCancelar()
    {
        if ($this->rowquid){
            $this->show($this->rowquid);
        }else{
            $this->limpiar();
        }
    }

    public function btnImagenes()
    {
        $bien = Bien::find($this->bienes_id);
        if ($bien){
            $this->ver = false;
            $this->cancelar = true;
            $this->imagenes = true;
            $this->dispatch('showImagenes', id: $this->bienes_id)->to(ImagenesComponent::class);
        }else{
            $this->reset(['bienes_id']);
            $this->limpiar();
        }
    }

    public function btnUbicacion()
    {
        $bien = Bien::find($this->bienes_id);
        if ($bien){
            $this->dispatch('getBienesUbicaciones', bienID: $this->bienes_id)->to(ModalUbicacionesComponent::class);
        }else{
            $this->reset(['bienes_id']);
            $this->limpiar();
            $this->dispatch('cerrarModalPropiedades', selector: 'btn_modal_bienes_propiedad_ubicacion');
        }
    }

    public function btnOficios()
    {
        $bien = Bien::find($this->bienes_id);
        if ($bien){
            $this->dispatch('getBienesOficios', bienID: $this->bienes_id)->to(ModalOficiosVinculadosComponent::class);
        }else{
            $this->reset(['bienes_id']);
            $this->limpiar();
            $this->dispatch('cerrarModalPropiedades', selector: 'btn_modal_vinculados_cerrar');
        }
    }

    #[On('buscar')]
    public function buscar($keyword)
    {
        $this->reset(['busqueda', 'totalBusqueda']);
        $this->keyword = $keyword;
    }

    public function limpiarBuscar()
    {
        $this->reset(['keyword', 'busqueda', 'totalBusqueda']);
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

    #[On('busquedaAvanzada')]
    public function busquedaAvanzada($data)
    {
        $this->reset('keyword');
        $this->busqueda = $data;
    }

    #[On('cerrarModalPropiedades')]
    public function cerrarModalPropiedades($selector)
    {
        //JS
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

    protected function getBien($rowquid): ?Bien
    {
        return Bien::where('rowquid', $rowquid)->first();
    }

}
