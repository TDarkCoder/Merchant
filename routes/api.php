<?php

use App\Http\Controllers\ProductController;

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
