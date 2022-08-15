<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
{
    public function rules(): array
    {
        $status = $this->route('category') ? 'sometimes' : 'required';

        return [
            'name' => "$status|string",
        ];
    }
}
