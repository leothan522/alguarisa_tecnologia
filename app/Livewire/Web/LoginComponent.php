<?php

namespace App\Livewire\Web;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class LoginComponent extends Component
{
    use LivewireAlert;

    public $login_email, $login_password;

    public function render()
    {
        return view('livewire.web.login-component');
    }

    public function login()
    {
        $rules = [
            'login_email'       => ['required', 'email', Rule::exists('users', 'email')],
            'login_password'    => 'required'
        ];

        $messages = [
            'login_email.required'       => 'El email es obligatorio.',
            'login_email.email'       => 'El email no es un correo válido.',
            'login_email.exists'       => 'El email seleccionado es inválido.',
            'login_password.required'       => 'La contresaña es obligatoria.'
        ];

        $this->validate($rules, $messages);

        $credentials = [
            'email'     =>  $this->login_email,
            'password'  =>  $this->login_password
        ];

        if (Auth::attempt($credentials)){
            $this->dispatch('cerrarModalLogin', nombre: Auth::user()->name);
        }else{
            $this->addError('login_validacion', 'Las credenciales proporcionadas no coinciden con nuestros registros.');
        }

    }

    #[On('cerrarModalLogin')]
    public function cerrarModalLogin($nombre)
    {
        //cerrar con JS el modal
    }
}
