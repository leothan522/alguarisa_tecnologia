<?php

namespace App\Livewire\Dashboard;

use App\Models\BienUbicacion;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\Route;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalUbicacionesComponent extends Component
{
    use LivewireAlert;

    public $listarUbicaciones = [];
    public $bienes_id, $ubicaciones_id, $actual;
    public $web = false;

    public function render()
    {
        $ruta = Route::currentRouteName();
        if ($ruta == "etiquetas.web"){
            $this->web = true;
        }

        $ubicaciones = BienUbicacion::where('bienes_id', $this->bienes_id)->orderBy('created_at', 'DESC')->get();
        return view('livewire.dashboard.modal-ubicaciones-component')
            ->with('listarBienUbicacion', $ubicaciones);
    }

    #[On('getBienesUbicaciones')]
    public function getBienesUbicaciones($bienID)
    {
        $this->resetErrorBag();
        $this->reset(['listarUbicaciones', 'bienes_id', 'ubicaciones_id', 'actual']);
        $this->bienes_id = $bienID;
        $this->listarUbicaciones = Ubicacion::orderBy('nombre', 'ASC')->get();
    }

    public function save()
    {
        $rules = [
            'ubicaciones_id' => 'required'
        ];
        $this->validate($rules);

        $existe = BienUbicacion::where('bienes_id', $this->bienes_id)->where('actual', 1)->first();
        if ($existe){
            $existe->actual = 0;
            $existe->save();
        }

        $bienUbicacion = new BienUbicacion();
        $bienUbicacion->bienes_id = $this->bienes_id;
        $bienUbicacion->ubicaciones_id = $this->ubicaciones_id;
        $bienUbicacion->actual = 1;
        $bienUbicacion->save();

        $this->getBienesUbicaciones($this->bienes_id);

        //$this->alert('success', 'Datos Guardados.');

    }

    public function destroy($id)
    {
        $bienUbicacion = BienUbicacion::find($id);
        if ($bienUbicacion){
            $bienUbicacion->delete();
            $existe = BienUbicacion::where('bienes_id', $this->bienes_id)->orderBy('created_at', 'DESC')->first();
            if ($existe) {
                $existe->actual = 1;
                $existe->save();
            }
        }
    }

}
