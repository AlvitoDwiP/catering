<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_category_id',
        'name',
        'slug',
        'description',
        'price',
        'unit',
        'minimum_order',
        'image',
        'is_available',
        'is_recommended',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'minimum_order' => 'integer',
        'is_available' => 'boolean',
        'is_recommended' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'menu_ingredients')
            ->withPivot(['quantity_per_portion', 'unit'])
            ->withTimestamps();
    }

    public function menuIngredients(): HasMany
    {
        return $this->hasMany(MenuIngredient::class);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_available', true);
    }

    public function scopeRecommended(Builder $query): Builder
    {
        return $query->where('is_recommended', true);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . ltrim($this->image, '/'));
        }

        return 'https://placehold.co/640x480/F1EAE2/6F675F?text=Nad%27s+Kitchen';
    }
}
