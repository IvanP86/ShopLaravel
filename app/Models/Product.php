<?php

namespace App\Models;

use App\Http\Filters\ProductFilter;
use App\Models\Traits\HasFilter;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

#[ObservedBy(ProductObserver::class)]
class Product extends Model
{
    use HasFilter;
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function params(): BelongsToMany
    {
        return $this->belongsToMany(Param::class)->withPivot('value');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Product::class, 'parent_id', 'id');
    }

    public function getPreviewImageUrlAttribute(): null|string
    {
        return $this->images()->first()->url ?? null;
    }

    public function scopeCategoryWithChildren(Builder $builder, Collection $categories)
    {
        $builder->whereIn('category_id', $categories->pluck('id'));
    }

    public function paramProducts(): HasMany
    {
        return $this->hasMany(ParamProduct::class, 'product_id', 'id');
    }

    // public function scopeFilter(Builder $builder, $data): Builder
    // {
    //     $filter = new ProductFilter();
    //     return $filter->apply($builder, $data);
    // }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getHasChildrenAttribute(): bool
    {
        return $this->children()->exists();
    }
    public function getGroupedParamsAttribute(): array
    {
        return $this->params->groupBy('title')->map(function ($param) {
            return [
                'title' => $param->first()->title,
                'label' => $param->first()->label,
                'values' => $param->pluck('pivot.value')->toArray()
            ];
        })->values()->toArray();
    }
}
