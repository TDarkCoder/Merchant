<?php

namespace App\Http\Requests\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string',
            'category_id' => 'sometimes|exists:' . Category::class . ',id',
            'min_price' => 'sometimes',
            'max_price' => 'sometimes|gt:min_price',
            'is_public' => 'sometimes|boolean',
            ...Product::$validators,
        ];
    }
}
