<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.dashboard');
});
Route::controller(\App\Http\Controllers\FrontEnd\ProductController::class)->group(function(){
    Route::get('/','index')->name('user.index');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/dashboard',function(){
    return view('admin.dashboard');
});

Route::middleware(['auth',AdminMiddleware::class])->group(function(){
    Route::get('admin/dashboard',function(){
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::controller(CategoryController::class)->group(function () {
        Route::get('admin/categories', 'index')->name("admin.categories.index");  
        Route::get('admin/categories/create', 'create')->name("admin.categories.create");
        Route::post('admin/categories', 'store')->name("admin.categories.store");
        Route::delete('admin/categories/delete/{id}', 'destroy')->name("admin.categories.destroy");
        Route::get('admin/categories/edit/{id}', 'edit')->name("admin.categories.edit");
        Route::put('admin/categories/update/{id}', 'update')->name("admin.categories.update");
        Route::get('admin/categories/image/{id}', 'image')->name('admin.categories.image');

    });

    Route::controller(BrandController::class)->group(function() {
        Route::get('admin/brands','index')->name('admin.brands.index');
        Route::get('admin/brands/create','create')->name('admin.brands.create');
        Route::post('admin/brands', 'store')->name("admin.brands.store");
        Route::delete('admin/brands/delete/{id}', 'destroy')->name("admin.brands.destroy");
        Route::get('admin/brands/edit/{id}', 'edit')->name("admin.brands.edit");
        Route::put('admin/brands/update/{id}', 'update')->name("admin.brands.update");
        Route::get('admin/brands/image/{id}', 'image')->name('admin.brands.image');
    });

    Route::controller(ProductController::class)->group(function() {
        Route::get('admin/products','index')->name('admin.products.index');
        Route::get('admin/producs/create','create')->name('admin.products.create');
        Route::post('admin/products', 'store')->name("admin.products.store");
        Route::get('admin/products/edit/{id}', 'edit')->name("admin.products.edit");
        Route::put('admin/products/{id}', 'update')->name("admin.products.update");
        Route::delete('admin/products/{id}', 'destroy')->name("admin.products.destroy");

        Route::get('admin/products/image/{id}', 'image')->name("admin.products.image");
        Route::post('admin/products/image/{id}', 'imageStore')->name("admin.products.image.store");
        Route::delete('admin/products/image/{id}', 'imageDestroy')->name("admin.products.image.destroy");

    });
    
    
    

});
require __DIR__.'/auth.php';
