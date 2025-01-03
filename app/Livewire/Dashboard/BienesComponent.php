<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\BienUbicacion;
use App\Models\Equipo;
use App\Models\Imagen;
use App\Traits\LimitRows;
use App\Traits\ToastBootstrap;
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

    #[Locked]
    public $bienes_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
        $this->setSize(245);
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
        }
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

}
