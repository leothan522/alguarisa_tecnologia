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

    public function render()
    {
        return view('livewire.dashboard.imagenes-component');
    }

    #[On('showImagenes')]
    public function showImagenes($id)
    {
        $this->reset([
            'frontalPhoto', 'posteriorPhoto', 'imagenFrontal', 'imagenPosterior',
            'borrarImgFrontal', 'borrarImgPosterior', 'guardar'
        ]);

        $this->bienes_id = $id;
        $frontal = $this->dataImagen($this->bienes_id, 'frontal');
        $this->idImgFrontal = $frontal['id'];
        $this->verImgFrontal = $frontal['imagen'];
        $this->imagenFrontal = $frontal['borrar'];
        $posterior = $this->dataImagen($this->bienes_id, 'posterior');
        $this->idImgPosterior = $posterior['id'];
        $this->verImgPosterior = $posterior['imagen'];
        $this->imagenPosterior = $posterior['borrar'];
    }

    public function saveImagenes()
    {
        $rules = [
            'frontalPhoto' => 'nullable|image|max:1024', // 1MB Max
            'posteriorPhoto' => 'nullable|image|max:1024' // 1MB Max
        ];
        $messages = [
            'frontalPhoto.max' => 'la imagen Frontal no debe ser mayor que 1024 kilobytes.',
            'posteriorPhoto.max' => 'la imagen Posterior no debe ser mayor que 1024 kilobytes.'
        ];
        $this->validate($rules, $messages);

        $alert = false;
        $path = "bienes"; //bien_id_".$this->bienes_id;

        if ($this->frontalPhoto){
            $this->procesarImagen($this->idImgFrontal, $this->frontalPhoto, $path, 'frontal');
            $alert = true;
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
            $this->verImgFrontal = null;
            $this->borrarImgFrontal = true;
        }else{
            $this->verImgPosterior = null;
            $this->borrarImgPosterior = true;
        }
        $this->guardar = true;
    }

    public function updatedFrontalPhoto()
    {
        $rules = [
            'frontalPhoto' => 'image|max:1024', // 1MB Max
        ];
        $messages = [
            'frontalPhoto.max' => 'la imagen Frontal no debe ser mayor que 1024 kilobytes.'
        ];
        $this->validate($rules, $messages);
        $this->borrarImgFrontal = true;
        $this->guardar = true;
    }

    public function updatedPosteriorPhoto()
    {
        $rules = [
            'posteriorPhoto' => 'image|max:1024' // 1MB Max
        ];
        $messages = [
            'posteriorPhoto.max' => 'la imagen Posterior no debe ser mayor que 1024 kilobytes.'
        ];
        $this->validate($rules, $messages);
        $this->borrarImgPosterior = true;
        $this->guardar = true;
    }

}
