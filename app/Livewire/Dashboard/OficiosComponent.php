<?php

namespace App\Livewire\Dashboard;

use App\Models\Oficio;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use function Laravel\Prompts\alert;

class OficiosComponent extends Component
{
    use LivewireAlert;
    use WithPagination,WithoutUrlPagination;

    public $view = 'table',$order = 'DESC', $keyword;
    public $numero, $fecha, $equipos, $adicional, $pdf;
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
            'numero', 'fecha', 'equipos', 'adicional', 'pdf',
            'listarEquipos'
        ]);
    }

    public function create()
    {
        $this->limpiar();
        $this->view = 'form';
    }

    public function show($rowquid)
    {
        $this->limpiar();
        $this->view = 'show';
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
