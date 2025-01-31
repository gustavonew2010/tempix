<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'slug',
        'icon',           // Para ícone do menu
        'order',          // Para ordenação no menu
        'is_menu_item',   // Para identificar se aparece no menu
        'is_dropdown',    // Para identificar se é um dropdown
        'parent_id',      // Para itens dentro de dropdowns
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_menu_item' => 'boolean',
        'is_dropdown' => 'boolean',
    ];

    /**
     * Get the parent category
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order');
    }

    /**
     * Get the games associated with the category
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'category_game');
    }

    /**
     * Scope para itens do menu
     */
    public function scopeMenuItems($query)
    {
        return $query->where('is_menu_item', true)->orderBy('order');
    }

    /**
     * Scope para itens principais do menu (sem parent)
     */
    public function scopeMainMenuItems($query)
    {
        return $query->whereNull('parent_id')
                    ->where('is_menu_item', true)
                    ->orderBy('order');
    }
}
