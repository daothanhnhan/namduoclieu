<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";
	$action = new action();
	$id = $_GET['id'];
	$sql = "SELECT * FROM product WHERE product_id = $id";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result);

	$product = new stdClass();
	$product->image = '<a href="/'.$row['friendly_url'].'"><img src="'.$row['product_img'].'" alt="'.$row['product_name'].'" class="img-responsive"></a>';
	$product->text = '
                                <a href="/'.$row['friendly_url'].'" class="brand_mia">'.$action->getBrand($row['product_brand'])['name'].'</a>
                                <!--PERCENT-->
                                <span class="percent-mia">-'.number_format(($row['product_price']-$row['product_price_sale'])/$row['product_price']*100,0).'%</span>
                                <h2><a href="/there-are-many">'.$row['product_name'].'</a></h2>
                                <!--PRICE-->
                                <p class="prices_ruouvang">
								    <span class="prices_ruouvang-news">'.number_format($row['product_price_sale']).'đ</span>
								    <span class="prices_ruouvang-old"> '.number_format($row['product_price']).'đ</span>
								</p>';
	if ($row['product_gift_name'] != '') {
		$product->text .= '<!--GIFT-->
                                <div class="gb-gift-miavn">
								    <img src="/images/icons/gift-24.png" alt="" class="img-responsive">
								    <span>Tặng quà</span>
								</div>
                            ';
	}

	$product->mua = '<div class="gb-product_ruouvang-item-yeumua">
                                <!--MUA HÀNG-->
                                <button class="btn-muahang" onclick="load_url(\''.$row['product_img'].'\', \''.$row['friendly_url'].'\', \''.$row['product_id'].'\', \''.$row['product_name'].'\', \''.$row['product_price_sale'].'\')">Mua ngay</button>                            </div>';
                                
	echo json_encode($product);
?>