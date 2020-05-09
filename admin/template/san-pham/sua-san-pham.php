<?php 

    $product_id = isset($_GET['id']) ? $_GET['id'] : '';

    $row = $action->getDetail_New('product',array('product_id'),array(&$product_id),'i');

    if ($row == '') {

        header('location: index.php?page=san-pham');

    }

    $list = $action->getList('productcat','','','productcat_id','desc','','','');

    $languages = $action->getListLanguages();



    $action_showMain = new action_page('VN');

    $lang_showMain = "vn";

    $row_showMain = $action_showMain->getDetail_New('product_languages',array('product_id','languages_code'),array(&$row['product_id'], &$lang_showMain),'is');

    $size_pro = json_decode($row['product_size']);

    ///////////////
    function listSize ($cat_id) {
        global $conn_vn;
        $sql = "SELECT * FROM size WHERE size_cat = $cat_id";//echo $sql;
        $result = mysqli_query($conn_vn, $sql);
        $rows = array();
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    $list_size = listSize($row['product_type']);

    function listBrand ($cat_id) {
        global $conn_vn;
        $sql = "SELECT * FROM brand WHERE category = $cat_id";//echo $sql;
        $result = mysqli_query($conn_vn, $sql);
        $rows = array();
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    $list_brand = listBrand($row['product_type']);

    function listMaterial ($cat_id) {
        global $conn_vn;
        $sql = "SELECT * FROM material WHERE category = $cat_id";//echo $sql;
        $result = mysqli_query($conn_vn, $sql);
        $rows = array();
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    $list_material = listMaterial($row['product_type']);

    function listLaptop ($cat_id) {
        global $conn_vn;
        $sql = "SELECT * FROM container_laptop WHERE category = $cat_id";//echo $sql;
        $result = mysqli_query($conn_vn, $sql);
        $rows = array();
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    $list_laptop = listLaptop($row['product_type']);

    $list_special = array(
        1 => 'Khóa khung',
        2 => 'Khóa kéo đôi chống rạch',
        3 => 'Siêu nhẹ',
        4 => 'Cố thể nới rộng',
        5 => 'Khóa 3 điểm',
        6 => 'Chống thấm nước',
        7 => 'Cân điện tử'
    );

    if ($row['product_type'] != 1) {
        $list_special = array();
    }

    $list_color = array(
        1 => 'Blue',
        2 => 'Pink',
        3 => 'Yellow',
        4 => 'Grey',
        5 => 'Brown',
        6 => 'Red',
        7 => 'Orange',
        8 => 'Black',
        9 => 'Green',
        10 => 'White',
        11 => 'Purple'
    );

    function listGroup () {
        global $conn_vn;
        $sql = "SELECT * FROM product_group";
        $result = mysqli_query($conn_vn, $sql);
        $rows = array();
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    $list_group = listGroup();

    function listProExtra () {
        global $conn_vn;
        $sql = "SELECT * FROM productcat WHERE productcat_parent = 124";
        $result = mysqli_query($conn_vn, $sql);
        $rows = array();
        $num = mysqli_num_rows($result);
        $sql = "SELECT * FROM product WHERE productcat_ar LIKE '%124%'";
        if ($num > 0) {
        	while ($row = mysqli_fetch_assoc($result)) {
        		$like = $row['productcat_id'];
        		$sql .= " OR productcat_ar LIKE '%$like%'";
        	}
        }
        // echo $sql;
        
        $result = mysqli_query($conn_vn, $sql);
        $rows = array();
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    $list_pro_extra = listProExtra();

    ///////////////
    $product_extra_arr = explode(",", $row['product_extra']);

?>
<script src="/admin/ckfinder/ckfinder.js"></script>
<script src="js/previewImage.js"></script>

<script>



    function deleteColor(val){

        if (confirm('Xóa màu sản phẩm, sẽ xóa tất cả kích cỡ của màu này')) {

            $(val).parent().remove();

        }

    }



    function addMoreSize(self){

        var total = $(self).parents('.colorProduct').data('total');

        $.ajax({

            url: "ajax.php",

            data: {'action': 'addMoreSize', 'total': total },

            type: "post",

            success:function(html){

                $(self).parent('.size_section').append(html);

                //$("#size_section").append(html);

            }

        })

    }



    function deleteSales(val){

        if (confirm('Xóa khuyến mãi')) {

            $(val).parent().remove();

        }

    }



    function deleteSize(val){

        if (confirm('Xóa kích cỡ')) {

            $(val).parents().eq(2).remove();

        }

    }



    $(document).ready(function() {



        $('#addMoreSales').on('click',function(e){

            e.preventDefault();

            var total = $('.salesProduct').length;

            $.ajax({

                url: "ajax.php",

                data: {'action': 'addMoreSales', 'total': total },

                type: "post",

                success:function(html){

                    $("#sales_section").append(html);

                }

            })

        })



        $("#addMoreColor").on("click",function(e){

            e.preventDefault();

            var total = $('.colorProduct').length;

            $.ajax({

                url: "ajax.php",

                data: {'action': 'addMoreColor', 'total': total },

                type: "post",

                success:function(html){

                    $("#color_section").append(html);

                }

            })

        })



        

        $("input[id=fileUpload2").previewimage({

            div: "#preview2",

            imgwidth: 90,

            imgheight: 90

        });



        $("#productOrg").on("keyup",function(){

            $("#box_suggest_productOrg").show();

            var text = $(this).val();

            if (text != "") {

                $.ajax({

                    type: "post",

                    url: "ajax.php?action=getSuggestOrg",

                    data: "keyword="+$(this).val(),

                    success:function(data){

                        $("#box_suggest_productOrg").html(data);

                    }

                })

            }

        })

    });

</script>



<form action="" id="updateLangProduct">

    <input type="hidden" name="action" value="updateLangProduct">

    <input type="hidden" name="product_id" value="<?= $product_id ?>">

    <div class="modal fade" id="modal-id">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Chỉnh sửa ngôn ngữ</h4>

                </div>

                <div class="modal-body">

                    <div role="tabpanel">

                        <!-- Nav tabs -->

                        <ul class="nav nav-tabs" role="tablist">

                            <?php 

                                foreach ($languages as $key => $lang) {

                                ?>

                                    <li role="presentation" class="<?= $key == 0 ? 'active' : ''?>">

                                        <a href="#<?= $lang['languages_code']?>" aria-controls="home" role="tab" data-toggle="tab"><?= $lang['languages_name']?></a>

                                    </li>

                                <?php

                                }

                            ?>

                        </ul>

                    

                        <!-- Tab panes -->

                        <div class="tab-content">

                            <?php 

                                foreach ($languages as $key => $lang) {

                                    $action1 = new action_page();

                                    $rowDetailLang = $action1->getDetail_New('product_languages',array('product_id','languages_code'),array(&$row['product_id'], &$lang['languages_code']),'is');

                                    

                                ?>

                                    <div role="tabpanel" class="tab-pane <?= $key == 0 ? 'active' : ''?>" id="<?= $lang['languages_code']?>">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_des2]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_des3]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_content2]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_content3]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_payment_type]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_sub_info1]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_sub_info2]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_sub_info3]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_sub_info4]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_sub_info5]" value="">

                                        <p class="titleRightNCP">Tiêu đề</p>

                                        <input type="text" class="txtNCP1" value="<?= $rowDetailLang['lang_product_name'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_name]" id="product_name_<?= $lang['languages_code']?>" onkeyup="pro_<?= $lang['languages_code']?>()"/>

                                        

                                        <p class="titleRightNCP">Mô tả ngắn</p>

                                        <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor<?= $lang['languages_code']?>" name="lang[<?= $lang['languages_code']?>][lang_product_des]" ><?= $rowDetailLang['lang_product_des'];?></textarea></p>

                                        <p class="titleRightNCP">Nội dung</p>

                                        <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1<?= $lang['languages_code']?>" name="lang[<?= $lang['languages_code']?>][lang_product_content]" ><?= $rowDetailLang['lang_product_content'];?></textarea></p>



                                        <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Mã sản phẩm</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_code'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_code]"/>

                                            </div>                                      

                                            <div class="subColContent" >

                                                <p class="titleRightNCP">Xuất xứ</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_original'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_original]"/>

                                            </div>               

                                        </div><!--end rowNCP-->

                                        <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Kích cỡ</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_size'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_size]"/>

                                            </div>                                      

                                            <div class="subColContent" >

                                                <p class="titleRightNCP">Đóng gói</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_package'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_package]"/>

                                            </div>               

                                        </div><!--end rowNCP-->

                                        <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Giao hàng</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_delivery'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_delivery]"/>

                                            </div>                                      

                                            <div class="subColContent" >

                                                <p class="titleRightNCP">Thời gian giao hàng</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_delivery_time'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_delivery_time]"/>

                                            </div>               

                                        </div><!--end rowNCP-->

                                        <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Hình thức thanh toán</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_payment'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_payment]"/>

                                            </div>                                      

                                                       

                                        </div><!--end rowNCP-->

                                         <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Đường dẫn</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['friendly_url'];?>" id="url_<?= $lang['languages_code']?>" name="lang[<?= $lang['languages_code']?>][friendly_url]"/>

                                            </div>                                      

                                        </div><!--end rowNCP-->

                                        <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Tiêu đề trang</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['title_seo'];?>" name="lang[<?= $lang['languages_code']?>][title_seo]"/>

                                            </div>                                      

                                        </div><!--end rowNCP-->


                                        <!-- <div>

                                            <p class="titleRightNCP">Tiêu đề trang</p>

                                            <p class="subRightNCP"> <strong class="text-character"></strong>/70 ký tự</p>

                                            <input type="text" class="txtNCP1" placeholder="Điều khoản dịch vụ" name="title_seo" id="title_seo" value="<?php echo $row_showMain['title_seo'];?>" onkeyup="countChar(this)"/>

                                        </div> -->

                                    </div>

                                <?php

                                }

                            ?>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Save changes</button>

                </div>

            </div>

        </div>

    </div>

