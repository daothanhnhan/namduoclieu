<div class="gb-price-chitiet">
    <p class="price-chitiet">
        <span class="main-price"><?= number_format($row['product_price_sale']) ?>đ</span>
        <span class="price-compare main-price-compare"><?= number_format($row['product_price']) ?>đ</span>
    </p>
    <p class="discount main-discount">Tiết kiệm&nbsp;<span><?= number_format($row['product_price']-$row['product_price_sale']) ?>đ</span> (<span><?= number_format(($row['product_price']-$row['product_price_sale'])/$row['product_price']*100,0) ?>%</span>)</p>
</div>