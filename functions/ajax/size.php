<?php 
	session_start();
	$id = $_GET['id'];//echo $id;
	if (!in_array($id, $_SESSION['size'])) {
		// unset($_SESSION['size']);//add
		$_SESSION['size'][] = $id;
		// echo implode('-', $_SESSION['brand']);
	} else {
		if (($key = array_search($id, $_SESSION['size'])) !== false) {
		    unset($_SESSION['size'][$key]);
		}
	}
?>