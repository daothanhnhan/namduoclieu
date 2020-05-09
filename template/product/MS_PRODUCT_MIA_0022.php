<?php 
    $action_product = new action_product(); 
    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';

    $rowLang = $action_product->getProductLangDetail_byUrl($slug,$lang);
    $row = $action_product->getProductDetail_byId($rowLang[$nameColIdProduct_productLanguage],$lang);
    $_SESSION['productcat_id_relate'] = $row[$nameColIdProductCat_product];
    $_SESSION['sidebar'] = 'productDetail';
    $arr_id = $row['productcat_ar'];
    $arr_id = explode(',', $arr_id);
    $productcat_id = (int)$arr_id[0];
    $product_breadcrumb = $action_product->getProductCatLangDetail_byId($productcat_id, $lang);
    $breadcrumb_url = $product_breadcrumb['friendly_url'];
    $breadcrumb_name = $product_breadcrumb['lang_productcat_name'];
    $use_breadcrumb = true;

    $img_sub = json_decode($row['product_sub_img']);
    $product_brand = $row['product_brand'];
    $product_extra = $row['product_extra'];
    $product_size = $row['product_size'];
    /////////////
    function getBrand ($id) {
        global $conn_vn;
        $sql = "SELECT * FROM brand WHERE id = $id";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    /////////////////
    function listGroup ($id) {
        global $conn_vn;
        if ($id != 0) {
            $sql = "SELECT * FROM product WHERE product_group_id = $id";
            $result = mysqli_query($conn_vn, $sql);
            $rows = array();
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }
            }
            return $rows;
        } else {
            return [];
        }
    }
    $list_group = listGroup($row['product_group_id']);
    ///////////// da xem ///////////////
    if (!isset($_SESSION['watched'])) {
        $_SESSION['watched'] = array();
    } else {
        if (!in_array($row['product_id'], $_SESSION['watched'])) {
            $_SESSION['watched'][] = $row['product_id'];
        }
    }
    $watched_count = count($_SESSION['watched']);
    if ($watched_count > 8) {
        array_pop($_SESSION['watched']);
    }
?>
<script type="text/javascript">
   $(document).ready(function(data){  
      $('.btn_addCart').click(function(){  
         // var product_id = $(this).attr("id");
           var product_id = $('#product_id').val();
           var product_name = $('#product_name').val();  
           var product_price = $('#product_price').val();  
           var product_img = $('#product_img').val();
           var product_link = $('#product_link').val();
           var product_quantity = 1;  
           var action = "add";
           // var size = $('#size').val();
           // alert(product_link);return false;
           // var a = {a : 'a'};
           if(product_quantity > 0)  
           {                  
                 $.ajax({  
                     url:"/functions/ajax.php?action=add_cart",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          product_id:product_id,   
                          product_name:product_name,   
                          product_price:product_price,   
                          product_quantity:product_quantity,   
                          product_img:product_img,
                          product_link:product_link,
                          action:action  
                     },  
                     success:function(data)  
                     {  
                          // $('#order_table').html(data.order_table);  
                          // $('.badge').text(data.cart_item);  
                          if (confirm('Thêm sản phẩm thành công, bạn có muốn thanh toán luôn không')) {
                              window.location = '/gio-hang';
                          }else{
                              location.reload();
                              // window.location = '/gio-hang';
                          }  
                     },
                     error: function () {
                        alert('loi');
                     }  
                });  

           }  
           else  
           {  
                alert("Please Enter Number of Quantity")  
           }  
      });
   });
 </script>
