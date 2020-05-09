<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function groupPro ($id) {
		global $conn_vn;
		if (isset($_POST['edit_nhom'])) {
			$src= "../images/";
			// $src = "uploads/";

			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

				uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);

			}

			$name = $_POST['name'];
			// $image = $_FILES['image']['name'];

			$sql = "UPDATE product_group SET name = '$name' WHERE id = $id";
			$result = mysqli_query($conn_vn, $sql);
			echo '<script type="text/javascript">alert(\'Bạn đã sửa được một nhóm.\');</script>';
		}
	}

	groupPro($_GET['id']);

	function getGroup ($id) {
		global $conn_vn;
		$sql = "SELECT * FROM product_group WHERE id = $id";
		$result = mysqli_query($conn_vn, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}
	$group = getGroup($_GET['id']);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin <br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tên nhóm</p>
            <input type="text" class="txtNCP1" name="name" value="<?= $group['name'] ?>" required/>
            <!-- <p class="titleRightNCP">Ảnh thương hiệu</p>
            <input type="file" class="txtNCP1" name="image" required/> -->
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="edit_nhom">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>