</form>

<form action="" method="post" enctype="multipart/form-data" id="updateProduct">

    <button class="btnAddTop" type="submit" style="position: fixed;top: 0;right: 220px;z-index: 9;<?php echo ($_SESSION['admin_role']==2)?'display: none;':'';?>">Lưu</button>

    <a class="btnAddTop" data-toggle="modal" href='#modal-id' style="position: fixed;top: 0;right: 285px;z-index: 9;<?php echo ($hidden_multi_lang=='hidden')?'display: none;':'';?>">Chỉnh sửa ngôn ngữ</a>

    <input type="hidden" name="action" value="updateProduct">

    <input type="hidden" name="product_id" value="<?= $product_id?>">

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Thông tin sản phẩm</span>

            <p class="subLeftNCP">Cung cấp thông tin về tên, mô tả loại sản phẩm và nhà sản xuất để phân loại sản phẩm</p>   

            <p class="titleRightNCP">Chọn ảnh đại diện cho sản phẩm</p>

            <div id="wrapper">

                <input id="fileUpload" type="file" name="fileUpload1"style="display: none;" onchange="showImage(this)" />
                <input id="xFilePathMain" name="FilePathMain" type="hidden" readonly />
<input type="button" value="Browse Server" onclick="BrowseServerMain();" class="controls" />
<script>
    function BrowseServerMain () {
        CKFinder.popup( {
            language: 'vi',
            // startupPath: 'Course Images:/',
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    var output = document.getElementById( 'xFilePathMain' );
                    // alert(file.getUrl());
                    output.value = file.getUrl();
                } );

                // finder.on( 'file:choose:resizedImage', function( evt ) {
                //     var output = document.getElementById( 'xFilePath' );
                //     output.value = evt.data.resizedUrl;
                // } );

                // finder.on( 'files:choose', function( evt ) {
                //     var files = evt.data.files;

                //     var chosenFiles = '';

                //     files.forEach( function( file, i ) {
                //         chosenFiles += ',' + file.getUrl();
                //     } );

                //     chosenFiles = chosenFiles.substr(1);
                //     // alert( chosenFiles );
                //     var output = document.getElementById( 'xFilePath' );
                //     output.value = chosenFiles;
                // } );
            }
        } );
    }
