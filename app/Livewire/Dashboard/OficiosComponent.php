<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Institucion;
use App\Models\Oficio;
use App\Models\Persona;
use Illuminate\Support\Sleep;
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
    public $verPDF = false, $verIconoPDF = false, $nombrePDF, $sizePDF;
    public $listarEquipos = [];

    #[Locked]
    public $oficios_id, $rowquid;

    public function render()
    {
        $oficios = Oficio::buscar($this->keyword)->orderBy('fecha', $this->order)->paginate(50);
        return view('livewire.dashboard.oficios-component')
            ->with('oficios', $oficios);
    }

    public function limpiar()
    {
        $this->reset([
            'view', 'oficios_id', 'rowquid',
            'dirigido', 'copia',
            'numero', 'repetido', 'fecha', 'adicional', 'equipos', 'pdf',
            'verPDF', 'verIconoPDF', 'nombrePDF', 'sizePDF',
            'listarEquipos'
        ]);
    }

    public function create()
    {
        $this->limpiar();
        $this->dispatch('initSelectDirigido', data: $this->getDataSelects());
        $this->dispatch('initSelectCopia', data: $this->getDataSelects());
        $this->view = 'form';
    }

    public function show($rowquid)
    {
        $this->limpiar();
        $this->view = 'show';
    }

    public function rules()
    {
        return [
            'pdf' => 'nullable|mimes:pdf|max:5120', // 5MB Max
        ];
    }

    public function messages()
    {
        return [
            'frontalPhoto.max' => 'la imagen Frontal no debe ser mayor que 2MB.',
            'pdf.mimes' => 'El archivo a adjuntar debe ser un archivo con formato: pdf.',
        ];
    }

    public function save()
    {
        $this->validate();
        $this->alert('success', 'Guardado.');
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
                    'onConfirmed' => '',
                ]);
            }
        }else{
            $this->alert('warning', 'El equipo ya esta agregado.');
            //$this->reset('serial');
        }
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

    public function actualizar()
    {
        $this->resetPage();
        $this->limpiar();
    }

    public function updatedPdf()
    {
        $this->reset(['verIconoPDF']);
        $this->validate();
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
    }



}
