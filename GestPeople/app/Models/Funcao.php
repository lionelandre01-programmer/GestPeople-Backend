<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Funcao extends Model
{
    protected $fillable = [
        'denominacao',
        'salary_id',
        'responsabilidade',
    ];

    public function salary():HasOne
    {
        return $this->hasOne(Salary::class, 'salary_id', 'id');
    }
    
}
