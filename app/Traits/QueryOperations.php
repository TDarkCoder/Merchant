<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait QueryOperations
{
    public static array $validators = [
        'order_by' => 'sometimes|array|min:2|max:2',
        'with' => 'sometimes',
        'with_deleted' => 'sometimes|boolean',
    ];

    public function scopePrepare(Builder $builder, Request $request): Builder
    {
        if (($orderBy = $request->order_by) && count($orderBy) === 2) {
            [$key, $value] = $orderBy;

            $builder->orderBy($key, $value);
        }

        if ($request->with_deleted) {
            $builder->withTrashed();
        }

        return $builder->with($request->with ?? []);
    }
}
