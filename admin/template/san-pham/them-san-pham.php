<?php 

    $list = $action->getList('productcat','','','productcat_id','desc','','','');

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
    $list_size = listSize(1);

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
    $list_brand = listBrand(1);

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
    $list_material = listMaterial(1);

    $list_special = array(
        1 => 'Khóa khung',
        2 => 'Khóa kéo đôi chống rạch',
        3 => 'Siêu nhẹ',
        4 => 'Cố thể nới rộng',
        5 => 'Khóa 3 điểm',
        6 => 'Chống thấm nước',
        7 => 'Cân điện tử'
    );

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
?>
<script src="/admin/ckfinder/ckfinder.js"></script>
<script src="js/previewImage.js"></script>

<script>



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



    function deleteColor(val){

        $(val).parent().remove();

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



        $('#addSalePrice').on('click',function(e){

            e.preventDefault();

        })





        $("input[id=fileUpload2").previewimage({

            div: "#preview2",

            imgwidth: 90,

            imgheight: 90

        });



    });



    

</script>

<form action="" method="post" enctype="multipart/form-data" id="addProduct">

    <button class="btnAddTop" type="submit" style="position: fixed;top: 0;right: 220px;z-index: 9">Lưu</button>

    <input type="hidden" name="action" value="addProduct">

    <input type="hidden" name="table" id="table" value="product">

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Thông tin sản phẩm</span>

            <p class="subLeftNCP">Cung cấp thông tin về tên, mô tả loại sản phẩm và nhà sản xuất để phân loại sản phẩm</p>   

            <p class="titleRightNCP">Chọn ảnh đại diện cho sản phẩm</p>

            <div id="wrapper">

                <input id="fileUpload" type="file" name="fileUpload1" style="display: none;" onchange="showImage(this)" />
                <input id="xFilePathMain" name="FilePathMain" type="hidden" readonly />
