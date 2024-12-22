<?php

namespace App\Livewire\Dashboard;

use App\Models\Empresa;
use App\Models\Imagen;
use App\Models\Parametro;
use App\Traits\Imagenes;
use App\Traits\LimitRows;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmpresasComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;
    use WithFileUploads;
    use Imagenes;

    public $sizeFooter = 0; //60;
    public $keyword, $btnNuevo = true, $btnCancelar = false, $title = "Ver Empresa", $form = false, $btnImgBorrar = false;
    public $nombre, $rif, $jefe, $moneda, $telefonos, $email, $direccion, $default = 0;
    public $imagen, $mini, $imgID, $photo, $imgBorrar = false;

    #[Locked]
    public $empresas_id, $rowquid, $empresaDefault;

    public function mount()
    {
        $this->setLimit();
        $this->setSize(245);
        $default = $this->getEmpresaDefault();
        if ($default){
            $this->show($default->rowquid);
            $this->empresas_id = $default->id;
            $this->empresaDefault = $default->id;
        }
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

        if (empty($this->empresaDefault)){
            $this->create();
            $this->default = 1;
        }

        return view('livewire.dashboard.empresas-component')
            ->with('listarEmpresas', $empresas)
            ->with('rowsEmpresas', $rows);

    }

    public function limpiar()
    {
        $this->reset([
            'btnNuevo', 'btnCancelar', 'title', 'form', 'btnImgBorrar',
            'nombre', 'rif', 'jefe', 'moneda', 'telefonos', 'email', 'direccion', 'default',
            'imagen','mini', 'imgID', 'photo', 'imgBorrar'
        ]);
        $this->resetErrorBag();
        $this->setSaveImagen(false);
    }

    public function show($rowquid)
    {
        $this->limpiar();
        $empresa = $this->getEmpresa($rowquid);
        if ($empresa){
            $this->empresas_id = $empresa->id;
            $this->rowquid = $empresa->rowquid;
            $this->nombre = $empresa->nombre;
            $this->rif = $empresa->rif;
            $this->jefe = $empresa->supervisor;
            $this->moneda = $empresa->moneda;
            $this->telefonos = $empresa->telefono;
            $this->email = $empresa->email;
            $this->direccion = $empresa->direccion;
            $this->default = $empresa->default;
            $imagenes  = Imagen::where('bienes_id', $empresa->id)->where('nombre',  'empresas')->first();
            if ($imagenes){
                $this->btnImgBorrar = true;
                $this->imgID = $imagenes->id;
                $this->imagen = $imagenes->imagen;
                $this->mini = $imagenes->mini;
            }
        }
    }

    public function create()
    {
        $this->limpiar();
        $this->title = "Crear Empresa";
        $this->btnNuevo = false;
        $this->btnCancelar = true;
        $this->form = true;
    }

    public function edit()
    {
        $this->title = "Editar Empresa";
        $this->btnCancelar = true;
        $this->imagen = $this->mini;
        $this->form = true;
    }

    public function save()
    {
        $rules = [
            'rif'       =>  ['required', 'min:6', Rule::unique('empresas')->ignore($this->empresas_id)],
            'nombre'    =>  'required|min:4',
            'jefe'      =>  'required|min:4',
            'moneda'    =>  'required',
            'telefonos' =>  'required',
            'email'     =>  'required|email',
            'direccion' =>  'required',
            'photo'     => 'nullable|image|max:1024',
        ];
        $this->validate($rules);

        if ($this->empresas_id){
            //editar
            $empresa = Empresa::find($this->empresas_id);
        }else{
            $empresa = new Empresa();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Empresa::where('rowquid', $rowquid)->first();
            }while($existe);
            $empresa->rowquid = $rowquid;
        }

        if ($empresa){
            $empresa->rif = $this->rif;
            $empresa->nombre = $this->nombre;
            $empresa->supervisor = $this->jefe;
            $empresa->moneda = $this->moneda;
            $empresa->telefono = $this->telefonos;
            $empresa->email = $this->email;
            $empresa->direccion = $this->direccion;
            $empresa->default = $this->default;
            $empresa->save();

            if ($this->saveImagen){
                $this->procesarImagen($this->imgID, $this->photo, 'empresas', $empresa->id);
                borrarImagenes($this->imagen, 'empresas');
            }else{
                if ($this->imgBorrar){
                    $this->deleteImagen($this->imgID, 'empresas');
                }
            }
            $this->show($empresa->rowquid);
            $this->toastBootstrap();
        }
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        $this->imagen = crearImagenTemporal($this->photo, 'empresas');
        $this->setSaveImagen();
    }

    public function btnBorrarImagen()
    {
        if ($this->saveImagen){
            borrarImagenes($this->imagen, 'empresas');
            $this->setSaveImagen(false);
            $this->imagen = $this->mini;
        }else{
            if ($this->btnImgBorrar){
                $this->reset(['btnImgBorrar', 'imagen']);
                $this->imgBorrar = true;
            }
        }

        $this->reset(['photo']);
        $this->resetErrorBag(['photo']);
    }

    public function cancel()
    {
        if ($this->empresas_id){
            $this->show($this->rowquid);
        }else{
            $this->create();
        }
    }

    #[On('delete')]
    public function delete($rowquid)
    {
        $empresa = $this->getEmpresa($rowquid);
        if ($empresa){
            $nombre = '<b class="text-warning text-uppercase">'.$empresa->nombre.'</b>';
            $empresa->delete();
            $ultima = Empresa::orderBy('created_at', 'DESC')->first();
            $this->show($ultima->rowquid);
            $this->toastBootstrap('success', "Empresa $nombre Eliminada.");
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

    public function convertirDefault()
    {
        $this->setEmpresaDefault($this->empresas_id);
    }

    protected function getEmpresaDefault(): ?Empresa
    {
        return Empresa::where('default', 1)->first();
    }

    protected function setEmpresaDefault($id)
    {
        $empresa = Empresa::find($id);
        if ($empresa){
            $default = $this->getEmpresaDefault();
            if ($default){
                $default->default = 0;
                $default->save();
            }
            $empresa->default = 1;
            $empresa->save();
            $this->empresaDefault = $empresa->id;
        }
    }

    protected function getEmpresa($rowquid): ?Empresa
    {
        return Empresa::where('rowquid', $rowquid)->first();
    }

}
