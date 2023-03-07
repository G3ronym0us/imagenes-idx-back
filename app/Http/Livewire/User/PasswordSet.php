<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PasswordSet extends Component
{

    public $user;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'password' => 'required|confirmed:password_confirmation',
        'password_confirmation' => 'required',
    ];

    protected $messages =  [
        'password.required' => 'La contraseña es requerida',
        'password.confirmed' => 'La contraseña deben coincidir',
        'password_confirmation.required' => 'La confirmacion de contraseña es requerida!',
    ];

    public function mount($token)
    {
        $this->user = User::where('remember_token', $token)->first();
        if(!$this->user){
            return redirect(url('login'));
        }
        $this->user->update(['remember_token' => null]);
    }

    public function render()
    {
        return view('livewire.user.password-set')->layout('layouts.guest');
    }

    public function save(){
        $this->validate();

        $this->user->update([
            'password' => Hash::make($this->password),
        ]);

        return redirect('/login');
    }
}
