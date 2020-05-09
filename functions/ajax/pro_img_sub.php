<?php 
	include_once dirname(__FILE__)."/../database.php";
	$id = $_GET['id'];
	$sql = "SELECT * FROM product WHERE product_id = $id";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result);
	$img_sub = json_decode($row['product_sub_img']);
?>
<div class="slide-item-nav"><img src="/images/product4.jpg" alt="" class="img-responsive"></div>
                                            <div class="slide-item-nav"><img src="/images/product5.jpg" alt="" class="img-responsive"></div>