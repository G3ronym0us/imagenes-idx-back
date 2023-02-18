<?php

namespace App\Http\Livewire;

use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TicketDetail extends Component
{
    public $ticket;
    public $nextStatus;

    public function mount($id)
    {
        $this->loadTickets($id);
    }

    public function render()
    {
        return view('livewire.ticket-detail');
    }

    public function loadTickets($id)
    {
        $this->ticket = Ticket::with(['status' => function ($query) {
            $query->orderBy('created_at', 'DESC');
        }])->find($id);
        foreach ($this->ticket->status as $key => $status) {
            $this->ticket->status[$key]->user = User::find($status->pivot->user_id);
        }
        $this->nextStatus = Status::where('order', $this->ticket->status->max('order') + 1)->first();
    }

    public function changeStatus($id)
    {
        $this->ticket->status()->attach($id, ['user_id' => Auth::id()]);
        $this->loadTickets($this->ticket->id);
    }
}
