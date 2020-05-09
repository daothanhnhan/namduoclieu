<?php 
	include_once dirname(__FILE__) . "/../database.php";
	$city = $_GET['city'];
	$sql = "SELECT * FROM district WHERE city_id = $city";
	$result = mysqli_query($conn_vn, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
	}
?>