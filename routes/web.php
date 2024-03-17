<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ProductsController as ControllerProduct;
use App\Http\Controllers\Admin\CategoriesController ;


Route::get('/', function (){
    return view("show-form");
})->name('trang-chu');


// làm việc với controller
Route::prefix('products')->group(function(){

    // lấy danh sách sản phẩm
    Route::get('/', [ControllerProduct::class, 'index']);

    // lấy chi tiết 1 sản phẩm (GET)
    Route::get('/get-product/{id?}', [ControllerProduct::class, 'getProduct'])->name('products.get-product');

    //cập nhật 1 sản phẩm (POST)
    Route::post('update-product/{id?}', [ControllerProduct::class, 'handleUpdateProduct']);

    //form thêm 1 sản phẩm mới (GET)
    Route::get('add-product', [ControllerProduct::class, 'formAddProduct'])->name('products.add-product');

    //them 1 sản phẩm mới (POST)
    Route::post('add-product', [ControllerProduct::class, 'handleAddProduct']);

    Route::put('add-product', [ControllerProduct::class, 'putProduct']);

    Route::delete('delete-product/{id?}', [ControllerProduct::class, 'deleteProduct'])->name('products.delete-product');
});


Route::middleware('checkLogin.admin')->prefix('admin')->group(function(){
    Route::middleware('checkLogin.admin')->get('/', [CategoriesController::class, 'test']);

    Route::resource('categories',CategoriesController::class);
});

