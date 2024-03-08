<h1>Thêm sản phẩm mới</h1>
<form action="<?= route('products.add-product') ?>" method="POST">
    <div>
        <input type="text" name="product-name" placeholder="Tên sản phẩm">
        {{-- <input type="hidden" name="_token" value="<?= csrf_token() ?>"> --}}

        <?= csrf_field()?>
    </div>
    
        <button type="submit">Thêm</button>
    </form>