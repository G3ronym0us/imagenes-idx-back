<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Filtrarconsulta extends Component
{
    public $documento;

    /**
     * valida pero deja pasar a consultar el dato
    */
    /* public function updatedDocumento()
    {
        $this->validate([
            'documento' => 'required|integer|max:10',
        ]);
    } */

    public function filtrarconsultas()
    {
        $campos = [
            'documento' => 'required|alpha_num',
        ];
        $msj = [
            'documento.required'=>'El Numero de Documento no puede estar vacio!!',
            'documento.alpha_num'=>'El Numero de Documento debe ser solo alphanumerico!!',
        ];

        $this->validate($campos,$msj);

        $this->emit('padrefiltroconsulta',$this->documento);
    }

    public function render()
    {
        return view('livewire.filtrarconsulta');
    }
}
