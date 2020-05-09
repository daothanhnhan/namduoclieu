<?php 
	$id = $_GET['id'];
	$sql = "DELETE FROM size WHERE size_id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=size');
?>