<link rel="stylesheet" href="/plugin/slickNav/slicknav.css"/>
<link rel="stylesheet" href="/plugin/slick/slick.css"/>
<link rel="stylesheet" href="/plugin/slick/slick-theme.css"/>
<?php include DIR_BREADCRUMBS."MS_BREADCRUMS_MIA_0003.php";?>
<div class="gb-chitiet_sanpham_ruouvang">
    <div class="gb-chitiet_sanpham_ruouvang-body">
        <div class="container">
            <div class="gb-chitiet_sanpham_ruouvang-left">
                <!--chi titest sản phẩm-->
                <div class="row">
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="gb-chitiet_sanpham_ruouvang_left-img">
                                    <div class="uni-single-car-gallery-images">
                                        <div class="slider slider-for">
                                            <?php if ($row['product_video'] != '') { ?>
                                            <div class="slide-item">
                                                <?= $row['product_video']; ?>
                                            </div>
                                            <?php } ?>
                                            <div class="slide-item"><img src="/images/<?= $row['product_img'] ?>" alt="" class="img-responsive img1" data-zoom-image="/images/<?= $row['product_img'] ?>"></div>
                                            <?php 
                                              $d = 1;
                                              foreach ($img_sub as $item) {
                                                  $d++;
                                                  $image = json_decode($item, true);?>
                                            <div class="slide-item"><img src="/images/<?= $image['image'] ?>" alt="" class="img-responsive img<?= $d ?>" data-zoom-image="/images/<?= $image['image'] ?>"></div>
                                            <?php } ?>
                                        </div>
                                        <div class="slider slider-nav">
                                            <?php if ($row['product_video'] != '') { ?>
                                            <div class="slide-item-nav"><img src="/images/icons/iconsplay.png" alt="" class="img-responsive img-play"></div>
                                            <?php } ?>
                                            <div class="slide-item-nav"><img src="/images/<?= $row['product_img'] ?>" alt="1" class="img-responsive" data-zoom-image="/images/<?= $row['product_img'] ?>"></div>
                                            <?php
                                            $d = 1; 
                                            foreach ($img_sub as $item) {
                                                $d++;
                                                $image = json_decode($item, true);?>
                                            <div class="slide-item-nav"><img src="/images/<?= $image['image'] ?>" alt="<?= $d ?>" class="img-responsive" data-zoom-image="/images/<?= $image['image'] ?>"></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="gb-chitiet_sanpham_ruouvang_left-info">
                                    <h1 class="product_title entry-title"><?= $rowLang['lang_product_name'] ?></h1>
                                    <!--Thương hiệu-->
                                    <div class="brand-chitiet">
                                        Thương hiệu: <span><?= getBrand($row['product_brand'])['name'] ?></span>
                                    </div>
                                    <div class="gb-divider"></div>
                                    <!--ENTRY PRICE-->
                                    <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0010.php";?>


                                    <!--ẢNH SẢN PHẨM LIÊN QUAN-->
                                    <div class="gb-imagelienquan-miavn">
                                        <ul>
                                            <?php foreach ($list_group as $item) { ?>
                                            <li><a href="/<?= $item['friendly_url'] ?>"><img src="/images/<?= $item['product_img'] ?>" alt="" class="img-responsive"></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <!--ĐẶT HÀNG-->
                                    <?php include DIR_CART."MS_CART_MIA_0002.php";?>

                                    <!--Hotline-->
                                    <div class="gb-hotline-chitiet">
                                        Hotline: (024) 39 126 126 - 098 575 2026 <br>
                                        (8h30 - 21h30)
                                    </div>

                                    <!--ĐÁNH GIÁ-->
                                    <div class="gb-danhgia-chititet">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <ul class="danhgia-star">
                                                    <li>ĐÁNH GIÁ</li>
                                                    <li>
                                                        <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                                        <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                                        <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                                        <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                                        <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="row">
                                                    <div class="col-xs-8">

                                                        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=112&layout=button&action=like&size=small&show_faces=true&share=true&height=65&appId=220693348668109" width="112" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                                                    </div>
                                                    <div class="col-xs-4">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <?php if ($row['product_gift_name'] != '') { ?>
                        <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0011.php";?>

                        <img src="/images/banner-left.jpg" alt="" class="img-responsive">
                        <?php } ?>
                    </div>
                </div>

                <!--THÔNG SỐ VÀ MÔ TẢ-->
                <div class="row" style="margin-top: 30px">
                    <div class="col-sm-8">
                        <div class="gb-thongso-mota">
                            <div class="uni-shortcode-tabs-default">
                                <div class="uni-shortcode-tab-3">
                                    <div class="tabbable-panel">
                                        <div class="tabbable-line">
                                            <ul class="nav nav-tabs ">
                                                <li  class="active">
                                                    <a href="#tab_default_32" data-toggle="tab">
                                                        Chi tiết sản phẩm</a>
                                                </li>
                                                <li>
                                                    <a href="#tab_default_33" data-toggle="tab">
                                                        Phí Vận chuyển</a>
                                                </li>
                                                <li>
                                                    <a href="#tab_default_34" data-toggle="tab">
                                                        Hướng dẫn kích thước</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_default_32">
                                                    <?= $rowLang['lang_product_content'] ?>
                                                </div>
                                                <div class="tab-pane" id="tab_default_33">
                                                    <?= $rowLang['lang_product_sub_info1'] ?>
                                                </div>
                                                <div class="tab-pane" id="tab_default_34">
                                                    <?= $rowLang['lang_product_sub_info2'] ?>
                                                    <!--                                            <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="100%" data-numposts="1"></div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <?php include DIR_SIDEBAR."MS_SIDEBAR_MIA_0005.php";?>
                        <?php include DIR_SIDEBAR."MS_SIDEBAR_MIA_0003.php";?>
                    </div>
                </div>


                <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0005.php";?>
                <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0012.php";?>
                <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0013.php";?>
                <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0014.php";?>

            </div>
        </div>
    </div>
</div>

<script src="/plugin/slick/scripts.js"></script>
<script src="/plugin/slick/slick.js"></script>
<script src="/plugin/slickNav/jquery.slicknav.js"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 500,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            speed: 500,
            asNavFor: '.slider-for',
            dots: false,
            focusOnSelect: true,
            slide: 'div'
        });
    });
</script>