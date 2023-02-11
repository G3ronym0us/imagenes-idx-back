<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * @var string
     */
    //protected $table = 'documents';

    protected $fillable = [
        'numeroDocumento',
        'numeroArchivo',
        'tipo',
        'codigo',
        'ruta',
        'name',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
