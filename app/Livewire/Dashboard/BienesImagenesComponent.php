<?php

namespace App\Livewire\Dashboard;

use App\Models\Bien;
use App\Models\Imagen;
use App\Traits\Imagenes;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class BienesImagenesComponent extends Component
{
    use ToastBootstrap;
    use WithFileUploads;
    use Imagenes;

    public $imagenFrontal, $miniFrontal, $imgIDFrontal, $photoFrontal, $imgBorrarFrontal = false, $btnImgBorrarFrontal = false, $saveFrontal = false, $verFrontal;
    public $imagenPosterior, $miniPosterior, $imgIDPosterior, $photoPosterior, $imgBorrarPosterior = false, $btnImgBorrarPosterior = false, $savePosterior = false, $verPosterior;

    #[Locked]
    public $bienes_id;

    public function render()
    {
        return view('livewire.dashboard.bienes-imagenes-component');
    }

    public function limpiar()
    {
        $this->reset([
            'imagenFrontal', 'miniFrontal', 'imgIDFrontal', 'photoFrontal', 'imgBorrarFrontal', 'btnImgBorrarFrontal', 'saveFrontal', 'verFrontal',
            'imagenPosterior', 'miniPosterior', 'imgIDPosterior', 'photoPosterior', 'imgBorrarPosterior', 'btnImgBorrarPosterior', 'savePosterior', 'verPosterior',
            'bienes_id'
        ]);
        $this->resetErrorBag();
    }

    #[On('initImagenes')]
    public function initImagenes($id)
    {
        $this->limpiar();
        $bien = Bien::find($id);
        if ($bien){
            $imagenes  = Imagen::where('bienes_id', $bien->id)->where('nombre',  'frontal')->first();
            if ($imagenes){
                $this->btnImgBorrarFrontal = true;
                $this->imgIDFrontal = $imagenes->id;
                $this->imagenFrontal = $imagenes->imagen;
                $this->miniFrontal = $imagenes->mini;
                $this->verFrontal = $imagenes->mini;
            }
            $imagenes  = Imagen::where('bienes_id', $bien->id)->where('nombre',  'posterior')->first();
            if ($imagenes){
                $this->btnImgBorrarPosterior = true;
                $this->imgIDPosterior = $imagenes->id;
                $this->imagenPosterior = $imagenes->imagen;
                $this->miniPosterior = $imagenes->mini;
                $this->verPosterior = $imagenes->mini;
            }
            $this->bienes_id = $bien->id;
        }
        $this->activarButton();
    }

    public function save()
    {
        $rules = [
            'photoFrontal'     => 'nullable|image|max:2024',
            'photoPosterior'     => 'nullable|image|max:2024',
        ];
        $messages = [
            'photoFrontal.max' => 'La imagen frontal no debe ser mayor que 2MB.',
            'photoPosterior.max' => 'La imagen posterior no debe ser mayor que 2MB.'
        ];
        $this->validate($rules, $messages);

        $path = "imagenes/bienes";

        if ($this->saveFrontal){
            $this->procesarImagen($this->imgIDFrontal, $this->photoFrontal, $path, $this->bienes_id, "frontal");
            borrarImagenes($this->imagenFrontal, $path);
            borrarImagenes($this->verFrontal, $path);
        }else{
            if ($this->imgBorrarFrontal){
                $this->deleteImagen($this->imgIDFrontal, $path);
            }
        }

        if ($this->savePosterior){
            $this->procesarImagen($this->imgIDPosterior, $this->photoPosterior, $path, $this->bienes_id, "posterior");
            borrarImagenes($this->imagenPosterior, $path);
            borrarImagenes($this->verPosterior, $path);
        }else{
            if ($this->imgBorrarPosterior){
                $this->deleteImagen($this->imgIDPosterior, $path);
            }
        }
        $this->initImagenes($this->bienes_id);
        $this->toastBootstrap();

    }

    public function updatedPhotoFrontal()
    {
        $this->validate([
            'photoFrontal' => 'image|max:2024', // 2MB Max
        ], [
            'photoFrontal.max' => 'La imagen frontal no debe ser mayor que 2MB.'
        ]);

        //$this->imagenFrontal = crearImagenTemporal($this->photoFrontal, 'imagenes/bienes');
        $this->verFrontal = crearImagenTemporal($this->photoFrontal, 'imagenes/bienes');
        $this->saveFrontal = true;
        $this->activarButton();
    }

    public function btnBorrarImagenFrontal()
    {
        if ($this->saveFrontal){
            borrarImagenes($this->verFrontal, 'imagenes/bienes');
            $this->saveFrontal = false;
            $this->verFrontal = $this->miniFrontal;
        }else{
            if ($this->btnImgBorrarFrontal){
                $this->reset(['btnImgBorrarFrontal', 'verFrontal']);
                $this->imgBorrarFrontal = true;
            }
        }

        $this->reset(['photoFrontal']);
        $this->resetErrorBag(['photoFrontal']);
        $this->activarButton();
    }

    public function updatedPhotoPosterior()
    {
        $this->validate([
            'photoPosterior' => 'image|max:2024', // 2MB Max
        ], [
            'photoPosterior.max' => 'La imagen posterior no debe ser mayor que 2MB.'
        ]);

        //$this->imagenPosterior = crearImagenTemporal($this->photoPosterior, 'imagenes/bienes');
        $this->verPosterior = crearImagenTemporal($this->photoPosterior, 'imagenes/bienes');
        $this->savePosterior = true;
        $this->activarButton();
    }

    public function btnBorrarImagenPosterior()
    {
        if ($this->savePosterior){
            borrarImagenes($this->verPosterior, 'imagenes/bienes');
            $this->savePosterior = false;
            $this->verPosterior = $this->miniPosterior;
        }else{
            if ($this->btnImgBorrarPosterior){
                $this->reset(['btnImgBorrarPosterior', 'verPosterior']);
                $this->imgBorrarPosterior = true;
            }
        }

        $this->reset(['photoPosterior']);
        $this->resetErrorBag(['photoPosterior']);
        $this->activarButton();
    }

    public function activarButton()
    {
        if ($this->saveFrontal || $this->savePosterior || $this->imgBorrarFrontal || $this->imgBorrarPosterior){
            $this->setSaveImagen();
        }else{
            $this->setSaveImagen(false);
        }
    }

}
