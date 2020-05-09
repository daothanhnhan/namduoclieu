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
                            <div class="col-md-7 panel-body">
                                <div class="gb-chitiet_sanpham_ruouvang_left-img tab-pane active" id="tab1" style="display: block;">
                                    <div class="uni-single-car-gallery-images">
                                        <div class="slider slider-for1">
                                            <div class="slide-item">
                                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/-EFsQUM_T7w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>

                                            <div class="slide-item"><img src="/images/product4.jpg" alt="" class="img-responsive img4"></div>
                                            <div class="slide-item"><img src="/images/product6.jpg" alt="" class="img-responsive img5"></div>
                                            <div class="slide-item"><img src="/images/product7.jpg" alt=""  class="img-responsive img6"></div>
                                            <div class="slide-item"><img src="/images/product1.jpg" alt="" class="img-responsive img1"></div>
                                            <div class="slide-item"><img src="/images/product2.jpg" alt="" class="img-responsive img2"></div>
                                            <div class="slide-item"><img src="/images/product3.jpg" alt="" class="img-responsive img3"></div>

                                        </div>
                                        <div class="slider slider-nav1">
                                            <div class="slide-item-nav"><img src="/images/icons/iconsplay.png" alt="" class="img-responsive img-play"></div>

                                            <div class="slide-item-nav"><img src="/images/product4.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product5.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product7.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product1.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product2.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product3.jpg" alt="" class="img-responsive"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gb-chitiet_sanpham_ruouvang_left-img tab-pane" id="tab2" style="display: none;">
                                    <div class="uni-single-car-gallery-images">
                                        <div class="slider slider-for2">
                                            <div class="slide-item">
                                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/-EFsQUM_T7w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>

                                            <div class="slide-item"><img src="/images/product1.jpg" alt="" class="img-responsive img1"></div>
                                            <div class="slide-item"><img src="/images/product2.jpg" alt="" class="img-responsive img2"></div>
                                            <div class="slide-item"><img src="/images/product3.jpg" alt="" class="img-responsive img3"></div>
                                            <div class="slide-item"><img src="/images/product4.jpg" alt="" class="img-responsive img4"></div>
                                            <div class="slide-item"><img src="/images/product6.jpg" alt="" class="img-responsive img5"></div>
                                            <div class="slide-item"><img src="/images/product7.jpg" alt=""  class="img-responsive img6"></div>
                                        </div>
                                        <div class="slider slider-nav2">
                                            <div class="slide-item-nav"><img src="/images/icons/iconsplay.png" alt="" class="img-responsive img-play"></div>

                                            <div class="slide-item-nav"><img src="/images/product1.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product2.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product3.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product4.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product5.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product7.jpg" alt="" class="img-responsive"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gb-chitiet_sanpham_ruouvang_left-img tab-pane" id="tab3" style="display: none;">
                                    <div class="uni-single-car-gallery-images">
                                        <div class="slider slider-for3">
                                            <div class="slide-item">
                                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/-EFsQUM_T7w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>

                                            <div class="slide-item"><img src="/images/product1.jpg" alt="" class="img-responsive img1"></div>
                                            <div class="slide-item"><img src="/images/product2.jpg" alt="" class="img-responsive img2"></div>
                                            <div class="slide-item"><img src="/images/product3.jpg" alt="" class="img-responsive img3"></div>
                                            <div class="slide-item"><img src="/images/product4.jpg" alt="" class="img-responsive img4"></div>
                                            <div class="slide-item"><img src="/images/product6.jpg" alt="" class="img-responsive img5"></div>
                                            <div class="slide-item"><img src="/images/product7.jpg" alt=""  class="img-responsive img6"></div>
                                        </div>
                                        <div class="slider slider-nav3">
                                            <div class="slide-item-nav"><img src="/images/icons/iconsplay.png" alt="" class="img-responsive img-play"></div>

                                            <div class="slide-item-nav"><img src="/images/product1.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product2.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product3.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product4.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product5.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product7.jpg" alt="" class="img-responsive"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gb-chitiet_sanpham_ruouvang_left-img tab-pane" id="tab4" style="display: none;">
                                    <div class="uni-single-car-gallery-images">
                                        <div class="slider slider-for4">
                                            <div class="slide-item">
                                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/-EFsQUM_T7w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>

                                            <div class="slide-item"><img src="/images/product1.jpg" alt="" class="img-responsive img1"></div>
                                            <div class="slide-item"><img src="/images/product2.jpg" alt="" class="img-responsive img2"></div>
                                            <div class="slide-item"><img src="/images/product3.jpg" alt="" class="img-responsive img3"></div>
                                            <div class="slide-item"><img src="/images/product4.jpg" alt="" class="img-responsive img4"></div>
                                            <div class="slide-item"><img src="/images/product6.jpg" alt="" class="img-responsive img5"></div>
                                            <div class="slide-item"><img src="/images/product7.jpg" alt=""  class="img-responsive img6"></div>
                                        </div>
                                        <div class="slider slider-nav4">
                                            <div class="slide-item-nav"><img src="/images/icons/iconsplay.png" alt="" class="img-responsive img-play"></div>

                                            <div class="slide-item-nav"><img src="/images/product1.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product2.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product3.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product4.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product5.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product7.jpg" alt="" class="img-responsive"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gb-chitiet_sanpham_ruouvang_left-img tab-pane" id="tab5" style="display: none;">
                                    <div class="uni-single-car-gallery-images">
                                        <div class="slider slider-for5">
                                            <div class="slide-item">
                                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/-EFsQUM_T7w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>

                                            <div class="slide-item"><img src="/images/product1.jpg" alt="" class="img-responsive img1"></div>
                                            <div class="slide-item"><img src="/images/product2.jpg" alt="" class="img-responsive img2"></div>
                                            <div class="slide-item"><img src="/images/product3.jpg" alt="" class="img-responsive img3"></div>
                                            <div class="slide-item"><img src="/images/product4.jpg" alt="" class="img-responsive img4"></div>
                                            <div class="slide-item"><img src="/images/product6.jpg" alt="" class="img-responsive img5"></div>
                                            <div class="slide-item"><img src="/images/product7.jpg" alt=""  class="img-responsive img6"></div>
                                        </div>
                                        <div class="slider slider-nav5">
                                            <div class="slide-item-nav"><img src="/images/icons/iconsplay.png" alt="" class="img-responsive img-play"></div>

                                            <div class="slide-item-nav"><img src="/images/product1.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product2.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product3.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product4.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product5.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product7.jpg" alt="" class="img-responsive"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gb-chitiet_sanpham_ruouvang_left-img tab-pane" id="tab6" style="display: none;">
                                    <div class="uni-single-car-gallery-images">
                                        <div class="slider slider-for6">
                                            <div class="slide-item">
                                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/-EFsQUM_T7w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>

                                            <div class="slide-item"><img src="/images/product1.jpg" alt="" class="img-responsive img1"></div>
                                            <div class="slide-item"><img src="/images/product2.jpg" alt="" class="img-responsive img2"></div>
                                            <div class="slide-item"><img src="/images/product3.jpg" alt="" class="img-responsive img3"></div>
                                            <div class="slide-item"><img src="/images/product4.jpg" alt="" class="img-responsive img4"></div>
                                            <div class="slide-item"><img src="/images/product6.jpg" alt="" class="img-responsive img5"></div>
                                            <div class="slide-item"><img src="/images/product7.jpg" alt=""  class="img-responsive img6"></div>
                                        </div>
                                        <div class="slider slider-nav6">
                                            <div class="slide-item-nav"><img src="/images/icons/iconsplay.png" alt="" class="img-responsive img-play"></div>

                                            <div class="slide-item-nav"><img src="/images/product1.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product2.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product3.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product4.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product5.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product7.jpg" alt="" class="img-responsive"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gb-chitiet_sanpham_ruouvang_left-img tab-pane" id="tab7" style="display: none;">
                                    <div class="uni-single-car-gallery-images">
                                        <div class="slider slider-for7">
                                            <div class="slide-item">
                                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/-EFsQUM_T7w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>

                                            <div class="slide-item"><img src="/images/product1.jpg" alt="" class="img-responsive img1"></div>
                                            <div class="slide-item"><img src="/images/product2.jpg" alt="" class="img-responsive img2"></div>
                                            <div class="slide-item"><img src="/images/product3.jpg" alt="" class="img-responsive img3"></div>
                                            <div class="slide-item"><img src="/images/product4.jpg" alt="" class="img-responsive img4"></div>
                                            <div class="slide-item"><img src="/images/product6.jpg" alt="" class="img-responsive img5"></div>
                                            <div class="slide-item"><img src="/images/product7.jpg" alt=""  class="img-responsive img6"></div>
                                        </div>
                                        <div class="slider slider-nav7">
                                            <div class="slide-item-nav"><img src="/images/icons/iconsplay.png" alt="" class="img-responsive img-play"></div>

                                            <div class="slide-item-nav"><img src="/images/product1.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product2.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product3.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product4.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product5.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product7.jpg" alt="" class="img-responsive"></div>
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
                                        <ul  class="panel-tabs">
                                            <li class="active"><a href="#tab1" data-toggle="tab" onclick="img1()"><img src="/images/product1.jpg" alt="" class="img-responsive"></a></li>
                                            <li><a href="#tab2" data-toggle="tab" onclick="img2()"><img src="/images/product2.jpg" alt="" class="img-responsive"></a></li>
                                            <li><a href="#tab3" data-toggle="tab" onclick="img3()"><img src="/images/product3.jpg" alt="" class="img-responsive"></a></li>
                                            <li><a href="#tab4" data-toggle="tab"><img src="/images/product4.jpg" alt="" class="img-responsive"></a></li>
                                            <li><a href="#tab5" data-toggle="tab"><img src="/images/product5.jpg" alt="" class="img-responsive"></a></li>
                                            <li><a href="#tab6" data-toggle="tab"><img src="/images/product6.jpg" alt="" class="img-responsive"></a></li>
                                            <li><a href="#tab7" data-toggle="tab"><img src="/images/product7.jpg" alt="" class="img-responsive"></a></li>
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
                                                    <p>Comes Beautifully Gift Boxed as shown. Delivered from the UK.</p>
                                                </div>
                                                <div class="tab-pane" id="tab_default_34">
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
        $('.slider-for1').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 500,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav1'
        });
        $('.slider-nav1').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            speed: 500,
            asNavFor: '.slider-for1',
            dots: false,
            focusOnSelect: true,
            slide: 'div'
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.slider-for2').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 500,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav2'
        });
        $('.slider-nav2').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            speed: 500,
            asNavFor: '.slider-for2',
            dots: false,
            focusOnSelect: true,
            slide: 'div'
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.slider-for3').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 500,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav3'
        });
        $('.slider-nav3').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            speed: 500,
            asNavFor: '.slider-for3',
            dots: false,
            focusOnSelect: true,
            slide: 'div'
        });
    });
