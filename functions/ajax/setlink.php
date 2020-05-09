<?php 
	session_start();
	// $_SESSION['size'] = array_unique($_SESSION['size']);
	// unset($_SESSION['size']);
	// unset($_SESSION['brand']);
	// unset($_SESSION['material']);
	// unset($_SESSION['special']);
	// unset($_SESSION['laptop']);
	// unset($_SESSION['price']);
	// unset($_SESSION['color']);
	$link = "";
	if (!empty($_SESSION['size'])) {
		$link .= "&size=";
		foreach ($_SESSION['size'] as $item) {
			$link .= $item.",";
		}
		$link = substr($link, 0, -1);
	}

	if (!empty($_SESSION['brand'])) {
		$link .= "&brand=";
		foreach ($_SESSION['brand'] as $item) {
			$link .= $item.",";
		}
		$link = substr($link, 0, -1);
	}

	if (!empty($_SESSION['material'])) {
		$link .= "&material=";
		foreach ($_SESSION['material'] as $item) {
			$link .= $item.",";
		}
		$link = substr($link, 0, -1);
	}

	if (!empty($_SESSION['laptop'])) {
		$link .= "&laptop=";
		foreach ($_SESSION['laptop'] as $item) {
			$link .= $item.",";
		}
		$link = substr($link, 0, -1);
	}

	if (!empty($_SESSION['special'])) {
		$link .= "&special=";
		foreach ($_SESSION['special'] as $item) {
			$link .= $item.",";
		}
		$link = substr($link, 0, -1);
	}

	if (!empty($_SESSION['price'])) {
		$link .= "&price=";
		foreach ($_SESSION['price'] as $item) {
			$link .= $item.",";
		}
		$link = substr($link, 0, -1);
	}

	if (!empty($_SESSION['color'])) {
		$link .= "&color=";
		foreach ($_SESSION['color'] as $item) {
			$link .= $item.",";
		}
		$link = substr($link, 0, -1);
	}
	echo $link;
?>