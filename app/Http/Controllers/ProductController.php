<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public  function __construct()
    {

    }

    //hiển thị danh sách sản phẩm
    public function index(){
        return view('clients/products/product');
    }

    // lấy ra 1 sản phẩm theo id
    public function getProduct($id=null){
        return view('clients/products/detail',  ['id' => 
     $id]);
    }

    //cập nhật 1 sản phẩm (POST)
    public function handleUpdateProduct($id){
        return 'submit sửa sản phẩm';

    }

    //thêm 1 sản phẩm (GET)
    public function formAddProduct(){
        return view('clients/products/add');
    }


    //tạo 1 sản phẩm (POST)
    public function handleAddProduct(){
        // return redirect(route('products.add-product'));
        return 'submit thêm sản phẩm';
    }

    //xóa 1 sản phẩm (delete)
    public function deleteProduct($id){
        return 'submit xóa sản phẩm';

    }
}
