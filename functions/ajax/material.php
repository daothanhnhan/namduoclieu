<?php 
	session_start();
	$id = $_GET['id'];//echo $id;
	if (!in_array($id, $_SESSION['material'])) {
		// unset($_SESSION['material']);//add
		$_SESSION['material'][] = $id;
		// echo implode('-', $_SESSION['brand']);
	} else {
		if (($key = array_search($id, $_SESSION['material'])) !== false) {
		    unset($_SESSION['material'][$key]);
		}
	}
?>