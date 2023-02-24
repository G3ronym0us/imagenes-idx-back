<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SeeResults extends Component
{
    public $documentNumber;

    public function render()
    {
        return view('livewire.see-results');
    }
}
