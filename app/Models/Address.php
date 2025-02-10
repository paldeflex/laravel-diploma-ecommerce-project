<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'street_address',
        'city',
        'region',
        'zip_code',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getFullNameAttribute(): string
    {
        return `$this->first_name $this->last_name`;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
