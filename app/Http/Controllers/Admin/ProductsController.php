<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\db_product;

class ProductsController extends Controller
{
    private $products;
    public  function __construct(db_product $products)
    {
        $this->products = $products;
        echo 'khởi động';
    }

    //hiển thị danh sách sản phẩm
    public function index(){

       $data = $this->products->getAll();
       echo '<h1> hehe</h1>';
        return view('admin/products/product', ['id' => $data]);
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
