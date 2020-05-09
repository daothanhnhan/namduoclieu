<?php 
    $sidebar_pro_new = $action_product->getListProductNew_hasLimit(5);
?>
<div class="gb-product-sidebar-miavn widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-miavn">Sản phẩm bán chạy</h3>
        <div class="widget-content">
            <div class="gb-newlist-details">
                <?php 
                foreach ($sidebar_pro_new as $item) { 
                    $row = $item;
                    $rowLang = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                ?>
                <div class="gb-product-sidebar_ruouvang-item">
                    <div class="gb-product-sidebar_ruouvang-item-img">
                        <a href="/<?= $rowLang['friendly_url'] ?>"><img src="<?= $row['product_img'] ?>" alt="review" class="img-responsive"></a>
                    </div>
                    <div class="gb-product-sidebar_ruouvang-item-info">
                        <h4><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_product_name'] ?></a></h4>
                        <!--PRICE-->
                        <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0002.php";?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </aside>
</div>