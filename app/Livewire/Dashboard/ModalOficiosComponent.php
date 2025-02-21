<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Equipo;
use App\Models\Oficio;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalOficiosComponent extends Component
{
    use ToastBootstrap;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $view = true, $form = false, $ver = false, $nuevo = false, $editar = false, $cancelar = false, $keyword;
    public $oficio, $fecha, $equipos = 0, $repetido = false;
    public $serial;
    public $listarEquipos = [];
    public $adicional, $pdf;

    #[Locked]
    public $oficios_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $oficios = Oficio::buscar($this->keyword)
            ->orderBy('fecha', 'DESC')
            ->limit($this->rows)
            ->get();
        $rowsOficios = Oficio::buscar($this->keyword)->count();

        if ($rowsOficios > $this->numero) {
            $this->tableStyle = true;
        }
        return view('livewire.dashboard.modal-oficios-component')
            ->with('listarOficios', $oficios)
            ->with('total', $rowsOficios);
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
            'view', 'form', 'ver', 'nuevo', 'editar', 'cancelar',
            'oficios_id', 'oficio', 'fecha', 'equipos', 'repetido',
            'serial',
            'listarEquipos',
            'adicional', 'pdf', 'rowquid'
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
    }

    #[On('show')]
    public function show($rowquid)
    {
        $this->limpiar();
        $this->reset(['oficios_id']);
        $oficio = $this->getOficio($rowquid);

        if ($oficio){
            $this->oficios_id = $oficio->id;
            $this->oficio = $oficio->numero;
            $this->fecha = $oficio->fecha;
            $this->equipos = $oficio->equipos;
            $this->adicional = $oficio->adicional;
            $this->pdf = $oficio->pdf;
            $this->rowquid = $oficio->rowquid;

            $equipos = Equipo::where('oficios_id', $this->oficios_id)->get();
            foreach ($equipos as $equipo){
                $bien = Bien::find($equipo->bienes_id);
                $this->listarEquipos[] = [
                    'id' => $bien->id,
                    'tipo' => $bien->tipo->nombre,
                    'marca' => $bien->marca->nombre,
                    'modelo' => $bien->modelo->nombre,
                    'serial' => $bien->serial,
                    'identificador' => $bien->identificador,
                    'rowquid' => $bien->rowquid,
                ];
            }

            $this->view = false;
            $this->form = true;
            $this->ver = true;
            $this->editar = true;
            $this->cancelar = true;
        }

    }

    public function save()
    {
        if (!$this->repetido){
            $unico = [ 'required', Rule::unique('oficios', 'numero')->ignore($this->oficios_id)];
        }else{
            $unico = 'required';
        }
        $rules = [
            'oficio' => $unico,
            'fecha' => 'required',
            'adicional' => 'required_if:equipos,0'
        ];
        $messages = [
            'oficio.required' => 'El numero es obligatorio.',
            'fecha.required' => 'La fecha es obligatoria.',
            'oficio.unique' => 'El numero ya ha sido registrado.',
            'adicional.required_if' => 'El campo adicional es obligatorio cuando equipos vinculados es 0.',
        ];
        $this->validate($rules, $messages);

        if ($this->oficios_id){
            $oficio = Oficio::find($this->oficios_id);
            $borrar = true;
            if (is_null($oficio->auditoria)){
                $auditoria = "[ 'accion' => 'edit', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
            }else{
                $auditoria = $oficio->auditoria.", [ 'accion' => 'edit', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
            }
        }else{
            $oficio = new Oficio();
            $borrar = false;
            $auditoria = "[ 'accion' => 'create', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Oficio::where('rowquid', $rowquid)->first();
            }while($existe);
            $oficio->rowquid = $rowquid;
        }

        if ($oficio){
            $oficio->numero = $this->oficio;
            $oficio->fecha = $this->fecha;
            $oficio->equipos = $this->equipos;
            $oficio->adicional = $this->adicional;
            $oficio->auditoria = $auditoria;
            $oficio->save();

            if ($borrar){
                $equipos = Equipo::where('oficios_id', $oficio->id)->get();
                foreach ($equipos as $equipo){
                    $eliminar = Equipo::find($equipo->id);
                    $eliminar->delete();
                }
            }

            if (!empty($this->listarEquipos)) {
                foreach ($this->listarEquipos as $equipo){
                    $nuevo = new Equipo();
                    $nuevo->oficios_id = $oficio->id;
                    $nuevo->bienes_id = $equipo['id'];
                    do{
                        $rowquid = generarStringAleatorio(16);
                        $existe = Equipo::where('rowquid', $rowquid)->first();
                    }while($existe);
                    $nuevo->rowquid = $rowquid;
                    $nuevo->save();
                }
            }

            $this->reset('keyword');
            $this->toastBootstrap();
        }

        $this->limpiar();
    }

    public function edit()
    {
        $this->ver = false;
        $this->editar = false;
        $this->form = true;
        $this->cancelar = true;
    }

    public function destroy()
    {
        $this->confirmToastBootstrap('confirmed');
    }

    #[On('confirmed')]
    public function confirmed()
    {
        $oficio = Oficio::find($this->oficios_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        if ($vinculado) {
            $this->htmlToastBoostrap();
        } else {
            if ($oficio){

                $numero = "<b>".mb_strtoupper($oficio->numero)."</b>";

                if (is_null($oficio->auditoria)){
                    $auditoria = "[ 'accion' => 'delete', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
                }else{
                    $auditoria = $oficio->auditoria.", [ 'accion' => 'delete', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
                }

                $oficio->auditoria = $auditoria;
                $oficio->numero = "*".$oficio->numero;

                $oficio->save();
                $oficio->delete();
                $this->toastBootstrap('success', "Oficio Nro. $numero Eliminado.");
            }
        }

        $this->limpiar();
        $this->reset('keyword');
    }

    public function btnSerial()
    {

        $rules = ['serial' => 'required|alpha_dash:ascii'];
        $message = [
            'serial.required' => 'El campo es obligatorio.',
            'serial.alpha_dash' => 'El campo sólo debe contener letras, números, guiones y guiones bajos.'
        ];

        $this->serial = str_replace('/', '_-_', $this->serial);

        $this->validate($rules, $message);

        $this->serial = str_replace('_-_', '/', $this->serial);

        $exite = false;

        foreach ($this->listarEquipos as $equipo){
            if (mb_strtoupper($equipo['serial']) == mb_strtoupper($this->serial) ||
                mb_strtoupper($equipo['identificador']) == mb_strtoupper($this->serial)){
                $exite = true;
                break;
            }
        }

        if (!$exite){
            $bien = Bien::where('serial', $this->serial)->orWhere('identificador', $this->serial)->first();
            if ($bien){
                $this->listarEquipos[] = [
                    'id' => $bien->id,
                    'tipo' => $bien->tipo->nombre,
                    'marca' => $bien->marca->nombre,
                    'modelo' => $bien->modelo->nombre,
                    'serial' => $bien->serial,
                    'identificador' => $bien->identificador,
                    'rowquid' => $bien->rowquid
                ];
                $this->equipos++;
                $this->reset('serial');
            }else{
                $this->confirmToastBootstrap('nuevoEquipo', [
                    'title' => 'Registrar Bienes',
                    'message' => "El Serial ó Identificador suministrado NO coindide con algún Bien registrado.",
                    'button' => "¡Sí, Registrar Equipo!"
                ]);
            }
        }else{
            $this->toastBootstrap('warning', "El Equipo ya se encuentra registrado.");
            //$this->reset('serial');
        }

    }

    public function btnQuitarEquipo($key)
    {
        unset($this->listarEquipos[$key]);
        $this->equipos--;
    }

    public function btnCancelar()
    {
        if ($this->oficios_id && !$this->ver){
            $this->show($this->rowquid);
        }else{
            $this->limpiar();
        }
    }

    public function btnRepetido()
    {
        if ($this->repetido){
            $this->repetido = false;
        }else{
            $this->repetido = true;
        }
    }

    public function buscar()
    {
        $this->limpiar();
    }

    public function limpiarBuscar()
    {
        $this->reset('keyword');
        $this->btnCancelar();
    }

    #[On('nuevoEquipo')]
    public function nuevoEquipo()
    {
        $this->dispatch('clickNuevoBien');
    }

    #[On('clickNuevoBien')]
    public function clickNuevoBien()
    {
        //JS
    }

    protected function getOficio($rowquid): ?Oficio
    {
        return Oficio::where('rowquid', $rowquid)->first();
    }

}
