<?php

namespace App\Livewire\Dashboard;

use App\Models\Oficio;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class OficiosComponent extends Component
{
    use LivewireAlert;
    use WithPagination,WithoutUrlPagination;

    public $order = 'DESC';

    public function render()
    {
        $oficios = Oficio::orderBy('fecha', $this->order)->paginate(50);
        return view('livewire.dashboard.oficios-component')
            ->with('oficios', $oficios);
    }

    public function limpiar()
    {
        $this->resetPage();
    }

}
