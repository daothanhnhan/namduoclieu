<div class="gb-datmuagiaohangtannoi-mia">
    <input type="hidden" name="id" id="product_id" value="<?php echo $rowLang['product_id']; ?>">
    <input type="hidden" name="name" id="product_name" value="<?= $rowLang['lang_product_name']; ?>">
    <input type="hidden" name="link" id="product_link" value="<?= $rowLang['friendly_url']; ?>">
    <input type="hidden" name="image" id="product_img" value="<?php echo $row['product_img']; ?>">
    <input type="hidden" name="price" id="product_price" value="<?php echo $row['product_price_sale']; ?>">
    <button class="btn-order-product in-stock btn_addCart">ĐẶT HÀNG ONLINE<br><span>(Giao hàng - thanh toán tại nhà)</span></button>
</div>