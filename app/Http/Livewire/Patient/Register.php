<?php

namespace App\Http\Livewire\Patient;

use Livewire\Component;

class Register extends Component
{
    public $document;

    protected $rules = [
        "document" => 'required|alpha_num'
    ];

    protected $messages

    public function render()
    {
        return view('livewire.patient.register');
    }

    public function assignDate(){
        $this->validate();


    }
}
