<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'visible_name',
        'order',
    ];

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'histories', 'status_id', 'ticket_id')->withPivot('user_id')->withTimestamps();
    }
}
