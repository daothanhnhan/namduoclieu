<?php 
	session_start();
	$id = $_GET['id'];//echo $id;
	if (!in_array($id, $_SESSION['special'])) {
		// unset($_SESSION['special']);//add
		$_SESSION['special'][] = $id;
		// echo implode('-', $_SESSION['brand']);
	} else {
		if (($key = array_search($id, $_SESSION['special'])) !== false) {
		    unset($_SESSION['special'][$key]);
		}
	}
?>