<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function laptop () {
		global $conn_vn;
		if (isset($_POST['add_laptop'])) {
			$src= "../images/";
			// $src = "uploads/";

			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

				uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);

			}

			$name = $_POST['name'];
			$category = $_POST['category'];

			$sql = "INSERT INTO container_laptop (name, category) VALUES ('$name', $category)";
			$result = mysqli_query($conn_vn, $sql) or die('loi:');
			echo '<script type="text/javascript">alert(\'Bạn đã thêm laptop thành công.\');window.location.href="index.php?page=laptop"</script>';
		}
	}

	laptop();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin<br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tên</p>
            <input type="text" class="txtNCP1" name="name" required/>
            <p class="titleRightNCP">Danh mục</p>
            <select name="category" class="txtNCP1">
            	<option value="1">Vali</option>
            	<option value="2">Balo</option>
            	<option value="3">Túi sách</option>
            	<option value="4">Phụ kiện</option>
            </select>
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_laptop">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>