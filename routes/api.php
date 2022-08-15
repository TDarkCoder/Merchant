<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

//Categories
Route::group([
    'prefix' => 'categories',
    'controller' => CategoryController::class,
], static function (): void {
    Route::name('categories.')->group(static function (): void {
        Route::get('/', 'index')->name('index');
        Route::post('/{category?}', 'save')->name('save');
        Route::delete('/{category}', 'destroy')->name('destroy');
    });
});

//Products
Route::group([
    'prefix' => 'products',
    'controller' => ProductController::class,
], static function (): void {
    Route::name('products.')->group(static function (): void {
        Route::get('/', 'index')->name('index');
        Route::post('/{product?}', 'save')->name('save');
        Route::delete('/{product}', 'destroy')->name('destroy');
    });
});
