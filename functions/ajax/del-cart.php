<?php 	
	session_start();
	$id = $_GET['id'];
	foreach($_SESSION["shopping_cart"] as $keys => $values)  
            {  
	              if($_SESSION["shopping_cart"][$keys]['product_id'] == $id)  
	              {  
	              	unset($_SESSION["shopping_cart"][$keys]);
	              }  
            }  
?>

                <?php 
                $total = 0;
                foreach ($_SESSION['shopping_cart'] as $item) { 
                    $total += $item['product_quantity']*$item['product_price'];
                ?>
                <div class="col-xs-12 product-wrapper">
                    <div data-id="4783" class="product-detail row">
                        <a href="javascript:void(0)">
                            <div style="background:url('<?= $item['product_img'] ?>')" class="image col-xs-3">
                                <span data-id="4783" class="btn-remove-item-cart">
                                    <img src="/images/icons/i-close.png" onclick="remove_cart(<?= $item['product_id'] ?>)">
                                </span>
                            </div>
                        </a>
                        <div class="info col-xs-9">
                            <div class="col-xs-7 product-info">
                                <a href="/<?= $item['product_link'] ?>" class="product-title"><?= $item['product_name'] ?></a>
                                <div class="product-discount hidden">
                                    <span>- Giảm thêm 5% khi mua bộ 2 vali</span>
                                    <span>- Giảm thêm 10% khi mua bộ 3 vali</span>
                                </div>
                            </div>
                            <div class="col-xs-5 product-price">
                                <div class="col-sm-6 col-xs-12 quantity-select">
                                    <input type="number" min="1" value="<?= $item['product_quantity'] ?>" masp="<?= $item['product_id'] ?>" onchange="edit_num(this)" onkeyup="edit_num(this)" class="form-control">
                                </div>
                                <div class="col-sm-6 col-xs-12 price">
                                    <span class="main-price orange"><?= number_format($item['product_quantity']*$item['product_price']) ?>đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="col-xs-12 total">
                    <input type="hidden" name="total_money" value="100000">
                    <div style="margin-bottom: 15px;" class="clearfix">
                        <div class="col-xs-6 total-name">Tổng tiền:</div>
                        <div class="col-xs-6 total-amount orange"><?= number_format($total) ?>đ</div>
                    </div>
                    <div style="margin-bottom: 15px;" class="clearfix use-coupon hidden">
                        <div style="font-size: 16px;" class="col-xs-6 total-name">Sử dụng mã giảm giá
                            <label style="position: relative;top: -1px;margin-right: 5px;" class="label label-success"></label>
                            <span class="btn-cancel-coupon red">(Hủy):</span>
                        </div>
                        <div style="font-size: 16px;" class="col-xs-6 total-amount orange"></div>
                    </div>
                    <div style="margin-bottom: 15px;" class="clearfix final-money hidden">
                        <div class="col-xs-6 total-name">Cần thanh toán:</div>
                        <div class="col-xs-6 total-amount orange">100,000đ</div>
                    </div>
                    <!-- <div class="col-xs-12 text-right discount">
                        <p class="btn-show-input">Sử dụng mã giảm giá</p>
                        <p class="input-coupon">
                            <input placeholder="Nhập mã giảm giá" name="voucher" class="form-control">
                            <a class="btn btn-primary btn-apply-coupon">Áp dụng</a>
                        </p>
                        <p class="message hidden red"></p>
                    </div> -->
                </div>