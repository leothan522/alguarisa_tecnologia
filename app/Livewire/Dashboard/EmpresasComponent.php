<?php

namespace App\Livewire\Dashboard;

use App\Models\Empresa;
use App\Models\Parametro;
use App\Traits\LimitRows;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class EmpresasComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;

    public $sizeFooter = 0; //60;
    public $keyword, $btnNuevo = true, $btnCancelar = false, $title = "Ver Empresa", $form = false;

    #[Locked]
    public $empresas_id;

    public function mount()
    {
        $this->setLimit();
        $this->setSize(245);
    }

    public function render()
    {
        $empresas = Empresa::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();
        $limit = $empresas->count();

        $rows = Empresa::buscar($this->keyword)->count();

        $this->btnVerMas($limit, $rows);

        return view('livewire.dashboard.empresas-component')
            ->with('listarEmpresas', $empresas)
            ->with('rowsEmpresas', $rows);

    }

    public function limpiar()
    {
        $this->reset([
            'btnNuevo', 'btnCancelar', 'title', 'form'
        ]);
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->limpiar();
        $this->title = "Crear Empresa";
        $this->btnNuevo = false;
        $this->btnCancelar = true;
        $this->form = true;
    }

    public function cancel()
    {
        $this->limpiar();
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

    public function getEstatusEmpresa($rowquid, $idEmpresa = null): Parametro|int
    {
        $estatus = 0;
        $id = null;
        if (is_null($idEmpresa)){
            $empresa = $this->getEmpresa($rowquid);
            $id = $empresa?->id;
        }else{
            $id = $idEmpresa;
        }
        if ($id){
            $parametro = Parametro::where('nombre', 'estatus_empresa')->where('tabla_id', $id)->first();
            if ($parametro){
                if (is_null($idEmpresa)){
                    $estatus = intval($parametro->valor);
                }else{
                    $estatus = $parametro;
                }
            }
        }
        return $estatus;
    }

    public function setEstatusEmpresa($rowquid)
    {
        $empresa = $this->getEmpresa($rowquid);
        if ($empresa){
            $parametro = $this->getEstatusEmpresa($rowquid, $empresa->id);
            if ($parametro){
                if ($parametro->valor == 1){
                    $parametro->valor = 0;
                }else{
                    $parametro->valor = 1;
                }
                $parametro->save();
            }else{
                $parametro = new Parametro();
                $parametro->nombre = "estatus_empresa";
                $parametro->tabla_id = $empresa->id;
                $parametro->valor = 1;
                do{
                    $rowquid = generarStringAleatorio(16);
                    $existe = Parametro::where('rowquid', $rowquid)->first();
                }while($existe);
                $parametro->rowquid = $rowquid;
                $parametro->save();
            }
        }
    }

    protected function getEmpresa($rowquid): ?Empresa
    {
        return Empresa::where('rowquid', $rowquid)->first();
    }

}
