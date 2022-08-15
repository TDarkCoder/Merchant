<?php

namespace App\Models;

use App\Traits\QueryOperations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory, QueryOperations;

    public $fillable = [
        'name',
    ];

    public function scopeFilter(Builder $builder, Request $request): void
    {
        $builder->when($request->name, fn(Builder $builder, string $name): Builder => $builder
            ->where('name', 'like', "%$name%")
        );
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
