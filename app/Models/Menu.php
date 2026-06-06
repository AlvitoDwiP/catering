<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;

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

    protected $appends = ['image_url', 'image_placeholder_url'];

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

        $path = $this->resolveImagePath();

        return $path ? Vite::asset($path) : Vite::asset(config('image-map.placeholders.menu'));
    }

    public function getImagePlaceholderUrlAttribute(): string
    {
        $path = $this->resolvePlaceholderPath();

        return $path ? Vite::asset($path) : Vite::asset(config('image-map.placeholders.menu'));
    }

    protected function resolveImagePath(): ?string
    {
        $menuImage = Arr::get(config('image-map.images.menus'), $this->slug);

        if ($menuImage) {
            return $menuImage;
        }

        $categorySlug = $this->relationLoaded('category')
            ? $this->category?->slug
            : null;

        $visualCategorySlug = match ($categorySlug) {
            'nasi-kotak' => 'nasi-box',
            'paket-catering' => 'catering-harian',
            default => $categorySlug,
        };

        if ($visualCategorySlug) {
            $categoryImage = Arr::get(config('image-map.images.categories'), $visualCategorySlug);

            if ($categoryImage) {
                return $categoryImage;
            }
        }

        $normalizedName = Str::slug($this->name);

        return Arr::get(config('image-map.images.menus'), $normalizedName)
            ?? Arr::get(config('image-map.images.categories'), $normalizedName)
            ?? Arr::get(config('image-map.placeholders'), 'menu');
    }

    protected function resolvePlaceholderPath(): ?string
    {
        $menuPlaceholder = Arr::get(config('image-map.placeholders'), $this->slug);

        if ($menuPlaceholder) {
            return $menuPlaceholder;
        }

        $categorySlug = $this->relationLoaded('category')
            ? $this->category?->slug
            : null;

        $visualCategorySlug = match ($categorySlug) {
            'nasi-kotak' => 'nasi-box',
            'paket-catering' => 'catering-harian',
            default => $categorySlug,
        };

        if ($visualCategorySlug) {
            $categoryPlaceholder = Arr::get(config('image-map.placeholders'), $visualCategorySlug);

            if ($categoryPlaceholder) {
                return $categoryPlaceholder;
            }
        }

        return Arr::get(config('image-map.placeholders'), 'menu');
    }
}
