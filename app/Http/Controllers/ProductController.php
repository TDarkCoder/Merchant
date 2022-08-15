<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\IndexRequest;
use App\Http\Requests\Product\SaveRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService;
    }

    public function index(IndexRequest $request): JsonResponse
    {
        return response()->json($this->productService->get($request));
    }

    public function save(SaveRequest $request, ?Product $product = null): Product
    {
        if ($product) {
            return $this->productService->update($product, $request->validated());
        }

        return $this->productService->create($request->validated());
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->productService->delete($product);

        return response()->json('OK');
    }
}
