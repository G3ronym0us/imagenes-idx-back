<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|confirmed:password_confirmation',
        'password_confirmation' => 'required',
    ];

    protected $messages =  [
        'firstname.required' => 'El Nombre es requerido!',
        'firstname.string' => 'El Nombre debe ser una cadena de texto!',
        'lastname.required' => 'El Apellidos es requerido!',
        'lastname.string' => 'El Apellidos debe ser una cadena de texto!',
        'email.email' => 'El Email debe tener el formato correcto',
        'password.required' => 'La contraseña es requerida',
        'password.confirmed' => 'La contraseña deben coincidir',
        'password_confirmation.required' => 'La confirmacion de contraseña es requerida!',
    ];


    public function render()
    {
        return view('livewire.create-user');
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole('Worker');

        return redirect('/users');
    }
}
