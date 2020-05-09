<?php 
	include_once dirname(__FILE__) . "/../database.php";
	$id = $_GET['id'];
	$sql = "SELECT * FROM product WHERE product_id = $id";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result);

	$myObj->product_name = $row['product_name'];
	$myObj->price_all = "
    <p class=\"price-chitiet\">
        <span class=\"main-price\">".number_format($row['product_price_sale'])." đ</span>
        <span class=\"price-compare main-price-compare\">".number_format($row['product_price'])." đ</span>
    </p>
    <p class=\"discount main-discount\">Tiết kiệm&nbsp;<span>".number_format($row['product_price']-$row['product_price_sale'])." đ</span> (<span>".number_format(($row['product_price']-$row['product_price_sale'])/$row['product_price']*100,0). "%</span>)</p>
";
	$myObj->product_id = $row['product_id'];
	$myObj->product_link = $row['friendly_url'];
	$myObj->product_img = $row['product_img'];
	$myObj->product_price = $row['product_price_sale'];

	$myJSON = json_encode($myObj);

	echo $myJSON;
?>