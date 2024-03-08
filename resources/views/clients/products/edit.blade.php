<h1>Cập nhật sản phẩm: <?= $id?></h1>
<form action="<?= route('products.update-product') ?>" method="POST">
<div>
    <input type="text" name="product-name" placeholder="Tên sản phẩm">
    <input type="hidden" name="_token" value="<?= csrf_token() ?>">
</div>

    <button type="submit">Gửi</button>
</form>