<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desconto extends Model
{
    protected $fillable = [
        'faltas',
        'atrasos',
        'justificadas'
    ];
}
