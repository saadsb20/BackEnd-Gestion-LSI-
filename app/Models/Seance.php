<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;
    protected $fillable = [
        'jour',
        'temps',
        'id_module',
        'id_semestre',
        'salle'
    ];

    protected $casts = [
    'temps' => 'date:hh:mm'
];
}
