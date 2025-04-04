<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'images',
        'price',
        'is_active',
        'is_featured',
        'in_stock',
        'on_sale',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function coatingTypes(): BelongsToMany
    {
        return $this->belongsToMany(CoatingType::class, 'coating_type_product');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (is_array($this->images) && ! empty($this->images[0])) {
            return asset("storage/{$this->images[0]}");
        }

        return asset('images/product-not-found.webp');
    }

    public function getImagesUrlsAttribute(): array
    {
        if (is_array($this->images) && count($this->images) > 0) {
            return array_map(function ($image) {
                return $image
                    ? asset("storage/{$image}")
                    : asset('images/product-not-found.webp');
            }, $this->images);
        }

        return [asset('images/product-not-found.webp')];
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'in_stock' => 'boolean',
            'on_sale' => 'boolean',
            'images' => 'array',
        ];
    }
}
