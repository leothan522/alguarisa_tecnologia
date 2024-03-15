<?php

namespace App\Livewire\Dashboard;

use App\Models\Oficio;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalOficiosComponent extends Component
{
    use LivewireAlert;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $view = true, $form = false, $ver = false, $nuevo = false, $editar = false, $cancelar = false, $keyword;
    public $oficios_id, $oficio, $fecha, $equipos = 0, $repetido = false;
    public $serial, $identificador;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $oficios = Oficio::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get();
        $rowsOficios = Oficio::count();

        if ($rowsOficios > $this->numero) {
            $this->tableStyle = true;
        }
        return view('livewire.dashboard.modal-oficios-component')
            ->with('listarOficios', $oficios)
            ->with('rows', $rowsOficios);
    }

    public function setLimit()
    {
        if (numRowsPaginate() < $this->numero) {
            $rows = $this->numero;
        } else {
            $rows = numRowsPaginate();
        }
        $this->rows = $this->rows + $rows;
    }

    public function limpiar()
    {
        $this->reset([
            'view', 'form', 'ver', 'nuevo', 'editar', 'cancelar',
            'oficios_id', 'oficio', 'fecha', 'equipos', 'repetido',
            'serial', 'identificador'
        ]);
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->limpiar();
        $this->view = false;
        $this->form = true;
        $this->nuevo = true;
        $this->cancelar = true;
        $this->ver = false;
    }

    public function show($id)
    {
        $this->limpiar();
        $oficio = Oficio::find($id);
        $this->oficios_id = $oficio->id;
        $this->oficio = $oficio->numero;
        $this->fecha = $oficio->fecha;
        $this->equipos = $oficio->equipos;
        $this->view = false;
        $this->form = true;
        $this->ver = true;
        $this->editar = true;
        $this->cancelar = true;
    }

    public function save()
    {
        if (!$this->repetido){
            $unico = [ 'required', Rule::unique('oficios', 'numero')->ignore($this->oficios_id)];
        }else{
            $unico = 'required';
        }
        $rules = [
            'oficio' => $unico,
            'fecha' => 'required'
        ];
        $messages = [
            'oficio.required' => 'El numero es obligatorio.',
            'fecha.required' => 'La fecha es obligatoria.',
            'oficio.unique' => 'El numero ya ha sido registrado.',
        ];
        $this->validate($rules, $messages);

        if ($this->oficios_id){
            $oficio = Oficio::find($this->oficios_id);
        }else{
            $oficio = new Oficio();
        }

        $oficio->numero = $this->oficio;
        $oficio->fecha = $this->fecha;
        $oficio->equipos = $this->equipos;
        $oficio->save();

        $this->limpiar();
        $this->reset('keyword');

        $this->alert('success', 'Datos Guardados.');
    }

    public function edit()
    {
        $this->ver = false;
        $this->editar = false;
        $this->form = true;
        $this->cancelar = true;
    }

    public function destroy()
    {
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
        ]);
    }

    #[On('confirmed')]
    public function confirmed()
    {
        $oficio = Oficio::find($this->oficios_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        if ($vinculado) {
            $this->alert('warning', '¡No se puede Borrar!', [
                'position' => 'center',
                'timer' => '',
                'toast' => false,
                'text' => 'El registro que intenta borrar ya se encuentra vinculado con otros procesos.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'OK',
            ]);
        } else {
            $oficio->delete();
            $this->alert(
                'success',
                'Registro Eliminado.'
            );
        }
        $this->limpiar();
        $this->reset('keyword');
    }

    public function btnCancelar()
    {
        if ($this->oficios_id && !$this->ver){
            $this->show($this->oficios_id);
        }else{
            $this->limpiar();
        }
    }

    public function btnRepetido()
    {
        if ($this->repetido){
            $this->repetido = false;
        }else{
            $this->repetido = true;
        }
    }

    public function buscar()
    {
        $this->limpiar();
    }

    public function limpiarBuscar()
    {
        $this->reset('keyword');
        $this->btnCancelar();
    }



}
