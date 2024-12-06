<?php

namespace App\Livewire\Dashboard;

use App\Traits\ToastBootstrap;
use Livewire\Component;

class PruebasComponent extends Component
{
    use ToastBootstrap;
    public function render()
    {
        return view('livewire.dashboard.pruebas-component');
    }

    public function prueba()
    {
        $this->flashBootstrap('info', 'prueba flh');
        return redirect()->route('dashboard');
    }
}