</script>

                <br />

                <div id="image-holder">

                    <?php 

                        if ($row['product_img'] != '') {

                        ?>

                            <img src="<?= $row['product_img']?>" class="img-responsive" alt="Image">

                            <input type="hidden" name="product_img" value="<?= $row['product_img']?>">

                        <?php

                        }

                    ?>

                </div>

            </div> 

        </div>

        <div class="boxNodeContentPage">



            <p class="titleRightNCP">Tên sản phẩm</p>

            <input type="text" id="title" onchange="ChangeToSlug()" class="txtNCP1" value="<?= $row_showMain['lang_product_name']?>" name="product_name" required/>

           <!--  <p class="titleRightNCP">Danh mục</p>

            <select class="sltBV" name="productcat_id" size="10">

                <?php $action->showCategoriesSelect($list, 'productcat_parent', 0, $row['productcat_id'], 'productcat_id', 'productcat_name', 0); ?>

            </select> -->


            <!-- test multi Danh mục -->
            <p class="titleRightNCP">Danh mục</p>
            <div class="sltBV" name="productcat_id" size="10">
                <?php $action->showProductCategoriesSelect($list, 'productcat_parent', 0, $row['productcat_id'], 'productcat_id', 'productcat_name', 0, $row['productcat_ar']); ?>
            </div>



            <!-- <p class="titleRightNCP">Tên rút gọn</p>
            <input type="text" class="txtNCP1" name="shortName1_service3" value="<?php //echo $row['shortName1_service3'];?>" /> -->


            <p class="titleRightNCP">Mô tả ngắn:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP2 ckeditor" id="editor0" name="product_des"><?php echo $row_showMain['lang_product_des'];?></textarea></p>

            

            <p class="titleRightNCP">Nội dung:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="product_content"><?php echo $row_showMain['lang_product_content'];?></textarea></p>


            <p class="titleRightNCP">Phí vậy chuyển:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor3" name="product_sub_info1"><?php echo $row_showMain['lang_product_sub_info1'];?></textarea></p>


            <p class="titleRightNCP">Hướng dẫn kích thước:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor4" name="product_sub_info2"><?php echo $row_showMain['lang_product_sub_info2'];?></textarea></p>

            <p class="titleRightNCP">Video:</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1" id="editor2" name="product_video"><?php echo $row['product_video'];?></textarea></p>
        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Phần quà tặng</span>
            <p class="subLeftNCP">Thay cho website<br /><br /></p>                         
        </div>
        <div class="boxNodeContentPage">
            <div class="subColContent">

                    <p class="titleRightNCP">Tên quà tặng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_gift_name'];?>" name="product_gift_name"/>

                </div>
            <div id="wrapper">
                <p class="titleRightNCP">Ảnh quà tặng</p>
                <input id="fileUpload11" type="file" name="fileUpload11"/>
                <br />
                <div id="image-holder">
                <?php 
                    if ($row['product_gift_image'] != '') {
                    ?>
                        <img src="../images/<?= $row['product_gift_image'] ?>" class="img-responsive" alt="Image" width="300">
                        <input type="hidden" name="product_gift_image" value="<?= $row['product_gift_image'] ?>">
                    <?php
                    }
                ?>                
                </div>
            </div>

        </div>
    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Ảnh phụ sản phẩm</span>

            <p class="subLeftNCP">Thiết lập ảnh phụ cho sản phẩm</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>Ảnh phụ sản phẩm</h3>

            

            <input type="file" name="fileUpload2" id="fileUpload2" style="display: none;" multiple>
            <input id="xFilePath" name="FilePath" type="hidden" readonly />
