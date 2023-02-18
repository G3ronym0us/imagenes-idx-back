<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $user;
    public $firstname;
    public $lastname;
    public $email;

    protected $rules = [
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email',
    ];

    protected $messages =  [
        'firstname.required' => 'El Nombre es requerido!',
        'firstname.string' => 'El Nombre debe ser una cadena de texto!',
        'lastname.required' => 'El Apellidos es requerido!',
        'lastname.string' => 'El Apellidos debe ser una cadena de texto!',
        'email.email' => 'El Email debe tener el formato correcto',
    ];

    public function mount($id){
        $this->user = User::find($id);
        $this->firstname = $this->user->firstname;
        $this->lastname = $this->user->lastname;
        $this->email = $this->user->email;
    }

    public function render()
    {
        return view('livewire.edit-user');
    }

    public function save()
    {
        $this->validate();

        $this->user->update([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
        ]);

        return redirect('/users');
    }
}
