<?php

namespace App\Http\Requests\Product;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
{
    public function rules(): array
    {
        $status = $this->route('product') ? 'sometimes' : 'required';

        return [
            'name' => "$status|string",
            'categories' => 'sometimes|array|min:2|max:10',
            'categories.*' => 'sometimes|exists:' . Category::class . ',id',
            'price' => "$status|numeric",
            'is_public' => "$status|boolean",
        ];
    }
}
