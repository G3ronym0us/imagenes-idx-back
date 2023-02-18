<?php

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\Ticket;
use Livewire\Component;

class Consulta extends Component
{
    public $documento;
    public $currentTicket;

    //
    protected $listeners = ['padrefiltroconsulta' => 'cargardatos'];

    public function cargardatos($documento)
    {
        $this->documento = $documento;
    }

    public function render()
    {
        $tickets = [];

        if (!empty($this->documento)) {
            $tickets = Ticket::where('documento', $this->documento)->orderBy('created_at', 'DESC')->get();


            if (count($tickets) < 1) {
                session()->flash('errorconsulta', 'Disculpe no existe el Numero de Documento!!');
            }
        }

        return view('livewire.consulta', [
            'tickets' => $tickets
        ]);
    }

    public function selectTicket($id){
        return redirect("/tickets/details/{$id}");
    }
}
