<?php 
    $list_city = $action->getList('city', '', '', 'id', 'asc', '', '', '');
    $list_district = $action->getList('district', 'city_id', '1', 'id', 'asc', '', '', '');
    // var_dump($_SESSION['shopping_cart']);
    // unset($_SESSION['shopping_cart']);
// payment1() in header.php
    
?>
<div class="container">
    <div class="main-wrapper clearfix">
        <div id="checkout-cart" class="container checkout">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="checkout-title">
                    <div class="col-xs-12 cart">GIỎ HÀNG</div>
                    <div class="clearfix"></div>
                </div>
                <div id="gio-hang-mia">
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
                </div>
                <div class="col-xs-12 col-sm-12 customer-wrapper">
                    <form action="" method="post" class="customer-info clearfix">
                        <div class="row">
                            <div class="col-xs-6 name">
                                <input name="name_cart" placeholder="Họ và Tên" required="" class="form-control error">
                            </div>
                            <div class="col-xs-6 phone">
                                <input type="number" name="phone" placeholder="Số điện thoại" required="" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 region">
                                <select name="region" class="form-control" onchange="getDistrict(this)" required>
                                    <option value="" selected="" disabled="">Tỉnh/thành phố</option>
                                    <?php foreach ($list_city as $item) { ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-6 subregion">
                                <select name="subregion" class="form-control" id="district">
                                    <?php foreach ($list_district as $item) { ?>
                                    <option data-price="40000" value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 address">
                                <input name="address" placeholder="Địa chỉ giao hàng, Ví dụ: Chung cư Lexington, LD.17-11 67 Mai Chí Thọ, Q2, HCM" required="" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 purchase">
                                <button class="btn btn-order btn-checkout">
                                    <span class="main">THANH TOÁN KHI NHẬN HÀNG</span>
                                    <span class="sub">(Xem hàng trước, không mua không sao)</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function cart (id) {
        // alert(id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var output = this.responseText;
                // alert(output);
                document.getElementById("update-orders-product").innerHTML = output;
            }
          };
          xhttp.open("GET", "/functions/ajax/add-cart.php?id="+id, true);
          xhttp.send();
    }

    function edit_num (data) {
        // alert(data.getAttribute("masp"));
        var id = data.getAttribute("masp");
        var quantity = data.value;
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var output = this.responseText;
                // alert(output);
                document.getElementById("gio-hang-mia").innerHTML = output;
            }
          };
          xhttp.open("GET", "/functions/ajax/edit-cart.php?id="+id+"&quantity="+quantity, true);
          xhttp.send();
    }

    function remove_cart (id) {
        // alert(id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var output = this.responseText;
                // alert(output);
                document.getElementById("gio-hang-mia").innerHTML = output;
            }
          };
          xhttp.open("GET", "/functions/ajax/del-cart.php?id="+id, true);
          xhttp.send();
    }
</script>
<script>
    function getDistrict (data) {
        // alert(data.value);
        var city = data.value;
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var output = this.responseText;
                // alert(output);
                document.getElementById("district").innerHTML = output;
            }
          };
          xhttp.open("GET", "/functions/ajax/district.php?city="+city, true);
          xhttp.send();
    }
</script>