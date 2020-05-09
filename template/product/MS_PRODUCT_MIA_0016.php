<?php                                                                        
    
    if (!isset($_SESSION['brand'])) {
        $_SESSION['brand'] = array();
    }

    if (!isset($_SESSION['size'])) {
        $_SESSION['size'] = array();
    }

    if (!isset($_SESSION['material'])) {
        $_SESSION['material'] = array();
    }

    if (!isset($_SESSION['laptop'])) {
        $_SESSION['laptop'] = array();
    }

    if (!isset($_SESSION['special'])) {
        $_SESSION['special'] = array();
    }

    if (!isset($_SESSION['price'])) {
        $_SESSION['price'] = array();
    }

    if (!isset($_SESSION['color'])) {
        $_SESSION['color'] = array();
    }

    //////////////
    if (!isset($_SESSION['link'])) {
        $_SESSION['link'] = $_GET['page'];
    } else {
        if ($_SESSION['link'] != $_GET['page']) {
            $_SESSION['brand'] = array();
            $_SESSION['size'] = array();
            $_SESSION['material'] = array();
            $_SESSION['laptop'] = array();
            $_SESSION['special'] = array();
            $_SESSION['price'] = array();
            $_SESSION['color'] = array();
            $_SESSION['link'] = $_GET['page'];
        }
    }
    ///////////////
    if (isset($_GET['size'])) {
        if (!in_array($_GET['size'], $_SESSION['size'])) {
            $_SESSION['size'][] = $_GET['size'];
        }
    }

    if (isset($_GET['brand'])) {
        if (!in_array($_GET['brand'], $_SESSION['brand'])) {
            $_SESSION['brand'][] = $_GET['brand'];
        }
    }

    if (isset($_GET['laptop'])) {
        if (!in_array($_GET['laptop'], $_SESSION['laptop'])) {
            $_SESSION['laptop'][] = $_GET['laptop'];
        }
    }
////////////////////
    if (isset($_GET['slug']) && $_GET['slug'] != '') {
        $slug = $_GET['slug'];

        $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);
        $rowCat = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'],$lang);
        $rows = $action_product->getProductList_byMultiLevel_orderProductId_Sale($rowCat['productcat_id'],'desc',$trang,40,$slug);//var_dump($rows);
    }else{
        $rows = $action->getList('product','','','product_id','desc',$trang,40,'san-pham');
    }
    $_SESSION['sidebar'] = 'productCat';
 ////////////////////   

    function getBrand ($id) {
        global $conn_vn;
        $sql = "SELECT * FROM brand WHERE id = $id";//echo $sql;
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
?>
<?php include DIR_BREADCRUMBS."MS_BREADCRUMS_MIA_0001.php";?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<div class="gb-page-sanpham_ruouvang">
    <div class="container">
        <div class="row-fix">
            <div class="col-md-3" style="display: none;">
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MIA_0004.php";?>
            </div>
            <div class="col-md-12">
                <div class="gb-page-sanpham-description-danhmuc-title">
                    <h1>SALE</h1>
                </div>
                <div class="gb-page-sanpham-description-danhmuc">
                    <p>
                        
                    </p>
                </div>
                <div class="row" style="margin: 0">
                    <?php 
                    $d = 0;
                    foreach ($rows['data'] as $item) {
                        $d++;
                        $row = $item;
                        $rowLang = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                        $list_group = $action->listGroup($row['product_group_id']);
                    ?>
                    <div class="col-md-3 col-sm-3 col-xs-6 clear-padding" style="padding: 0">
                        <div class="gb-product_ruouvang-item">
                            <div class="gb-product-loop-miavn">
                                <div class="gb-product-loop-miavn-slide owl-carousel owl-theme">
                                    <?php foreach ($list_group as $itemp) {  ?>
                                    <div class="item">
                                        <img src="<?= $itemp['product_img'] ?>" alt="" class="img-responsive" onclick="sub_img(<?= $itemp['product_id'] ?>, <?= $row['product_id'] ?>)">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="gb-product_ruouvang-item-img" id="img-<?= $row['product_id'] ?>">
                                <a href="/<?= $rowLang['friendly_url'] ?>"><img src="<?= $row['product_img'] ?>" alt="<?= $rowLang['lang_product_name'] ?>" class="img-responsive"></a>
                            </div>
                            <div class="gb-product_ruouvang-item-text" id="text-<?= $row['product_id'] ?>">
                                <a href="/<?= $rowLang['friendly_url'] ?>" class="brand_mia"><?= getBrand($row['product_brand'])['name'] ?></a>
                                <!--PERCENT-->
                                <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0006.php";?>

                                <h2><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_product_name'] ?></a></h2>
                                <!--PRICE-->
                                <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0002.php";?>

                                <!--GIFT-->
                                <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0015.php";?>
                            </div>
                            <div class="gb-product_ruouvang-item-yeumua" id="mua-<?= $row['product_id'] ?>">
                                <!--MUA HÀNG-->
                                <?php include DIR_CART."MS_CART_MIA_0001.php";?>
                            </div>
                        </div>
                    </div>
                    <?php
                        if ($d%5==0) {
                            echo '<hr style="width:100%;border:0;margin:0;" />';
                        }
                    }
                    ?>
                </div>
                <div style="text-align: center;"><?= $rows['paging'] ?></div>
            </div>
        </div>
    </div>
</div>
<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
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