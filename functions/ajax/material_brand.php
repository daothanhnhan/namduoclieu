<?php 
	session_start();
	$id = $_GET['id'];//echo $id;
	if (!in_array($id, $_SESSION['material_brand'])) {
		// unset($_SESSION['material_brand']);//add
		$_SESSION['material_brand'][] = $id;
		// echo implode('-', $_SESSION['brand']);
	} else {
		if (($key = array_search($id, $_SESSION['material_brand'])) !== false) {
		    unset($_SESSION['material_brand'][$key]);
		}
	}
?>