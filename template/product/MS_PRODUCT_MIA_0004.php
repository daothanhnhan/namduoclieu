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
    
    $list_group = $action->listGroup($row['product_group_id']);
    $list_group_tu = $action->listGroup($row['product_group_id']);
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
    ///////////////////
    $product_brand_name = getBrand($product_brand)['name'];
    $list_id_brand = $action->listBrandId($product_brand_name);//var_dump($list_id_brand);
    $str_id_brand = '';
    foreach ($list_id_brand as $item) {
        if ($str_id_brand == '') {
            $str_id_brand = $item;
        } else {
            $str_id_brand .= '-'.$item;
        }
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
                          
                          // if (confirm('Thêm sản phẩm thành công, bạn có muốn thanh toán luôn không')) {
                              window.location = '/gio-hang';
                          // }else{
                          //     location.reload();
                          //     // window.location = '/gio-hang';
                          // }  
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
                                <?php 
                                $d = 0;
                                if (!empty($list_group)) { 
                                foreach ($list_group as $item_p) { 
                                    $d++;
                                    $img_sub = json_decode($item_p['product_sub_img']);
                                ?>
                                <div class="gb-chitiet_sanpham_ruouvang_left-img tab-pane <?= ($item_p['product_id']==$row['product_id']) ? 'active' : '' ?>" id="tab<?= $item_p['product_id'] ?>">
                                    <div class="uni-single-car-gallery-images">
                                        <div class="slider-boders slider slider-for<?= $item_p['product_id'] ?>">
                                            <?php if ($item_p['product_video'] != '') { ?>
                                            <div class="slide-item">
                                                <?= $item_p['product_video']; ?>
                                            </div>
                                            <?php } ?>
                                            <div class="slide-item"><img src="<?= $item_p['product_img'] ?>" alt="" class="img-responsive img1" data-zoom-image="<?= $item_p['product_img'] ?>"></div>
                                            <?php 
                                              $d = 1;
                                              foreach ($img_sub as $item) {
                                                  $d++;
                                                  $image = json_decode($item, true);?>
                                            <div class="slide-item"><img src="<?= $image['image'] ?>" alt="" class="img-responsive img<?= $d ?>" data-zoom-image="<?= $image['image'] ?>"></div>
                                            <?php } ?>
                                        </div>
                                        <div class="slider slider-nav<?= $item_p['product_id'] ?>">
                                            <?php if ($item_p['product_video'] != '') { ?>
                                            <div class="slide-item-nav">
                                              <img src="/images/icons/iconsplay.png" alt="" class="img-responsive img-play">
                                            </div>
                                            <?php } ?>
                                            <div class="slide-item-nav"><img src="<?= $item_p['product_img'] ?>" alt="1" class="img-responsive" data-zoom-image="<?= $item_p['product_img'] ?>"></div>
                                            <?php
                                            $d = 1; 
                                            foreach ($img_sub as $item) {
                                                $d++;
                                                $image = json_decode($item, true);?>
                                            <div class="slide-item-nav"><img src="<?= $image['image'] ?>" alt="<?= $d ?>" class="img-responsive" data-zoom-image="<?= $image['image'] ?>"></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="gb-chitiet_sanpham_ruouvang_left-img">
                                    <div class="uni-single-car-gallery-images">
                                        <div class="slider-boders slider slider-for">
                                            <?php if ($row['product_video'] != '') { ?>
                                            <div class="slide-item">
                                                <?= $row['product_video']; ?>
                                            </div>
                                            <?php } ?>
                                            <div class="slide-item"><img src="<?= $row['product_img'] ?>" alt="" class="img-responsive img1" data-zoom-image="<?= $row['product_img'] ?>"></div>
                                            <?php 
                                              $d = 1;
                                              foreach ($img_sub as $item) {
                                                  $d++;
                                                  $image = json_decode($item, true);?>
                                            <div class="slide-item"><img src="<?= $image['image'] ?>" alt="" class="img-responsive img<?= $d ?>" data-zoom-image="<?= $image['image'] ?>"></div>
                                            <?php } ?>
                                        </div>
                                        <div class="slider slider-nav">
                                            <?php if ($row['product_video'] != '') { ?>
                                            <div class="slide-item-nav"><img src="/images/icons/iconsplay.png" alt="" class="img-responsive img-play"></div>
                                            <?php } ?>
                                            <div class="slide-item-nav"><img src="<?= $row['product_img'] ?>" alt="1" class="img-responsive" data-zoom-image="<?= $row['product_img'] ?>"></div>
                                            <?php
                                            $d = 1; 
                                            foreach ($img_sub as $item) {
                                                $d++;
                                                $image = json_decode($item, true);?>
                                            <div class="slide-item-nav"><img src="<?= $image['image'] ?>" alt="<?= $d ?>" class="img-responsive" data-zoom-image="<?= $image['image'] ?>"></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                            <div class="col-md-5">
                                <div class="gb-chitiet_sanpham_ruouvang_left-info">
                                    <h1 class="product_title entry-title"><?= $rowLang['lang_product_name'] ?></h1>
                                    <!--Thương hiệu-->
                                    <div class="brand-chitiet">
                                        Thương hiệu: <a href="/brand/1/<?= $str_id_brand ?>"><span><?= getBrand($row['product_brand'])['name'] ?></span></a>
                                    </div>
                                    <div class="gb-divider"></div>
                                    <!--ENTRY PRICE-->
                                    <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0010.php";?>


                                    <!--ẢNH SẢN PHẨM LIÊN QUAN-->
                                    <div class="gb-imagelienquan-miavn">
                                        <ul>
                                            <?php 
                                            $d = 0;
                                            krsort($list_group);
                                            foreach ($list_group as $item) { 
                                              $d++;
                                              if ($d>6) { break; }
                                              ?>
                                            <li class="<?= $d==1 ? 'active' : '' ?>"><a href="#tab<?= $item['product_id'] ?>" data-toggle="tab" onclick="pro(<?= $item['product_id'] ?>)"><img src="<?= $item['product_img'] ?>" alt="" class="img-responsive"></a></li>
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

                                                        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=112&layout=button&action=like&size=small&show_faces=true&share=true&height=65&appId=220693348668109" width="130" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
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


                <?php //include DIR_PRODUCT."MS_PRODUCT_MIA_0005.php";?>
                <?php //include DIR_PRODUCT."MS_PRODUCT_MIA_0012.php";?>
                <?php //include DIR_PRODUCT."MS_PRODUCT_MIA_0013.php";?>
                <?php include DIR_PRODUCT."MS_PRODUCT_MIA_0014.php";?>

            </div>
        </div>
    </div>
</div>

<script src="/plugin/slick/scripts.js"></script>
<script src="/plugin/slick/slick.js"></script>
<script src="/plugin/slickNav/jquery.slicknav.js"></script>
<script src="/plugin/vidu/jQueryZoomImageonMouseOver/js/jquery.elevatezoom.min.js" type="text/javascript"></script>
<script>
  $(document).ready(function() {
        $(".img1").elevateZoom({ gallery: 'gallery_01', cursor: 'pointer', galleryActiveClass: "active" });
        $("img").click(function(){
          var bien = $(this).attr("alt");
          $(".img"+bien).elevateZoom({ gallery: 'gallery_01', cursor: 'pointer', galleryActiveClass: "active" });
        });


        $(".img1").bind("click", function(e) {
            var ez = $('.img1').data('elevateZoom');
            ez.closeAll();
            $.fancybox(ez.getGalleryList());
            return true;
        });
        $('.img-play').click(function(){
          $('.zoomContainer').css('display', 'none');
        });
    });

</script>
<!-- tuan -->
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
            slidesToShow: 7,
            slidesToScroll: 1,
            speed: 500,
            asNavFor: '.slider-for',
            dots: false,
            focusOnSelect: true,
            slide: 'div'
        });
    });
    <?php foreach ($list_group_tu as $item) { ?>
    $(document).ready(function() {
        $('.slider-for<?= $item['product_id'] ?>').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 500,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav<?= $item['product_id'] ?>'
        });
        $('.slider-nav<?= $item['product_id'] ?>').slick({
            slidesToShow: 7,
            slidesToScroll: 1,
            speed: 500,
            asNavFor: '.slider-for<?= $item['product_id'] ?>',
            dots: false,
            focusOnSelect: true,
            slide: 'div'
        });
    });
    <?php } ?>
</script>
<script>
    function pro (id) {
        // alert(id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var out = this.responseText;
             // alert(out);
             var json = JSON.parse(out);
             // alert(json.product_name);
             document.getElementsByClassName("product_title")[0].innerHTML = json.product_name;
             document.getElementsByClassName("gb-price-chitiet")[0].innerHTML = json.price_all;
             document.getElementById("product_id").value = json.product_id;
             document.getElementById("product_name").value = json.product_name;
             document.getElementById("product_link").value = json.product_link;
             document.getElementById("product_img").value = json.product_img;
             document.getElementById("product_price").value = json.product_price;
            }
          };
          xhttp.open("GET", "/functions/ajax/product.php?id="+id, true);
          xhttp.send();
    }
</script>
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