<?php 
    // var_dump($_SESSION['color']);
?>
<style>
    .active-color {
        border: 3px solid #FFE4C4 !important;
    }
</style>
<div class="gb-labelcheckbox-mia_mausac">
    <h3>Màu sắc</h3>
    <ul><?php if (in_array(1, $_SESSION['color'])) {$check_color = 'class="active-color"';} else {$check_color = '';} ?>
        <li data-value="Blue" style="background-color: #0000ff" title="Blue" <?= $check_color ?> onclick="color(1)"></li>
        <?php if (in_array(2, $_SESSION['color'])) {$check_color = 'class="active-color"';} else {$check_color = '';} ?>
        <li data-value="Pink" style="background-color: #ff80c0" title="Pink" <?= $check_color ?> onclick="color(2)"></li>
        <?php if (in_array(3, $_SESSION['color'])) {$check_color = 'class="active-color"';} else {$check_color = '';} ?>
        <li data-value="Yellow" style="background-color: #ffff00" title="Yellow" <?= $check_color ?> onclick="color(3)"></li>
        <?php if (in_array(4, $_SESSION['color'])) {$check_color = 'class="active-color"';} else {$check_color = '';} ?>
        <li data-value="Grey" style="background-color: #cccccc" title="Grey" <?= $check_color ?> onclick="color(4)"></li>
        <?php if (in_array(5, $_SESSION['color'])) {$check_color = 'class="active-color"';} else {$check_color = '';} ?>
        <li data-value="Brown" style="background-color: #804040" title="Brown" <?= $check_color ?> onclick="color(5)"></li>
        <?php if (in_array(6, $_SESSION['color'])) {$check_color = 'class="active-color"';} else {$check_color = '';} ?>
        <li data-value="Orange" style="background-color: #ff8000" title="Orange" <?= $check_color ?> onclick="color(6)"></li>
        <?php if (in_array(7, $_SESSION['color'])) {$check_color = 'class="active-color"';} else {$check_color = '';} ?>
        <li data-value="Red" style="background-color: #df2828" title="Red" <?= $check_color ?> onclick="color(7)"></li>
        <?php if (in_array(8, $_SESSION['color'])) {$check_color = 'class="active-color"';} else {$check_color = '';} ?>
        <li data-value="Black" style="background-color: #000000" title="Black" <?= $check_color ?> onclick="color(8)"></li>
        <?php if (in_array(9, $_SESSION['color'])) {$check_color = 'class="active-color"';} else {$check_color = '';} ?>
        <li data-value="Green" style="background-color: #00ff40" title="Green" <?= $check_color ?> onclick="color(9)"></li>
        <?php if (in_array(10, $_SESSION['color'])) {$check_color = 'class="active-color"';} else {$check_color = '';} ?>
        <li data-value="White" style="background-color: #ffffff" title="White" <?= $check_color ?> onclick="color(10)"></li>
        <?php if (in_array(11, $_SESSION['color'])) {$check_color = 'class="active-color"';} else {$check_color = '';} ?>
        <li data-value="Purple" style="background-color: #8000ff" title="Purple" <?= $check_color ?> onclick="color(11)"></li>
    </ul>
</div>
<script>
    function color (id) {
        // alert(id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var out = this.responseText;
             // alert(out);
             // location.reload();
             // window.location.href = "/<?= $_GET['page'] ?>";
            }
          };
          xhttp.open("GET", "/functions/ajax/color.php?id="+id, true);
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