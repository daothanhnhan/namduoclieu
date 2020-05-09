<?php 
    $home_vali = $action_product->getProductList_byMultiLevel_orderProductId_run('','desc',1,8,'')['data'];
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<div class="gb-tieubieu-product_ruouvang" style="padding-top: 30px">
    <div class="container">
        <div class="gb-tieubieu-product_ruouvang-title">
            <b></b>
            <h3>SẢN PHẨM BÁN CHẠY</h3>
            <b></b>
        </div>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <?php 
                $d = 0;
                foreach ($home_vali as $item) {
                    $d++;
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
                                    <img src="/images/<?= $itemp['product_img'] ?>" alt="" class="img-responsive" onclick="sub_img_run(<?= $itemp['product_id'] ?>, <?= $row['product_id'] ?>)">
                                </div>
                                <?php } ?>
                            </div>
                        </div> -->
                        <div class="gb-product_ruouvang-item-img" id="img-run-<?= $row['product_id'] ?>">
                            <a href="/<?= $rowLang['friendly_url'] ?>"><img src="<?= $row['product_img'] ?>" alt="<?= $rowLang['lang_product_name'] ?>" class="img-responsive"></a>
                        </div>
                        <div class="gb-product_ruouvang-item-text" id="text-run-<?= $row['product_id'] ?>">
                            <a href="/<?= $rowLang['friendly_url'] ?>" class="brand_mia"><?= $action->getBrand($row['product_brand'])['name']; ?></a>
                            <!--PERCENT-->
                            <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0006.php";?>

                            <h2><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_product_name'] ?></a></h2>
                            <!--PRICE-->
                            <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0002.php";?>

                            <!--GIFT-->
                            <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0015.php";?>
                        </div>
                        <div class="gb-product_ruouvang-item-yeumua" id="mua-run-<?= $row['product_id'] ?>">
                            <!--MUA HÀNG-->
                            <?php include DIR_CART."MS_CART_MIA_0001.php";?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-tieubieu-product_ruouvang-slide').owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
            nav:true,
            dots: false,
            autoplay: true,
            rewind: true,
            navText:[],
            responsive:{
                0:{
                    items:2,
                    nav: false
                },
                600:{
                    items: 3,
                    nav:true
                },
                992:{
                    items: 5,
                    nav:true
                }
            }
        });
    });
</script>

<script>
    function sub_img_run (id, idp) {
        // alert(id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var out = this.responseText;
             var json = JSON.parse(out);
             // alert(json.image);
             document.getElementById("img-run-"+idp).innerHTML = json.image;
             document.getElementById("text-run-"+idp).innerHTML = json.text;
             document.getElementById("mua-run-"+idp).innerHTML = json.mua;
             // document.getElementById("tuan-55").innerHTML = 'tuan';
            }
          };
          xhttp.open("GET", "/functions/ajax/sub_img.php?id="+id, true);
          xhttp.send();
    }
</script>