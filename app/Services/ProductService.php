<?php

namespace App\Services;

use App\Enums\Pagination;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    public function get(Request $request)
    {
        return Product
            ::filter($request)
            ->prepare($request)
            ->paginate(Pagination::DefaultLimit);
    }

    public function create(array $data): Product
    {
        $product = Product::create($data);
        $this->syncCategories($product, $data);

        return $product;
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        $this->syncCategories($product, $data);

        return $product;
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }

    public function syncCategories(Product $product, array $data): void
    {
        if (isset($data['categories'])) {
            $product->categories()->sync($data['categories']);
        }
    }
}
