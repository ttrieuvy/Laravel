<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController as ControllerProduct;
use App\Http\Controllers\Admin\CategoriesController ;


Route::get('/', function () {
    return view('welcome');
});

// Route::match(['put','delete','patch'], 'hihi', function(Request $request){
//     return $request->method();
// });
// Route::any('hihi', function(Request $request){
//     return $request->method();
// });

// Route::get('hihi', function(){
// //    $user = new User();
// //    $allUser = $user::all();
// //    dd($allUser);
//     return view('home');
// });


// Route::redirect('hihi','https://facebook.com'); //khi người dùng truy cập đến route hihi sẽ được chuyển đến trang facebook 

// Route::get('hihi', function(){
//     return  view('trangchu');
// });

// Route::get('hihi/{id?}', function($id =  null){
//     $content = 'số trên URL là ';
//     $content .=  $id;
//     return $content;
// })->name('trang-chu');



// làm việc với controller
Route::prefix('products')->group(function(){

    // lấy danh sách sản phẩm
    Route::get('/', [ControllerProduct::class, 'index'])->name('products.index');

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

Route::prefix('admin')->group(function(){
    Route::resource('categories',CategoriesController::class);
});

