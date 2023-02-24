<?php

namespace App\Http\Livewire;

use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TicketDetail extends Component
{
    public $ticket;
    public $nextStatus;
    public $firstStatus = null;
    public $transcription;
    public $load;
    public $transcriptionStatus;
    public $loadStatus;

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
        $this->firstStatus = $this->ticket->status->max('order') == 1 ? Status::where('order', 1)->first() : null;
        if($this->ticket->status->max('order') >= 4){
            $this->transcription = $this->ticket->status->firstWhere('order', 5);
            $this->transcriptionStatus = $this->transcription == null ? Status::where('order', 5)->first() : null;
            $this->load = $this->ticket->status->firstWhere('order', 6);
            $this->loadStatus = $this->load == null ? Status::where('order', 6)->first() : null;
            $this->nextStatus = null;
        }
    }

    public function changeStatus($id)
    {
        $this->ticket->status()->attach($id, ['user_id' => Auth::id()]);
        $this->loadTickets($this->ticket->id);
    }

    public function reassignStatus()
    {
        $this->ticket->status[0]->pivot->updated_at = Carbon::now();
        $this->ticket->status[0]->pivot->save();
        $this->loadTickets($this->ticket->id);
    }
}
