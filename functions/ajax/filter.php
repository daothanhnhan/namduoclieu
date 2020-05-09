<?php 
	include_once dirname(__FILE__)."/../database.php";
	$cat_id = $_GET['id'];
	$sql = "SELECT * FROM size WHERE size_cat = $cat_id";
	$result = mysqli_query($conn_vn, $sql);
	$rows = array();
	$size = "<option value=\"0\">Chọn ...</option>";
	$num = mysqli_num_rows($result);
	if ($num > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
			$size .= '<option value="'.$row['size_id'].'">'.$row['size_name'].'</option>';
		}
	} else {
		$size = '<option value="0">Không có</option>';
	}
	// echo $size;

	$sql = "SELECT * FROM brand WHERE category = $cat_id";
	$result = mysqli_query($conn_vn, $sql);
	$rows = array();
	$brand = "<option value=\"0\">Chọn ...</option>";
	$num = mysqli_num_rows($result);
	if ($num > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
			$brand .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
		}
	} else {
		$brand = '<option value="0">Không có</option>';
	}

	$sql = "SELECT * FROM material WHERE category = $cat_id";
	$result = mysqli_query($conn_vn, $sql);
	$rows = array();
	$material = "";
	$num = mysqli_num_rows($result);
	if ($num > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
			$material .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
		}
	} else {
		$material = '<option value="0">Không có</option>';
	}

	$sql = "SELECT * FROM container_laptop WHERE category = $cat_id";
	$result = mysqli_query($conn_vn, $sql);
	$rows = array();
	$laptop = "";
	$num = mysqli_num_rows($result);
	if ($num > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
			$laptop .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
		}
	} else {
		$laptop = '<option value="0">Không có</option>';
	}

	if ($cat_id == 1) {
		$list_special = array(
	        1 => 'Khóa khung',
	        2 => 'Khóa kéo đôi chống rạch',
	        3 => 'Siêu nhẹ',
	        4 => 'Cố thể nới rộng',
	        5 => 'Khóa 3 điểm',
	        6 => 'Chống thấm nước',
	        7 => 'Cân điện tử'
	    );
	    $special = "<option value=\"0\">Chọn ...</option>";
	    foreach ($list_special as $key => $item) {
	    	$special .= '<option value="'.$key.'">'.$item.'</option>';
	    }
	} else {
		$special = '<option value="0">Không có</option>';
	}

	$filter = new stdClass();
	$filter->size = $size;
	$filter->brand = $brand;
	$filter->material = $material;
	$filter->laptop = $laptop;
	$filter->special = $special;
	$json = json_encode($filter);
	echo $json;
?>