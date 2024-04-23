<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function scopeSort(Builder $query, ?string $sort = null): Builder
    {
        return match ($sort) {
            default => $query->orderByRaw('created_at DESC, id DESC'),
            'old-new' => $query->orderByRaw('created_at ASC, id DESC'),
            'expensive-cheap' => $query->orderByRaw('price DESC, id DESC'),
            'cheap-expensive' => $query->orderByRaw('price ASC, id DESC'),
        };
    }

    public function scopeSearch(Builder $query, ?string $search = null): Builder
    {
        return $query->when($search, fn($query) => $query->where('name', 'like', "%$search%"));
    }
}
