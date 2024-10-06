<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Equipo;
use App\Models\Institucion;
use App\Models\Oficio;
use App\Models\Persona;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Sleep;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class OficiosComponent extends Component
{
    use LivewireAlert;
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $view = 'table',$order = 'DESC', $keyword;
    public $serial;
    public $dirigido, $copia;
    public $numero, $repetido = false, $fecha, $adicional, $equipos = 0, $pdf;
    public $verPDF = false, $verIconoPDF = false, $nombrePDF, $sizePDF, $oldPdf, $borrarPDF = false, $verBtnRepetido = 0;
    public $listarEquipos = [];

    #[Locked]
    public $oficios_id, $rowquid;

    public function render()
    {
        $oficios = Oficio::buscar($this->keyword)
            ->orderBy('fecha', $this->order)
            ->orderBy('numero', $this->order)
            //->orderBy('created_at', 'DESC')
            ->paginate(50);

        $rows = Oficio::buscar($this->keyword)->count();

        return view('livewire.dashboard.oficios-component')
            ->with('oficios', $oficios)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->reset([
            'view', 'oficios_id', 'rowquid',
            'dirigido', 'copia',
            'numero', 'repetido', 'fecha', 'adicional', 'equipos', 'pdf',
            'verPDF', 'verIconoPDF', 'nombrePDF', 'sizePDF', 'oldPdf', 'borrarPDF', 'verBtnRepetido',
            'listarEquipos'
        ]);
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->limpiar();
        $this->dispatch('initSelectDirigido', data: $this->getDataSelects());
        $this->dispatch('initSelectCopia', data: $this->getDataSelects());
        $this->reset('verPDF');
        $this->view = 'form';
    }

    public function show($rowquid)
    {
        $this->limpiar();
        $oficio = $this->getOficio($rowquid);
        if ($oficio){

            $this->oficios_id = $oficio->id;
            $this->rowquid = $oficio->rowquid;
            $this->numero = $oficio->numero;
            $this->fecha = $oficio->fecha;
            $this->equipos = intval($oficio->equipos);
            $this->adicional = $oficio->adicional;

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

            $this->dirigido = json_decode($oficio->dirigido);
            $this->copia = json_decode($oficio->copia);
            if ($oficio->pdf){
               $pdf = str_replace('storage/', 'public/', $oficio->pdf);
                if (Storage::exists($pdf)){
                    $this->verPDF = $oficio->pdf;
                    $explode = explode('pdf/', $pdf);
                    $this->nombrePDF = $explode[1];
                    $this->sizePDF = Storage::size($pdf) / 1024;
                    $this->verIconoPDF = true;
                    $this->oldPdf = $pdf;
                }
            }

            $this->verBtnRepetido = $oficio->repetido;

            $this->view = 'show';
        }
    }

    public function edit()
    {
        $this->dispatch('initSelectDirigido', data: $this->getDataSelects());
        $this->dispatch('initSelectCopia', data: $this->getDataSelects());
        Sleep::for(500)->millisecond();
        if (!empty($this->dirigido)){
            $this->dispatch('setSelectDirigido', rowquid: $this->dirigido);
        }
        if (!empty($this->copia)){
            $this->dispatch('setSelectCopia', rowquid: $this->copia);
        }
        $this->dispatch('setTextArea', texto: $this->adicional);
        $this->reset('verPDF');
        $this->view = 'form';
    }

    public function rules()
    {
        if (!$this->repetido){
            $unico = [ 'required', Rule::unique('oficios', 'numero')->ignore($this->oficios_id)];
        }else{
            $unico = 'required';
        }
        return [
            'dirigido' => 'required',
            'copia' => 'nullable|different:dirigido',
            'numero' => $unico,
            'fecha' => 'required',
            'adicional' => 'required_if:equipos,0',
            'pdf' => 'nullable|mimes:pdf|max:5120', // 5MB Max
        ];
    }

    public function messages()
    {
        return [
            'dirigido.required' => 'El campo dirigido a es obligatorio.',
            'copia.different' => 'Con copia y Dirigido a deben ser diferentes.',
            'numero.required' => 'El numero es obligatorio.',
            'fecha.required' => 'La fecha es obligatoria.',
            'numero.unique' => 'El numero ya ha sido registrado.',
            'adicional.required_if' => 'El campo adicional es obligatorio cuando equipos vinculados es 0.',
            'pdf.mimes' => 'El archivo a adjuntar debe ser un archivo con formato: pdf.',
        ];
    }

    public function save()
    {
        $this->validate();

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
            $oficio->numero = $this->numero;
            $oficio->fecha = $this->fecha;
            $oficio->equipos = $this->equipos;
            $oficio->adicional = $this->adicional;
            $oficio->auditoria = $auditoria;

            if (!empty($this->dirigido)){
                $oficio->dirigido = json_encode($this->dirigido);
            }

            if (!empty($this->copia)){
                $oficio->copia = json_encode($this->copia);
            }

            if ($this->repetido){
                $oficio->repetido = 1;
            }

            if ($this->pdf){
                $ruta = $this->pdf->store("public/pdf");
                $oficio->pdf = str_replace('public/', 'storage/', $ruta);
                if ($this->oldPdf){
                    $this->borrarPDF = true;
                }
            }

            if ($this->borrarPDF){
                if (Storage::exists($this->oldPdf)){
                    Storage::delete($this->oldPdf);
                }
                if (!$this->pdf){
                    $oficio->pdf = null;
                }
            }


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
            $this->alert('success', 'Datos Guardados.');
            $this->show($oficio->rowquid);
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

    public function searchSerial()
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
                $this->alert('info', 'Bien Agregado.');
            }else{
                $this->confirm('¿Registrar Bienes?', [
                    'toast' => false,
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'confirmButtonText' =>  '¡Sí, Registrar Equipo!',
                    'text' =>  '¡El Serial ó Identificador suministrado NO coindide con algún Bien registrado!',
                    'cancelButtonText' => 'No',
                    'onConfirmed' => 'nuevoBien',
                ]);
            }
        }else{
            $this->alert('warning', 'El equipo ya esta agregado.');
            //$this->reset('serial');
        }
    }

    #[On('nuevoBien')]
    public function nuevoBien()
    {
        $this->dispatch('irBienes');
    }

    #[On('irBienes')]
    public function irBienes()
    {
        //JS
    }

    public function btnQuitarEquipo($key)
    {
        unset($this->listarEquipos[$key]);
        $this->equipos--;
    }

    protected function getDataSelects(): array
    {
        $personas = Persona::orderBy('nombre', 'ASC')->get();
        $data = [];
        foreach ($personas as $persona) {
            $option = [
                'id' => $persona->rowquid,
                'text' => ucfirst($persona->prefijo . ' ' . $persona->nombre)
            ];
            $data[] = $option;
        }
        $instituciones = Institucion::orderBy('nombre', 'ASC')->get();
        foreach ($instituciones as $institucion) {
            $option = [
                'id' => $institucion->rowquid,
                'text' => ucfirst($institucion->nombre)
            ];
            $data[] = $option;
        }
        return $data;
    }

    #[On('initSelectDirigido')]
    public function initSelectDirigido($data)
    {
        //JS
    }

    #[On('getSelectDirigido')]
    public function getSelectDirigido($rowquid)
    {
        $this->dirigido = $rowquid;
    }

    #[On('setSelectDirigido')]
    public function setSelectDirigido($rowquid)
    {
        //JS
    }

    #[On('initSelectCopia')]
    public function initSelectCopia($data)
    {
        //JS
    }

    #[On('getSelectCopia')]
    public function getSelectCopia($rowquid)
    {
        $this->copia = $rowquid;
    }

    #[On('setSelectCopia')]
    public function setSelectCopia($rowquid)
    {
        //JS
    }

    public function orderAscending(){
        $this->order = 'ASC';
    }

    public function orderDescending(){
        $this->order = 'DESC';
    }

    public function buscar()
    {
        $this->resetPage();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
        $this->resetPage();
    }

    public function actualizar()
    {
        $this->resetPage();
        $this->limpiar();
    }

    public function updatedPdf()
    {
        $this->reset(['verIconoPDF']);
        $rules = [
            'pdf' => 'nullable|mimes:pdf|max:5120', // 5MB Max
        ];
        $messages = [
            'pdf.mimes' => 'El archivo a adjuntar debe ser un archivo con formato: pdf.',
        ];
        $this->validate($rules, $messages);
        $this->verIconoPDF = true;
        $this->dispatch('setLabelIcono');
    }

    #[On('setLabelIcono')]
    public function setLabelIcono()
    {
        //JS
    }

    public function btnResetPDF()
    {
        $this->reset(['verIconoPDF', 'nombrePDF', 'sizePDF', 'pdf']);
        $this->resetErrorBag('pdf');
        if ($this->oldPdf){
            $this->borrarPDF = true;
        }
    }

    public function getReceptor($array = [], $show = false, $copia = false): string
    {
        $response = '';
        foreach ($array as $value){
            $persona = Persona::where('rowquid', $value)->first();
            if ($persona){
                $prefijo = !empty($persona->prefijo) ?? '';
                if (!$show){
                    $response .= "[".ucfirst($prefijo . $persona->nombre)."]";
                }else{
                    if (!$copia){
                        $response .= ucfirst($prefijo . $persona->nombre)."<br>";
                    }else{
                        $response .= "Cc: ".ucfirst($prefijo . $persona->nombre)."<br>";
                    }
                }
            }else{
                $institucion = Institucion::where('rowquid', $value)->first();
                if ($institucion){
                    if (!$show){
                        $response .= "[".ucfirst($institucion->nombre)."]";
                    }else{
                        if (!$copia){
                            $response .= ucfirst($institucion->nombre)."<br>";
                        }else{
                            $response .= "Cc: ".ucfirst($institucion->nombre)."<br>";
                        }
                    }
                }
            }
        }
        return $response;
    }

    private function getOficio($rowquid): ?Oficio
    {
        return Oficio::where('rowquid', $rowquid)->first();
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
        $oficio = Oficio::find($this->oficios_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

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
            if ($oficio){
                if (is_null($oficio->auditoria)){
                    $auditoria = "[ 'accion' => 'delete', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
                }else{
                    $auditoria = $oficio->auditoria.", [ 'accion' => 'delete', 'users_id' => ". auth()->user()->id.", 'users_name' => '". auth()->user()->name."', 'fecha' => '".date('Y-m-d H:i:s')."']";
                }

                $oficio->auditoria = $auditoria;
                $oficio->numero = "*".$oficio->numero;
                $oficio->save();
                $oficio->delete();
                $this->alert('success', 'Registro Eliminado.');
            }
        }

        $this->limpiar();
    }

    #[On('setTextArea')]
    public function setTextArea($texto)
    {
        //JS
    }

    public function btnDescartar()
    {
        if ($this->oficios_id){
            $this->show($this->rowquid);
        }else{
            $this->limpiar();
        }
    }

    #[On('initSelectsForm')]
    public function initSelectsForm()
    {
        $this->dispatch('initSelectDirigido', data: $this->getDataSelects());
        $this->dispatch('initSelectCopia', data: $this->getDataSelects());
        Sleep::for(500)->millisecond();
        if (!empty($this->dirigido)){
            $this->dispatch('setSelectDirigido', rowquid: $this->dirigido);
        }
        if (!empty($this->copia)){
            $this->dispatch('setSelectCopia', rowquid: $this->copia);
        }
    }

    public function verNumerosRepeditos()
    {
        $this->keyword = $this->numero;
        $this->reset('view');
        $this->buscar();
    }
}
