<?php

namespace App\Livewire\Dashboard;

use App\Models\Institucion;
use App\Models\Oficio;
use App\Models\Persona;
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
            'pdf' => 'nullable|mimes:pdf|max:2024', // 2MB Max
        ];
    }

    public function messages()
    {
        return [
            'frontalPhoto.max' => 'la imagen Frontal no debe ser mayor que 2MB.',
        ];
    }

    public function save()
    {
        $this->validate();
        $this->alert('success', 'Guardado.');
    }

    public function searchSerial()
    {
        $this->alert('info', 'Buscando Serial.');
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



}
