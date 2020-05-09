<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function slide ($id) {
		global $conn_vn;
		if (isset($_POST['add_slide'])) {
			$src= "../images/";
			// $src = "uploads/";
			$image = '';

			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

				uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
				$image = $_FILES['image']['name'];

			}

			$name = $_POST['name'];
			$link = $_POST['link'];

			if ($image == '') {
				$sql = "UPDATE news_banner SET name = '$name', link = '$link' WHERE id = $id";
			} else {
				$sql = "UPDATE news_banner SET name = '$name', link = '$link', image = '$image' WHERE id = $id";
			}
			
			$result = mysqli_query($conn_vn, $sql);
			echo '<script type="text/javascript">alert(\'Bạn đã sửa được một banner.\');</script>';
		}
	}

	slide($_GET['id']);

	$getslide = $acc->getDetail('news_banner', 'id', $_GET['id']);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin Slide<br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tên </p>
            <input type="text" class="txtNCP1" name="name" value="<?= $getslide['name'] ?>" />
            <p class="titleRightNCP">Link </p>
            <input type="text" class="txtNCP1" name="link" value="<?= $getslide['link'] ?>" />
            <p class="titleRightNCP">Ảnh</p>
            <input type="file" class="txtNCP1" name="image" />
            <img src="/images/<?= $getslide['image'] ?>" width="100">
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_slide">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>