<?php 
	session_start();
	$id = $_GET['id'];//echo $id;
	if (!in_array($id, $_SESSION['laptop'])) {
		// unset($_SESSION['laptop']);//add
		$_SESSION['laptop'][] = $id;
		// echo implode('-', $_SESSION['brand']);
	} else {
		if (($key = array_search($id, $_SESSION['laptop'])) !== false) {
		    unset($_SESSION['laptop'][$key]);
		}
	}
?>