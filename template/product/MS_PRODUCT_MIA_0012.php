<?php 
    $product_list_brand = $action_product->listSameBrand($product_brand, 8);
    
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<div class="gb-home-product gb-home-product-relate">
    <div class="container">
        <div class="gb-home-product-relate-title">
            <a href="/brand/1/<?= $str_id_brand ?>">Cùng thương hiệu <?= getBrand($product_brand)['name'] ?><div class="border hidden-xs"></div></a>
            <a href="/brand/1/<?= $str_id_brand ?>" class="xemthem-list">Xem tất cả <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
        <div class="gb-home-product-relate-slide owl-carousel owl-theme">
            <?php 
            foreach ($product_list_brand as $item) {
                $row = $item;
                $rowLang = $action_product->getProductLangDetail_byId($row['product_id'],$lang); 
                $list_group = $action->listGroup($row['product_group_id']);
            ?>
            <div class="item">
                <div class="gb-product_ruouvang-item">
                    <!-- <div class="gb-product-loop-miavn">
                        <div class="gb-product-loop-miavn-slide owl-carousel owl-theme">
                            <?php foreach ($list_group as $itemp) {  ?>
                            <div class="item">
                                <img src="/images/<?= $itemp['product_img'] ?>" alt="" class="img-responsive" onclick="sub_img_brand(<?= $itemp['product_id'] ?>, <?= $row['product_id'] ?>)">
                            </div>
                            <?php } ?>
                        </div>
                    </div> -->
                    <div class="gb-product_ruouvang-item-img" id="img-brand-<?= $row['product_id'] ?>">
                        <a href="/<?= $rowLang['friendly_url'] ?>"><img src="<?= $row['product_img'] ?>" alt="<?= $rowLang['lang_product_name'] ?>" class="img-responsive"></a>
                    </div>
                    <div class="gb-product_ruouvang-item-text" id="text-brand-<?= $row['product_id'] ?>">
                        <a href="/<?= $rowLang['friendly_url'] ?>" class="brand_mia"><?= $action->getBrand($row['product_brand'])['name']; ?></a>
                        <!--PERCENT-->
                        <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0006.php";?>

                        <h2><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_product_name'] ?></a></h2>
                        <!--PRICE-->
                        <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0002.php";?>
                    </div>
                    <div class="gb-product_ruouvang-item-yeumua" id="mua-brand-<?= $row['product_id'] ?>">
                        <!--MUA HÀNG-->
                        <?php include DIR_CART."MS_CART_MIA_0001.php";?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        var owl = $('.gb-home-product-relate-slide');
        owl.owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
            nav:true,
            dots:false,
            autoplay: true,
            rewind: true,
            navText:[],
            responsive:{
                0:{
                    items:1,
                },
                767:{
                    items:3,
                },
                992:{
                    items:5,
                }
            }
        });
    });
</script>
<script>
    function sub_img_brand (id, idp) {
        // alert(id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var out = this.responseText;
             var json = JSON.parse(out);
             // alert(json.image);
             document.getElementById("img-brand-"+idp).innerHTML = json.image;
             document.getElementById("text-brand-"+idp).innerHTML = json.text;
             document.getElementById("mua-brand-"+idp).innerHTML = json.mua;
            }
          };
          xhttp.open("GET", "/functions/ajax/sub_img.php?id="+id, true);
          xhttp.send();
    }
</script>