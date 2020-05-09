<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function material ($id) {
		global $conn_vn;
		if (isset($_POST['edit_material'])) {
			$src= "../images/";
			// $src = "uploads/";

			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

				uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);

			}

			$name = $_POST['name'];
			$category = $_POST['category'];

			$sql = "UPDATE material SET name = '$name', category = $category WHERE id = $id";//echo $sql;
			$result = mysqli_query($conn_vn, $sql) or die('loi:' . mysqli_error($conn_vn));
			echo '<script type="text/javascript">alert(\'Bạn đã sửa Chất liệu thành công.\');</script>';
		}
	}

	material($_GET['id']);

	function getBrand ($id) {
		global $conn_vn;
		$sql = "SELECT * FROM material WHERE id = $id";
		$result = mysqli_query($conn_vn, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}
	$get_material = getBrand($_GET['id']);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin<br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tên</p>
            <input type="text" class="txtNCP1" name="name" value="<?= $get_material['name'] ?>" required/>
            <p class="titleRightNCP">Danh mục</p>
            <select name="category" class="txtNCP1">
            	<option value="1" <?= ($get_material['category']==1) ? 'selected' : '' ?> >Vali</option>
            	<option value="2" <?= ($get_material['category']==2) ? 'selected' : '' ?> >Balo</option>
            	<option value="3" <?= ($get_material['category']==3) ? 'selected' : '' ?> >Túi sách</option>
            	<option value="4" <?= ($get_material['category']==4) ? 'selected' : '' ?> >Phụ kiện</option>
            </select>
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="edit_material">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>