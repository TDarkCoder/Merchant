<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

trait QueryOperations
{
    public static array $validators = [
        'order_by' => 'sometimes|array|min:2|max:2',
        'with' => 'sometimes',
        'with_deleted' => 'sometimes|boolean',
    ];

    public function scopePrepare(Builder $builder, Request $request): Builder
    {
        try {
            [$key, $value] = $request->order_by;

            $builder->orderBy($key, $value);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        if ($request->with_deleted) {
            try {
                $builder->withTrashed();
            } catch (Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

        try {
            $builder->with($request->with ?? []);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        return $builder;
    }
}
