<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    protected $fillable = [
        'voyage_id',
        'user_id',
        'autorisation_parent',
    ];

    public function voyage(): BelongsTo
    {
        return $this->belongsTo(Voyage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}