</script>
<script>
    function proimg (id) {
        // alert(id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var out = this.responseText;
             // alert(out);
             document.getElementById("img-main-mia").innerHTML = out;
            }
          };
          xhttp.open("GET", "/functions/ajax/pro_img_main.php?id="+id, true);
          xhttp.send();

          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var out = this.responseText;
             // alert(out);
             document.getElementById("img-sub-mia").innerHTML = out;
            }
          };
          xhttp.open("GET", "/functions/ajax/pro_img_sub.php?id="+id, true);
          xhttp.send();

    //       $(document).ready(function() {
    //     $('.slider-for').slick({
    //         slidesToShow: 1,
    //         slidesToScroll: 1,
    //         speed: 500,
    //         arrows: false,
    //         fade: true,
    //         asNavFor: '.slider-nav'
    //     });
    //     $('.slider-nav').slick({
    //         slidesToShow: 6,
    //         slidesToScroll: 1,
    //         speed: 500,
    //         asNavFor: '.slider-for',
    //         dots: false,
    //         focusOnSelect: true,
    //         slide: 'div'
    //     });
    // });
    }    
</script>
<script>
  function img1 () {
    // alert('tuang');
    document.getElementById("tab1").style.height = '391px';
    document.getElementById("tab2").style.height = '0';
    document.getElementById("tab3").style.height = '0';
    document.getElementById("tab4").style.display = 'none';
    document.getElementById("tab5").style.display = 'none';
    document.getElementById("tab6").style.display = 'none';
    document.getElementById("tab7").style.display = 'none';
    // $(document).ready(function() {
        // $('.slider-for1').slick({
        //     slidesToShow: 1,
        //     slidesToScroll: 1,
        //     speed: 500,
        //     arrows: false,
        //     fade: true,
        //     asNavFor: '.slider-nav1'
        // });
        // $('.slider-nav1').slick({
        //     slidesToShow: 6,
        //     slidesToScroll: 1,
        //     speed: 500,
        //     asNavFor: '.slider-for1',
        //     dots: false,
        //     focusOnSelect: true,
        //     slide: 'div'
        // });
    // });
    $(document).ready(function(){
      // $("#tab1").find(".slick-track").css({"width": "100%"});
      // $("#tab1").find(".slide-item").css({"width": "74px"});
    });
  }  

  function img2 () {
    alert('tuan');
    document.getElementById("tab1").style.height = '0';
    document.getElementById("tab2").style.height = '391px';
    document.getElementById("tab3").style.height = '0';
    document.getElementById("tab4").style.display = 'none';
    document.getElementById("tab5").style.display = 'none';
    document.getElementById("tab6").style.display = 'none';
    document.getElementById("tab7").style.display = 'none';
    // $(document).ready(function() {
        // $('.slider-for2').slick({
        //     slidesToShow: 1,
        //     slidesToScroll: 1,
        //     speed: 500,
        //     arrows: false,
        //     fade: true,
        //     asNavFor: '.slider-nav2'
        // });
        // $('.slider-nav2').slick({
        //     slidesToShow: 6,
        //     slidesToScroll: 1,
        //     speed: 500,
        //     asNavFor: '.slider-for2',
        //     dots: false,
        //     focusOnSelect: true,
        //     slide: 'div'
        // });
    // });
     $(document).ready(function(){
      // $("#tab2").find(".slick-track").css({"width": "100%"});
      // $("#tab2").find(".slide-item").css({"width": "74px"});

    });
  }  

  function img3 () {
    // alert('tuang');
    document.getElementById("tab1").style.height = '0';
    document.getElementById("tab2").style.height = '0';
    document.getElementById("tab3").style.height = '391px';
    document.getElementById("tab4").style.display = 'none';
    document.getElementById("tab5").style.display = 'none';
    document.getElementById("tab6").style.display = 'none';
    document.getElementById("tab7").style.display = 'none';
    // $(document).ready(function() {
        // $('.slider-for3').click({
        //     slidesToShow: 1,
        //     slidesToScroll: 1,
        //     speed: 500,
        //     arrows: false,
        //     fade: true,
        //     asNavFor: '.slider-nav3'
        // });
        // $('.slider-nav3').slick({
        //     slidesToShow: 6,
        //     slidesToScroll: 1,
        //     speed: 500,
        //     asNavFor: '.slider-for3',
        //     dots: false,
        //     focusOnSelect: true,
        //     slide: 'div'
        // });
    // });
    //  $(document).ready(function(){
    //   // $("#tab3").find(".slide-item").css({"width": "74px"});
    //   $("#tab3").find(".slider-for3").find(".slick-track").css({"width": "100%"});
    //   // $("#tab3").find(".slider-for3").find(".slide-item").css({"display": "none;" , "width":});
    //   // $("#tab3").find(".slider-for3").find(".slick-track").find(".slick-current").css({"width": "100px !important"});
    //   $("#tab3").find(".slider-for3").find(".slick-track").find(".slick-current").css({"left": "0", "display": "block !important;"});
    
    //   $("#tab3").find(".slider-for3").find(".slick-track").find(".slick-active").css({"display": "block"});
    //   $("#tab3").find(".slider-nav3").find(".slick-track").css({"width": "1577px"});
    //   $("#tab3").find(".slider-nav3").find(".slick-track").find(".slide-item-nav").css({"width": "75px"});
    //   $("#tab3").find(".slider-nav3").find(".slide-item").css({"width": "74px"});
    // });

  }  
</script>