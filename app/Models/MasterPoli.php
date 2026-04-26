<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPoli extends Model
{
    protected $table = 'master_poli';

    protected $fillable = [
        'name',
        'code',
        'is_active',
    ];
}