<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Messege extends Model
{
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'body',
        'delete'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
