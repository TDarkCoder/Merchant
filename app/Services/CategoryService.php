<?php

namespace App\Services;

use App\Enums\Pagination;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryService
{
    public function get(Request $request)
    {
        return Category
            ::filter($request)
            ->prepare($request)
            ->paginate(Pagination::DefaultLimit);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data): Category
    {
        $category->update($data);

        return $category;
    }

    public function delete(Category $category): void
    {
        abort_if($category->products()->count() > 0, Response::HTTP_FORBIDDEN, 'Category has attached products');

        $category->delete();
    }
}
