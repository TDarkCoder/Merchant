<?php

namespace App\Models;

use App\Traits\QueryOperations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory,
        QueryOperations,
        SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'is_public',
    ];

    public function scopeFilter(Builder $builder, Request $request): void
    {
        $builder
            ->when($request->name, fn(Builder $builder, string $name): Builder => $builder
                ->where('name', 'like', "%$name%")
            )
            ->when($request->min_price && $request->max_price, fn(Builder $builder): Builder => $builder
                ->whereBetween('price', [$request->min_price, $request->max_price])
            )
            ->when(!is_null($request->is_public), fn(Builder $builder): Builder => $builder
                ->where('is_public', $request->is_public)
            )
            ->when($request->categoryId, fn(Builder $builder, int $categoryId): Builder => $builder
                ->whereHas('categories', fn(Builder $builder): Builder => $builder
                    ->where('id', $categoryId)
                )
            );
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
