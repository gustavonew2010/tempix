<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryGame extends Model
{
    use HasFactory;

    protected $table = 'category_game';

    protected $fillable = [
        'category_id',
        'game_id'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
