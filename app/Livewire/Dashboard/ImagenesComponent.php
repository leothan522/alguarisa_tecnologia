<?php

namespace App\Livewire\Dashboard;

use App\Models\Imagen;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImagenesComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $bienes_id, $guardar = false;
    public $idImgFrontal, $verImgFrontal, $imagenFrontal, $borrarImgFrontal = false,
        $idImgPosterior, $verImgPosterior, $imagenPosterior, $borrarImgPosterior = false;
    //#[Validate('image|max:1024')] // 1MB Max
    public $frontalPhoto, $posteriorPhoto;
    public $frontalSrcImagen, $frontalSaveImagen = false, $posteriorSrcImagen, $posteriorSaveImagen = false;

    public function render()
    {
        return view('livewire.dashboard.imagenes-component');
    }

    #[On('showImagenes')]
    public function showImagenes($id)
    {
        $this->resetErrorBag();
        $this->reset([
            'frontalPhoto', 'posteriorPhoto', 'imagenFrontal', 'imagenPosterior',
            'borrarImgFrontal', 'borrarImgPosterior', 'guardar',
            'frontalSrcImagen', 'frontalSaveImagen', 'posteriorSrcImagen', 'posteriorSaveImagen'
        ]);

        $this->bienes_id = $id;
        $frontal = $this->dataImagen($this->bienes_id, 'frontal');
        $this->idImgFrontal = $frontal['id'];
        $this->verImgFrontal = $frontal['imagen'];
        $this->frontalSrcImagen = $frontal['imagen'];
        $this->imagenFrontal = $frontal['borrar'];
        $posterior = $this->dataImagen($this->bienes_id, 'posterior');
        $this->idImgPosterior = $posterior['id'];
        $this->verImgPosterior = $posterior['imagen'];
        $this->posteriorSrcImagen = $posterior['imagen'];
        $this->imagenPosterior = $posterior['borrar'];
    }

    public function rules()
    {
        return [
            'frontalPhoto' => 'nullable|image|max:2024', // 2MB Max
            'posteriorPhoto' => 'nullable|image|max:2024' // 2MB Max
        ];
    }

    public function messages()
    {
        return [
            'frontalPhoto.max' => 'la imagen Frontal no debe ser mayor que 2MB.',
            'posteriorPhoto.max' => 'la imagen Posterior no debe ser mayor que 2MB.'
        ];
    }

    public function saveImagenes()
    {
        $this->validate();

        $alert = false;
        $path = "bienes"; //bien_id_".$this->bienes_id;

        if ($this->frontalPhoto){
            $this->procesarImagen($this->idImgFrontal, $this->frontalPhoto, $path, 'frontal');
            $alert = true;
            borrarImagenes($this->frontalSrcImagen, 'imagenes/bienes');
        }else{
            if ($this->idImgFrontal && $this->borrarImgFrontal){
                $imagen = Imagen::find($this->idImgFrontal);
                $imagen->delete();
                $this->idImgFrontal = null;
            }
        }

        if ($this->borrarImgFrontal && $this->imagenFrontal){
            borrarImagenes($this->imagenFrontal, $path);
        }

        if ($this->posteriorPhoto){
            $this->procesarImagen($this->idImgPosterior, $this->posteriorPhoto, $path, 'posterior');
            $alert = true;
            borrarImagenes($this->posteriorSrcImagen, 'imagenes/bienes');
        }else{
            if ($this->idImgPosterior && $this->borrarImgPosterior){
                $imagen = Imagen::find($this->idImgPosterior);
                $imagen->delete();
                $this->idImgPosterior = null;
            }
        }

        if ($this->borrarImgPosterior && $this->imagenPosterior){
            borrarImagenes($this->imagenPosterior, $path);
        }

        if ($alert){
            $this->showImagenes($this->bienes_id);
            $this->alert('success', 'Datos Guardados.');
        }
        $this->guardar = false;

    }

    public function procesarImagen($id, $photo, $path, $name)
    {
        if ($id){
            $imagen = Imagen::find($id);
        }else{
            $imagen = new Imagen();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Imagen::where('rowquid', $rowquid)->first();
            }while($existe);
            $imagen->rowquid = $rowquid;
        }
        $ruta = $photo->store("public/imagenes/$path");
        $imagen->imagen = str_replace('public/', 'storage/', $ruta);
        //miniaturas
        $nombre = explode("$path/", $imagen->imagen);
        $path_data = "storage/imagenes/$path/size_".$nombre[1];
        $miniatura = crearMiniaturas($imagen->imagen, $path_data);
        $imagen->mini = $miniatura['mini'];
        /*$imagen->detail = $miniatura['detail'];
        $imagen->cart = $miniatura['cart'];
        $imagen->banner = $miniatura['banner'];*/
        $imagen->bienes_id = $this->bienes_id;
        $imagen->nombre = $name;
        $imagen->save();
    }

    protected function dataImagen($id, $nombre): array
    {
        $data = [
            'id' => null,
            'imagen' => null,
            'borrar' => null,
        ];

        $imagen = Imagen::where('bienes_id', $id)->where('nombre', $nombre)->first();
        if ($imagen){
            $data['id'] = $imagen->id;
            $data['imagen'] = $imagen->mini;
            $data['borrar'] = $imagen->imagen;
        }
        return $data;
    }

    public function btnBorrarImagen($nombre)
    {
        if ($nombre == 'frontal'){
            if ($this->frontalSaveImagen){
                $this->reset(['frontalSaveImagen', 'borrarImgFrontal']);
                borrarImagenes($this->frontalSrcImagen, 'imagenes/bienes');
                $this->frontalSrcImagen = $this->verImgFrontal;
            }else{
                $this->reset(['frontalSrcImagen', 'verImgFrontal']);
                $this->borrarImgFrontal = true;
            }
            /*$this->verImgFrontal = null;
            $this->borrarImgFrontal = true;*/
            $this->reset('frontalPhoto');
        }else{
            if ($this->posteriorSaveImagen){
                $this->reset(['posteriorSaveImagen', 'borrarImgPosterior']);
                borrarImagenes($this->posteriorSrcImagen, 'imagenes/bienes');
                $this->posteriorSrcImagen = $this->verImgPosterior;
            }else{
                $this->reset(['posteriorSrcImagen', 'verImgPosterior']);
                $this->borrarImgPosterior = true;
            }
            /*$this->verImgPosterior = null;
            $this->borrarImgPosterior = true;*/
            $this->reset('posteriorPhoto');
        }
        if ($this->borrarImgFrontal || $this->borrarImgPosterior){
            $this->guardar = true;
        }
    }



    public function updatedFrontalPhoto()
    {
        $this->validate();
        $this->borrarImgFrontal = true;
        $this->guardar = true;
        $this->frontalSrcImagen = crearImagenTemporal($this->frontalPhoto, 'imagenes/bienes');
        $this->frontalSaveImagen = true;
    }

    public function updatedPosteriorPhoto()
    {
        $this->validate();
        $this->borrarImgPosterior = true;
        $this->guardar = true;
        $this->posteriorSrcImagen = crearImagenTemporal($this->posteriorPhoto, 'imagenes/bienes');
        $this->posteriorSaveImagen = true;
    }

    public function limpiar($photo)
    {
        if ($photo == "frontal"){
            $this->reset('frontalPhoto');
            $this->resetErrorBag('frontalPhoto');
        }else{
            $this->reset('posteriorPhoto');
            $this->resetErrorBag('posteriorPhoto');
        }
    }

}
