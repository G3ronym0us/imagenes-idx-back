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
            'documento' => 'required|integer',
        ];
        $msj = [
            'documento.required'=>'El Numero de Documento no puede estar vacio!!',
            'documento.integer'=>'El Numero de Documento debe ser solo numeros!!',
        ];

        $this->validate($campos,$msj);

        $this->emit('padrefiltroconsulta',$this->documento);
    }

    public function render()
    {
        return view('livewire.filtrarconsulta');
    }
}
