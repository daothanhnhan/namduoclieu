<?php 
	session_start();
	$id = $_GET['id'];//echo $id;
	if (!in_array($id, $_SESSION['color'])) {
		// unset($_SESSION['color']);//add
		$_SESSION['color'][] = $id;
		// echo implode('-', $_SESSION['brand']);
	} else {
		if (($key = array_search($id, $_SESSION['color'])) !== false) {
		    unset($_SESSION['color'][$key]);
		}
	}
?>