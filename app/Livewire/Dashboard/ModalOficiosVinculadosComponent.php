<?php

namespace App\Livewire\Dashboard;

use App\Models\Equipo;
use App\Models\Oficio;
use Illuminate\Support\Facades\Route;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalOficiosVinculadosComponent extends Component
{
    use LivewireAlert;
    public $bienes_id;
    public $web = false;

    public function render()
    {
        $ruta = Route::currentRouteName();
        if ($ruta == "etiquetas.web"){
            $this->web = true;
        }

        $oficios = Equipo::where('bienes_id', $this->bienes_id)->orderBy('created_at', 'DESC')->get();
        $oficios->each(function ($equipo){
            $exite = Oficio::where('id', $equipo->oficios_id)->first();
            if ($exite){
                $equipo->ver = true;
                $equipo->fecha = $exite->fecha;
                $equipo->idOficio = $exite->rowquid;
            }else{
                $equipo->ver = false;
                $equipo->fecha = null;
                $equipo->idOficio = null;
            }
        });
        return view('livewire.dashboard.modal-oficios-vinculados-component')
            ->with('listarEquipos', $oficios->sortByDesc('fecha'));
    }

    #[On('getBienesOficios')]
    public function getBienesOficios($bienID)
    {
        $this->reset('bienes_id');
        $this->bienes_id = $bienID;
    }

    public function verOficio($rowquid)
    {
        $oficio = Oficio::where('rowquid', $rowquid)->first();
        if ($oficio){
            $this->dispatch('show', rowquid: $rowquid)->to(ModalOficiosComponent::class);
        }
    }



}
