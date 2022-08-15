<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\IndexRequest;
use App\Http\Requests\Category\SaveRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService;
    }

    public function index(IndexRequest $request): JsonResponse
    {
        return response()->json($this->categoryService->get($request));
    }

    public function save(SaveRequest $request, ?Category $category = null): Category
    {
        if ($category) {
            return $this->categoryService->update($category, $request->validated());
        }

        return $this->categoryService->create($request->validated());
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->categoryService->delete($category);

        return response()->json('OK');
    }
}
