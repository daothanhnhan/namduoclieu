<?php 
	session_start();
	$gia = $_GET['gia'];//echo $id;
	if (!in_array($gia, $_SESSION['price'])) {
		unset($_SESSION['price']);//add
		$_SESSION['price'][] = $gia;
		// echo implode('-', $_SESSION['brand']);
	} else {
		if (($key = array_search($gia, $_SESSION['price'])) !== false) {
		    unset($_SESSION['price'][$key]);
		}
	}
?>