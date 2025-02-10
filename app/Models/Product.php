<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'coating_type_id',
        'name',
        'slug',
        'description',
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

    public function coatingType(): BelongsTo
    {
        return $this->belongsTo(CoatingType::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'in_stock' => 'boolean',
            'on_sale' => 'boolean',
        ];
    }
}
