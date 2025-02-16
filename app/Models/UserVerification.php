<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    protected $fillable = [
        'user_id',
        'verification_level_id',
        'points',
        'completed_steps',
        'verification_history'
    ];

    protected $casts = [
        'completed_steps' => 'array',
        'verification_history' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function level()
    {
        return $this->belongsTo(VerificationLevel::class, 'verification_level_id');
    }

    public function addPoints($points)
    {
        $this->points += $points;
        $this->checkLevelUp();
        $this->save();
    }

    public function checkLevelUp()
    {
        $nextLevel = VerificationLevel::where('points_required', '>', $this->points)
            ->orderBy('points_required', 'asc')
            ->first();

        if ($nextLevel && $this->points >= $nextLevel->points_required) {
            $this->verification_level_id = $nextLevel->id;
            $this->addToHistory('level_up', $nextLevel->name);
        }
    }

    private function addToHistory($type, $detail)
    {
        $history = $this->verification_history ?? [];
        $history[] = [
            'type' => $type,
            'detail' => $detail,
            'date' => now()->toDateTimeString()
        ];
        $this->verification_history = $history;
    }
} 