<input type="button" value="Browse Server" onclick="BrowseServer();" class="controls" />
<script>
    function BrowseServer () {
        CKFinder.popup( {
            language: 'vi',
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function( finder ) {
                // finder.on( 'files:choose', function( evt ) {
                //     var file = evt.data.files.first();
                //     var output = document.getElementById( 'xFilePath' );
                //     output.value = file.getUrl();
                // } );

                // finder.on( 'file:choose:resizedImage', function( evt ) {
                //     var output = document.getElementById( 'xFilePath' );
                //     output.value = evt.data.resizedUrl;
                // } );

                finder.on( 'files:choose', function( evt ) {
                    var files = evt.data.files;

                    var chosenFiles = '';

                    files.forEach( function( file, i ) {
                        chosenFiles += ',' + file.getUrl();
                    } );

                    chosenFiles = chosenFiles.substr(1);
                    // alert( chosenFiles );
                    var output = document.getElementById( 'xFilePath' );
                    output.value = chosenFiles;
                } );
            }
        } );
    }
</script>

            <div class="preview2" id="preview2"> 

                <?php

                    $array = json_decode($row['product_sub_img'], true);

                    foreach ($array as $key => $val) {

                        $img = json_decode($val, true);

                        if ($img != '') {

                            ?>

                                <div class="sub_image_product">

                                    <input type="hidden" name="subImage[]" value="<?= $img['image']?>">

                                    <img src="<?= $img['image']?>" alt="">

                                    <p data-upload-preview="fileUpload2[]-0" style="cursor: pointer;">Xóa ảnh</p>

                                </div>

                            <?php                            

                        }

                    }

                ?>

            </div>

        </div>

    </div><!--end rowNodeContentPage-->



    <div class="rowNodeContentPage">

        <!-- <div class="leftNCP">

            <span class="titLeftNCP">Ảnh sản phẩm</span>

            <p class="subLeftNCP">Thiết lập ảnh sản phẩm</p>

        </div> -->

        <!--  <div class="boxNodeContentPage">

            <div class="rowNCP" id="color_section">

                <?php

                    $i = 0;

                    $row1s1 = $action->getList('color','product_id', $row['product_id'],'','','','','');

                    foreach ($row1s1 as $key => $row1) {

                        $i++;

                        //print_r($row1);

                        $a1 = json_decode($row1, true);

                        ?>

                            <div class="row1 colorProduct" id="colorProduct" data-total=<?= $i?> style="position: relative; border-bottom: 1px solid #999; padding-bottom: 10px;">

                                <input type="hidden" name="name[<?= $i?>][color_id]" value="<?= $row1['color_id']?>">

                                <div class="subColContent2">

                                    <p class="titleRightNCP">Tên màu</p>

                                    <input type="text" name="name[<?= $i?>][name]" value="<?= $row1['color_name']?>" placeholder="" class="txtNCP1" required>

                                </div>

                                <div class="subColContent2">

                                <p class="titleRightNCP">Ảnh màu</p>

                                    <input type="file" name="name[<?= $i?>][img]" value="" placeholder="" class="txtNCP1" >

                                </div>

                                <?php 

                                    if ($row1['color_img'] != '') {

                                    ?>

                                        <div class="subColContent3">

                                            <img src="../image/product/<?= $row1['color_img']?>" alt="">

                                            <input type="hidden" name="name[<?= $i?>][color_img]" value="<?= $row1['color_img']?>">

                                        </div>

                                    <?php

                                    }

                                ?>

                                

                                <div class="row1NCP size_section" id="size_section1" >

                                    

                                    <?php 

                                        $rows2 = $action1->getList('size','color_id',$row1['color_id'],'','','','','');

                                        foreach ($rows2 as $key => $value) {

                                            

                                        ?>

                                            <div class="" id="colorProduct">

                                                <input type="hidden" name="b[<?= $i?>][size_id][]" value="<?= $value['size_id']?>">

                                                <div class="subColContent2">

                                                    <p class="titleRightNCP">Kích cỡ</p>

                                                    <input type="text" name="b[<?= $i?>][size][]" value="<?= $value['size_name']?>" placeholder="" class="txtNCP1" required>

                                                </div>

                                                <div class="subColContent2">

                                                    <p class="titleRightNCP">Số lượng</p>

                                                    <input type="text" name="b[<?= $i?>][stock][]" value="<?= $value['size_stock']?>" placeholder="" class="txtNCP1" required>

                                                </div>

                                                <div class="subColContent2" style="position: relative;">

                                                    <div style="position: absolute; top: 40px; left: 10px; cursor: pointer; background-color: #931313; padding: 9px 10px; color: #fff; border:1px solid #931313; border-radius: 5px;" onclick="deleteSize(this)">

                                                        <i class="fa-lg fa fa-trash"></i>

                                                    </div>

                                                </div>

                                            </div>

                                        <?php

                                        }

                                    ?>

                                    <a href="javascript:void(0)" id="addMoreSize" class="addMoreProductPart" onclick="addMoreSize(this)">Thêm kích cỡ 1</a>

                                </div>

                                <div class="" style="position: absolute; top: 40px; right: 10px; cursor: pointer; background-color: #931313; padding: 9px 10px; color: #fff; border:1px solid #931313; border-radius: 5px;" onclick="deleteColor(this)">

                                    <i class="fa-lg fa fa-trash"></i>

                                </div>

                            </div>

                        <?php

                    }

                ?>

            </div>

            <a href="#" id="addMoreColor" class="addMoreColor">Thêm tùy chọn màu</a>

        </div>

    </div> --><!--end rowNodeContentPage

    

    <div class="rowNodeContentPage">

        <!-- <div class="leftNCP">

            <span class="titLeftNCP">Quản lý kho và tùy chọn</span>

            <p class="subLeftNCP">Bạn có thể cấu hình và quản lý kho cho từng loại của sản phẩm này</p>

        </div> -->

        <!-- <div class="boxNodeContentPage">

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Giá</p>

                    <input type="number" class="txtNCP1" value="<?php echo $row['product_price'];?>" name="product_price"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Giá trước khuyến mãi</p>

                    <input type="number" class="txtNCP1" value="<?php echo $row['product_price_sale'];?>" name="product_price_sale"/>

                </div>               

            </div>

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Mã sản phẩm</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_code'];?>" name="product_code"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Xuất xứ</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_original'];?>" name="product_original"/>

                </div>               

            </div>

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Kích cỡ</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_size'];?>" name="product_size"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Đóng gói</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_package'];?>" name="product_package"/>

                </div>               

            </div>

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Giao hàng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_delivery'];?>" name="product_delivery"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Thời gian giao hàng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_delivery_time'];?>" name="product_delivery_time"/>

                </div>               

            </div>

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Hình thức thanh toán</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_payment'];?>" name="product_payment"/>

                </div>                                      

                           

            </div>

        </div>

    </div> -->

    <!-- <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Quản lý kích cỡ</span>

            <p class="subLeftNCP">Bạn có thể cấu hình và quản lý kho cho từng loại của sản phẩm này</p>

        </div>

        <div class="boxNodeContentPage">

            <button type="button" onclick="add_size()">Thêm</button>

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Kích cỡ</p>
                    <div id="size">
                        <?php foreach ($size_pro as $item) { ?>
                        <div class="del-input">
                            <input type="text" class="txtNCP1" value="<?php echo $item;?>" name="product_size[]"/>
                            <button type="button" onclick="del_size(this)">Xóa</button>
                        </div>
                        <?php } ?>         
                    </div>                    

                </div>    

            </div>

        </div>

    </div> -->

    <script type="text/javascript">
        function add_size () {
            var size = document.getElementById('size').innerHTML;
            document.getElementById('size').innerHTML = size + '<div class="del-input"><input type="text" class="txtNCP1" value="" name="product_size[]"/><button type="button" onclick="del_size(this)">Xóa</button></div>';
        }

        function del_size (input) {
            document.getElementById('size').removeChild(input.parentNode);
        }
    </script>

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Quản lý kho và tùy chọn</span>

            <p class="subLeftNCP">Bạn có thể cấu hình và quản lý kho cho từng loại của sản phẩm này</p>

        </div>

        <div class="boxNodeContentPage">

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Loại sản phẩm</p>

                    <select class="txtNCP1" name="product_type" onchange="filter(this)">
                        <option value="1" <?= ($row['product_type']==1) ? 'selected' : '' ?> >Vali</option>
                        <option value="2" <?= ($row['product_type']==2) ? 'selected' : '' ?> >Balo</option>
                        <option value="3" <?= ($row['product_type']==3) ? 'selected' : '' ?> >Tú sách</option>
                        <option value="4" <?= ($row['product_type']==4) ? 'selected' : '' ?> >Phụ kiện</option>
                    </select>

                </div>                                      

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Giá gốc (VNĐ)</p>

                    <input type="number" class="txtNCP1" value="<?php echo $row['product_price'];?>" name="product_price"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Giá Khuyến mãi </p>

                    <input type="number" class="txtNCP1" value="<?php echo $row['product_price_sale'];?>" name="product_price_sale"/>

                </div>           

                

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Mã sản phẩm</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_code'];?>" name="product_code"/>

                </div>                                      

                <!-- <div class="subColContent" >

                    <p class="titleRightNCP">Xuất xứ</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_original'];?>" name="product_original"/>

                </div> -->           

                <div class="subColContent" >

                    <p class="titleRightNCP">Kích thước</p>

                    <select class="txtNCP1" name="product_size" id="product_size">
                        <?php 
                        if (count($list_size)!=0) { ?>
                        <option value="0">Chọn ...</option>
                        <?php foreach ($list_size as $item) { 
                        ?>
                        <option value="<?= $item['size_id'] ?>" <?= ($item['size_id']==$row['product_size']) ? 'selected' : '' ?> ><?= $item['size_name'] ?></option>
                        <?php } } else { ?>
                        <option value="0">Không có</option>
                        <?php } ?>
                    </select>

                </div>    

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <!-- <div class="subColContent">

                    <p class="titleRightNCP">Kích cỡ</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_size'];?>" name="product_size"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Đóng gói</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_package'];?>" name="product_package"/>

                </div>  -->

                <div class="subColContent">

                    <p class="titleRightNCP">Hãng sản xuất</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_expiration'];?>" name="product_expiration"/>

                </div>  

                <div class="subColContent" >

                    <p class="titleRightNCP">Chất liệu</p>

                    <!-- <input type="text" class="txtNCP1" value="<?php echo $row['product_material'];?>" name="product_material"/> -->
                    <select class="txtNCP1" name="product_material" id="product_material">
                        <?php 
                        if (count($list_material)!=0) { 
                        foreach ($list_material as $item) { ?>
                        <option value="<?= $item['id'] ?>" <?= ($item['id']==$row['product_material']) ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                        <?php } } else { ?>
                        <option value="0">Không có</option>
                        <?php } ?>
                    </select>

                </div>              

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Thương hiệu</p>

                    <select class="txtNCP1" name="product_brand" id="product_brand">
                        <?php 
                        if (count($list_brand)!=0) { ?>
                        <option value="0">Chọn ...</option>
                        <?php foreach ($list_brand as $item) { ?>
                        <option value="<?= $item['id'] ?>" <?= ($item['id']==$row['product_brand']) ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                        <?php } } else { ?>
                        <option value="0">Không có</option>
                        <?php } ?>
                    </select>

                </div>  

                <div class="subColContent" >

                    <p class="titleRightNCP">Ngăn đựng laptop</p>

                    <select class="txtNCP1" name="product_laptop" id="product_laptop">
                        <?php 
                        if (count($list_laptop)!=0) { 
                        foreach ($list_laptop as $item) { ?>
                        <option value="<?= $item['id'] ?>" <?= ($item['id']==$row['product_laptop']) ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                        <?php } } else { ?>
                        <option value="0">Không có</option>
                        <?php } ?>
                    </select>

                </div>              

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Tính năng đặc biệt</p>

                    <select class="txtNCP1" name="product_special" id="product_special">
                        <?php 
                        if (count($list_special)!=0) { ?>
                        <option value="0">Chọn ...</option>
                        <?php foreach ($list_special as $key => $item) { ?>
                        <option value="<?= $key ?>" <?= ($key==$row['product_special']) ? 'selected' : '' ?> ><?= $item ?></option>
                        <?php } } else { ?>
                        <option value="0">Không có</option>
                        <?php } ?>
                    </select>

                </div>  

                <div class="subColContent" >

                    <p class="titleRightNCP">Màu sản phẩm</p>

                    <select class="txtNCP1" name="product_color" id="product_color">
                        <?php foreach ($list_color as $key => $item) { ?>
                        <option value="<?= $key ?>" <?= ($key==$row['product_color']) ? 'selected' : '' ?> ><?= $item ?></option>
                        <?php } ?>
                    </select>

                </div>              

            </div><!--end rowNCP-->

            <!-- <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Giao hàng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_delivery'];?>" name="product_delivery"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Thời gian giao hàng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_delivery_time'];?>" name="product_delivery_time"/>

                </div>               

            </div> --><!--end rowNCP-->

            <!-- <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Hình thức thanh toán</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_payment'];?>" name="product_payment"/>

                </div>                                      

                           

            </div> --><!--end rowNCP-->

        </div>

    </div>

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Quản lý nhóm</span>

            <p class="subLeftNCP">Bạn có thể cấu hình và quản lý kho cho từng loại của sản phẩm này</p>

        </div>

        <div class="boxNodeContentPage">

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Lựa chọn nhóm sản phẩm</p>

                    <select class="txtNCP1" name="product_group_id" id="product_group_id">
                        <option value="0">Chọn nhóm ...</option>
                        <?php 
                        foreach ($list_group as $item) { ?>
                        <option value="<?= $item['id'] ?>" <?= ($item['id']==$row['product_group_id']) ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>

                </div>    

                <div class="subColContent" >

                    <p class="titleRightNCP">Phụ kiện</p>

                    <select class="selectpicker" name="product_extra[]" id="product_extra" multiple>
                        <?php 
                        foreach ($list_pro_extra as $item) { 
                            if (in_array($item['product_id'], $product_extra_arr)) { 
                                $select_extra = "selected";
                            } else {
                                $select_extra = "";
                            }
                        ?>
                        <option value="<?= $item['product_id'] ?>" <?= $select_extra ?> ><?= $item['product_name'] ?></option>
                        <?php } ?>
                    </select>

                </div>            

            </div>

        </div>

    </div>

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Tối ưu SEO</span>

            <p class="subLeftNCP">Thiết lập thẻ tiêu đề, thẻ mô tả, đường dẫn. Những thông tin này xác định cách danh mục xuất hiện trên công cụ tìm kiếm.</p>                

        </div>

        <div class="boxNodeContentPage">

            <div>

                <p class="titleRightNCP">Tiêu đề trang</p>

                <p class="subRightNCP"> <strong class="text-character"></strong>/70 ký tự</p>

                <input type="text" class="txtNCP1" placeholder="Điều khoản dịch vụ" name="title_seo" id="title_seo" value="<?php echo $row_showMain['title_seo'];?>" onkeyup="countChar(this)"/>

            </div>

            <div>

                <p class="titleRightNCP">Thẻ mô tả</p>

                <p class="subRightNCP"><strong class="text-character"></strong>/160 ký tự</p>

                <textarea class="longtxtNCP2" name="des_seo" onkeyup="countChar(this)"><?php echo $row_showMain['des_seo'];?></textarea>

            </div>

            <p class="titleRightNCP">Đường dẫn</p>

            <div class="coverLinkNCP">

                <p class="nameLinkNCP"><?php echo $_SERVER['SERVER_NAME']?>/</p>

                <div id="slug">

                    <input type="text" id="slug1" class="txtLinkNCP" name="friendly_url" value="<?php echo $row_showMain['friendly_url'];?>" />     

                </div>

            </div>

            <p class="titleRightNCP">Keyword</p>

            <input type="text" class="txtNCP1" placeholder="Nhập keyword" name="keyword" value="<?php echo $row_showMain['keyword'];?>"/>

            <p class="titleRightNCP">Sort</p>

            <input type="number" class="txtNCP1" placeholder="Nhập sort" name="product_sort" value="<?php echo $row['product_sort'];?>"/>

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Trạng thái</span>

        </div>

        <div class="boxNodeContentPage">

            <!-- <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_favorite" <?= $row['product_favorite'] == 1 ? 'checked' : '' ?>>Sản phẩm yêu thích

                </label>

            </div> -->

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_new" <?= $row['product_new'] == 1 ? 'checked' : '' ?>>Sản phẩm bán chạy

                </label>

            </div>

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_hot" <?= $row['product_hot'] == 1 ? 'checked' : '' ?>>Sản phẩm Nổi bật

                </label>

            </div>

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="state" <?= $row['state'] == 1 ? 'checked' : '' ?>>Trạng thái hết hàng

                </label>

            </div>

            

        </div>

    </div><!--end rowNodeContentPage-->

    

    <button type="submit" class="btn btnSave" <?php echo ($_SESSION['admin_role']==2)?'style="display: none;"':'';?> >Lưu</button>

    <button type="button" class="btn btnDelete" id="deleteProduct" data-id="<?= $product_id?>" data-action="deleteProduct" <?php echo ($_SESSION['admin_role']==2)?'style="display: none;"':'';?> >Xóa</button>

            

</form>
<script type="text/javascript">
    function pro_vn () {
        // alert('vn');
        var title, slug;
        //alert ("a");
        //Lấy text từ thẻ input title 
        title = document.getElementById("product_name_vn").value;
        // document.getElementById('title_seo').value = title;
        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
     
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('url_vn').value = slug;
        // document.getElementById('title_seo').value = title;
    }

    function pro_en () {
        // alert('en');
        var title, slug;
        //alert ("a");
        //Lấy text từ thẻ input title 
        title = document.getElementById("product_name_en").value;
        // document.getElementById('title_seo').value = title;
        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
     
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('url_en').value = slug;
        // document.getElementById('title_seo').value = title;
    }
</script>
<script>
    function filter (data) {
        // alert(data.value);
        var id = data.value;
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var ouput = this.responseText;
             var json = JSON.parse(ouput);
             // alert(json.brand);
             document.getElementById("product_size").innerHTML = json.size;
             document.getElementById("product_brand").innerHTML = json.brand;
             document.getElementById("product_material").innerHTML = json.material;
             document.getElementById("product_laptop").innerHTML = json.laptop;
             document.getElementById("product_special").innerHTML = json.special;
            }
          };
          xhttp.open("GET", "/functions/ajax/filter.php?id="+id, true);
          xhttp.send();
    }
</script>