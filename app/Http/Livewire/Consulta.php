<?php

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\Status;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Consulta extends Component
{
    public $documento;
    public $currentTicket;

    public $document;

    protected $rules = [
        "document" => 'required|alpha_num'
    ];

    protected $messages = [
        'document.required' => 'El documento es requerido',
        'document.alpha_num' => 'El documento no tiene el formato requerido',
    ];

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

    public function assignDate()
    {
        $this->validate();

        $ticket = new Ticket();
        $ticket->documento = $this->document;
        $ticket->save();

        $status = Status::where('order',1)->first();
        $ticket->status()->attach($status->id, ['user_id' => Auth::id()]);

        $this->document = null;

        $this->addError('success', 'La cita ha sido asignada con exito!');

    }
}
