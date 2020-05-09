<?php 
    $home_procatid = array(141, 140, 139, 124);
    $home_procat = $action->getList('productcat', 'productcat_parent', '0', 'productcat_sort_order', 'asc', '', '', '');
    $home_procatid = array();
    foreach ($home_procat as $item_procat) {
        $home_procatid[] = $item_procat['productcat_id'];
    }
    // var_dump($home_procatid);
?>
<?php 
    foreach ($home_procatid as $item) { 
        $procat_name = $action_product->getProductCatDetail_byId($item, $lang);
        $home_list_pro = $action_product->getProductList_byMultiLevel_orderProductId_hot($item,'desc',1,5,'')['data'];//var_dump($home_list_pro);
?>
<div class="gb-tieubieu-product_ruouvang">
    <div class="container">
        <div class="gb-tieubieu-product_ruouvang-title">
            <b></b>
            <h3><?= $procat_name['productcat_name'] ?> NỔI BẬT</h3>
            <b></b>
        </div>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="row" style="margin:  0">
                <?php
                foreach ($home_list_pro as $item_pro) { 
                    $row = $item_pro;
                    $rowLang = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                    $list_group = $action->listGroup($row['product_group_id']);
                ?>
                <div class="col-md-3 col-sm-3 col-xs-6 clear-padding">
                    <div class="gb-product_ruouvang-item">
                        <div class="gb-product-loop-miavn">
                            <div class="gb-product-loop-miavn-slide owl-carousel owl-theme">
                                <?php foreach ($list_group as $itemp) {  ?>
                                <div class="item">
                                    <img src="<?= $itemp['product_img'] ?>" alt="" class="img-responsive" onclick="sub_img_home(<?= $itemp['product_id'] ?>, <?= $row['product_id'] ?>, <?= $item ?>)">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="gb-product_ruouvang-item-img" id="img-<?= $item ?>-<?= $row['product_id'] ?>">
                            <a href="/<?= $rowLang['friendly_url'] ?>"><img src="<?= $row['product_img'] ?>" alt="<?= $rowLang['lang_product_name'] ?>" class="img-responsive"></a>
                        </div>
                        <div class="gb-product_ruouvang-item-text" id="text-<?= $item ?>-<?= $row['product_id'] ?>">
                            <a href="/<?= $rowLang['friendly_url'] ?>" class="brand_mia"><?= $action->getBrand($row['product_brand'])['name']; ?></a>
                            <!--PERCENT-->
                            <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0006.php";?>

                            <h2><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_product_name'] ?></a></h2>
                            <!--PRICE-->
                            <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0002.php";?>

                            <!--GIFT-->
                            <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0015.php";?>
                        </div>
                        <div class="gb-product_ruouvang-item-yeumua" id="mua-<?= $item ?>-<?= $row['product_id'] ?>">
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
<?php } ?>
<script>
    $(document).ready(function (){
        var owl = $('.gb-product-loop-miavn-slide');
        owl.owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
            nav:true,
            dots:false,
            autoplay: false,
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
                    items:4,
                }
            }
        });
    });
</script>
<script>
    function sub_img_home (id, idp, idc) {
        // alert(id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var out = this.responseText;
             var json = JSON.parse(out);
             // alert(json.mua);
             document.getElementById("img-"+idc+"-"+idp).innerHTML = json.image;
             document.getElementById("text-"+idc+"-"+idp).innerHTML = json.text;
             document.getElementById("mua-"+idc+"-"+idp).innerHTML = json.mua;
            }
          };
          xhttp.open("GET", "/functions/ajax/sub_img.php?id="+id, true);
          xhttp.send();
    }
</script>