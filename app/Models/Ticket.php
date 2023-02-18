<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * @var string
     */
    //protected $table = 'tickets';

    /**
     * si solo quieres utilizar created_at debes asignarle a updated_at el valor de null
    */
    //const UPDATED_AT = null;

    /**
     * no utilizar los campos created_at y updated_at
    */
    //public $timestamps = false;

    protected $fillable = [
        'documento',
        'codigo',
        'orden_de_servicio',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function status(){
        return $this->belongsToMany(Status::class, 'histories', 'ticket_id', 'status_id')->withPivot('user_id')->withTimestamps();
    }
}
