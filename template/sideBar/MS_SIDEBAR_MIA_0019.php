<?php 
    $list_special = array(
        1 => 'Khóa khung',
        2 => 'Khóa kéo đôi chống rạch',
        3 => 'Siêu nhẹ',
        4 => 'Cố thể nới rộng',
        5 => 'Khóa 3 điểm',
        6 => 'Chống thấm nước',
        7 => 'Cân điện tử'
    );
    if ($rowCatLang['productcat_id'] == 141) {
        $dacbiet = 1;
    } else {
        $parent_id = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'], $lang)['productcat_parent'];
    }
?>

<div class="gb-labelcheckbox-mia">
    <h3>Tính năng đặc biệt</h3>
    <ul>
        <?php 
        foreach ($list_special as $key => $item) { 
            $check = '';
            if (in_array($key, $_SESSION['special'])) {
                $check = "checked";
            }
        ?>
        <li>
            <input type="checkbox" onclick="special(<?= $key ?>)" <?= $check ?> > <span><?= $item ?></span>
        </li>
        <?php } ?>
    </ul>
</div>

<script>
    function special (id) {
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
          xhttp.open("GET", "/functions/ajax/special.php?id="+id, true);
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