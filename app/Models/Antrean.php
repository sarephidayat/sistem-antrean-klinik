<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrean extends Model
{
    protected $table = 'antrean';

    protected $fillable = [
        'poli_id',
        'antrean_date',
        'number',
        'queue_number',
        'status_id',
        'called_at',
        'finished_at',
        'called_by',
    ];
}