<input type="button" value="Browse Server" onclick="BrowseServerMain();" class="controls" />
<script>
    function BrowseServerMain () {
        CKFinder.popup( {
            language: 'vi',
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

                 </div>

            </div> 

        </div>

        <div class="boxNodeContentPage">



            <p class="titleRightNCP">Tên sản phẩm</p>

            <input type="text" id="title" onchange="ChangeToSlug()" class="txtNCP1" value="" name="product_name" required/>

            <!-- <p class="titleRightNCP">Danh mục</p>
            <select class="sltBV" name="productcat_id" size="10">
                <?php $action->showCategoriesSelect($list, 'productcat_parent', 0, '', 'productcat_id', 'productcat_name', 0); ?>
            </select> -->

            <p class="titleRightNCP">Danh mục</p>
            <div class="sltBV" name="productcat_id" size="10">
                <?php $action->showProductCategoriesSelect($list, 'productcat_parent', 0, $row['productcat_id'], 'productcat_id', 'productcat_name', 0, $row['productcat_ar']); ?>
            </div>


            <!-- <p class="titleRightNCP">Tên rút gọn</p>

            <input type="text" class="txtNCP1" name="shortName1_service3" value="<?php //echo $rowPro['shortName1_service3'];?>" /> -->

            <p class="titleRightNCP">Mô tả ngắn:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP2 ckeditor" id="editor0" name="product_des"><?php echo $rowPro['product_des'];?></textarea></p>

            

            <p class="titleRightNCP">Nội dung:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="product_content"><?php echo $rowPro['product_content'];?></textarea></p>


            <p class="titleRightNCP">Phí vậy chuyển:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor3" name="product_sub_info1"></textarea></p>


            <p class="titleRightNCP">Hướng dẫn kích thước:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor4" name="product_sub_info2"></textarea></p>

            <p class="titleRightNCP">Video:</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1" id="editor2" name="product_video"></textarea></p>

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

                    <input type="text" class="txtNCP1" name="product_gift_name"/>

                </div>
            <div id="wrapper">
                <p class="titleRightNCP">Ảnh quà tặng</p>
                <input id="fileUpload11" type="file" name="fileUpload11"/>
                <br />
                <div id="image-holder">
                             
                </div>
            </div>

        </div>
    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Ảnh sản phẩm</span>

            <p class="subLeftNCP">Thiết lập ảnh sản phẩm</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>Ảnh phụ sản phẩm</h3>

            <input type="file" name="fileUpload2" style="display: none;" id="fileUpload2">
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

            </div>

        </div>

    </div><!--end rowNodeContentPage-->



    <!-- <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Thiết lập kích cỡ và màu sắc</span>

            <p class="subLeftNCP">Thiết lập kích cỡ và màu sắc</p>

        </div>

        <div class="boxNodeContentPage">

            <div class="rowNCP" id="color_section">

            </div>

            <a href="#" id="addMoreColor" class="addMoreColor">Thêm tùy chọn màu</a>

        </div>

    </div> --><!--end rowNodeContentPage-->

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
                        <option value="1">Vali</option>
                        <option value="2">Balo</option>
                        <option value="3">Tú sách</option>
                        <option value="4">Phụ kiện</option>
                    </select>

                </div>                                      

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Giá gốc (VNĐ)</p>

                    <input type="number" class="txtNCP1" value="<?php echo $rowPro['product_price'];?>" name="product_price"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Giá Khuyến mãi (VNĐ)</p>

                    <input type="number" class="txtNCP1" value="<?php echo $rowPro['product_price_sale'];?>" name="product_price_sale"/>

                </div>         

                

                

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Mã sản phẩm</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_code'];?>" name="product_code"/>

                </div>                                      

                <!-- <div class="subColContent" >

                    <p class="titleRightNCP">Xuất xứ</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_original'];?>" name="product_original"/>

                </div> -->           

                <div class="subColContent" >

                    <p class="titleRightNCP">Kích thước</p>

                    <!-- <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_size'];?>" name="product_shape"/> -->
                    <select class="txtNCP1" name="product_size" id="product_size">
                        <option value="0">Chọn ...</option>
                        <?php foreach ($list_size as $item) { ?>
                        <option value="<?= $item['size_id'] ?>"><?= $item['size_name'] ?></option>
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

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_expiration'];?>" name="product_expiration"/>

                </div>

                <div class="subColContent" >

                    <p class="titleRightNCP">Chất liệu</p>

                    <!-- <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_material'];?>" name="product_material"/> -->
                    <select class="txtNCP1" name="product_material" id="product_material">
                        <?php foreach ($list_material as $item) { ?>
                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>

                </div>                

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Thương hiệu</p>

                    <select class="txtNCP1" name="product_brand" id="product_brand">
                        <option value="0">Chọn ...</option>
                        <?php foreach ($list_brand as $item) { ?>
                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>

                </div>  

                <div class="subColContent" >

                    <p class="titleRightNCP">Ngăn đựng laptop</p>

                    <select class="txtNCP1" name="product_laptop" id="product_laptop">
                        <option value="0">Không có</option>
                    </select>

                </div>              

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Tính năng đặc biệt</p>

                    <select class="txtNCP1" name="product_special" id="product_special">
                        <option value="0">Chọn ...</option>
                        <?php foreach ($list_special as $key => $item) { ?>
                        <option value="<?= $key ?>"><?= $item ?></option>
                        <?php } ?>
                    </select>

                </div>  

                <div class="subColContent" >

                    <p class="titleRightNCP">Màu sản phẩm</p>

                    <select class="txtNCP1" name="product_color" id="product_color">
                        <?php foreach ($list_color as $key => $item) { ?>
                        <option value="<?= $key ?>"><?= $item ?></option>
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
                        <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>

                </div>     

                <div class="subColContent" >

                    <p class="titleRightNCP">Phụ kiện</p>

                    <select class="selectpicker" name="product_extra[]" id="product_extra" multiple>
                        <?php foreach ($list_pro_extra as $item) { ?>
                        <option value="<?= $item['product_id'] ?>"><?= $item['product_name'] ?></option>
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

                <input type="text" class="txtNCP1" placeholder="Điều khoản dịch vụ" name="title_seo" id="title_seo" value="<?php echo $rowPro['title_seo'];?>" onkeyup="countChar(this)"/>

            </div>

            <div>

                <p class="titleRightNCP">Thẻ mô tả</p>

                <p class="subRightNCP"><strong class="text-character"></strong>/160 ký tự</p>

                <textarea class="longtxtNCP2" name="des_seo" onkeyup="countChar(this)"><?php echo $rowPro['des_seo'];?></textarea>

            </div>

            <p class="titleRightNCP">Đường dẫn</p>

            <div class="coverLinkNCP">

                <p class="nameLinkNCP"><?php echo $_SERVER['SERVER_NAME']?>/</p>

                <div id="slug">

                    <input type="text" id="slug1" class="txtLinkNCP" name="friendly_url" value="<?php echo $rowPro['friendly_url'];?>" />     

                </div>

            </div>

            <p class="titleRightNCP">Keyword</p>

            <input type="text" class="txtNCP1" placeholder="Nhập keyword" name="keyword" value="<?php echo $rowPro['keyword'];?>"/>

            <p class="titleRightNCP">Sort</p>

            <input type="number" class="txtNCP1" placeholder="Nhập sort" name="product_sort" />

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Trạng thái</span>

        </div>

        <div class="boxNodeContentPage">

            <!-- <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_favorite">Sản phẩm yêu thích

                </label>

            </div> -->

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_new" <?= $rowPro['product_new'] == 1 ? 'checked' : '' ?>>Sản phẩm bán chạy

                </label>

            </div>

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_hot" <?= $rowPro['product_hot'] == 1 ? 'product_hot' : '' ?>>Sản phẩm Nổi bật

                </label>

            </div>

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="state" <?= $rowPro['state'] == 1 ? 'checked' : '' ?>>Trạng thái hết hàng

                </label>

            </div>

            

        </div>

    </div><!--end rowNodeContentPage-->

    

    <button type="submit" class="btn btnSave">Lưu</button>

            

</form>
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