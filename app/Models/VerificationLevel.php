<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationLevel extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color_hex',
        'description',
        'withdrawal_limit',
        'requirements',
        'points_required'
    ];

    protected $casts = [
        'requirements' => 'array',
        'withdrawal_limit' => 'decimal:2'
    ];

    public function userVerifications()
    {
        return $this->hasMany(UserVerification::class);
    }
} 