<?php 
    // var_dump($_SESSION['price']);
?>
<div class="gb-labelcheckbox-mia">
    <h3>Giá tiền</h3>
    <ul>
        <li>
            <?php 
            if (in_array('0-500000', $_SESSION['price'])) {
                $check_gia = "checked";
            } else {
                $check_gia = "";
            }
            ?>
            <input type="checkbox" onclick="price('0-500000')" <?= $check_gia ?> > <span>Dưới 500,000đ</span>
        </li>
        <li>
            <?php 
            if (in_array('500000-1000000', $_SESSION['price'])) {
                $check_gia = "checked";
            } else {
                $check_gia = "";
            }
            ?>
            <input type="checkbox" onclick="price('500000-1000000')" <?= $check_gia ?> > <span>Từ 500,000đ - 1,000,000đ</span>
        </li>
        <li>
            <?php 
            if (in_array('1000000-2000000', $_SESSION['price'])) {
                $check_gia = "checked";
            } else {
                $check_gia = "";
            }
            ?>
            <input type="checkbox" onclick="price('1000000-2000000')" <?= $check_gia ?> > <span>Từ 1,000,000đ - 2,000,000đ</span>
        </li>
        <li>
            <?php 
            if (in_array('2000000-3000000', $_SESSION['price'])) {
                $check_gia = "checked";
            } else {
                $check_gia = "";
            }
            ?>
            <input type="checkbox" onclick="price('2000000-3000000')" <?= $check_gia ?> > <span>Từ 2,000,000đ - 3,000,000đ</span>
        </li>
        <li>
            <?php 
            if (in_array('3000000-0', $_SESSION['price'])) {
                $check_gia = "checked";
            } else {
                $check_gia = "";
            }
            ?>
            <input type="checkbox" onclick="price('3000000-0')" <?= $check_gia ?> > <span>Trên 3,000,000 đ</span>
        </li>
    </ul>
</div>
<script>
    function price (gia) {
        // alert(gia);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var out = this.responseText;
             // alert(out);
             // location.reload();
             // window.location.href = "/<?= $_GET['page'] ?>";
            }
          };
          xhttp.open("GET", "/functions/ajax/price.php?gia="+gia, true);
          xhttp.send();

        setTimeout(function(){  
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var out = this.responseText;
             // alert(out);
             // location.reload();
             window.location.href = "/index.php?page=brand&search=<?= $_GET['search'] ?>"+ out;
            }
          };
          xhttp.open("GET", "/functions/ajax/setlink_brand.php", true);
          xhttp.send();
        }, 100);
    }
</script>