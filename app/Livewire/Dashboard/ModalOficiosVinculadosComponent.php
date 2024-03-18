<?php

namespace App\Livewire\Dashboard;

use App\Models\Equipo;
use App\Models\Oficio;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalOficiosVinculadosComponent extends Component
{
    use LivewireAlert;
    public $bienes_id;

    public function render()
    {
        $oficios = Equipo::where('bienes_id', $this->bienes_id)->orderBy('created_at', 'DESC')->get();
        $oficios->each(function ($equipo){
            $exite = Oficio::where('id', $equipo->oficios_id)->first();
            if ($exite){
                $equipo->ver = true;
            }else{
                $equipo->ver = false;
            }
        });
        return view('livewire.dashboard.modal-oficios-vinculados-component')
            ->with('listarEquipos', $oficios);
    }

    #[On('getBienesOficios')]
    public function getBienesOficios($bienID)
    {
        $this->reset('bienes_id');
        $this->bienes_id = $bienID;
    }

    public function verOficio($id)
    {
        $this->dispatch('show', id: $id)->to(ModalOficiosComponent::class);
    }



}
