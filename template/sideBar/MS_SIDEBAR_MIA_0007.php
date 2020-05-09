<?php 
    $main_id = array(124, 139, 140, 141);

    function listBrand ($id) {
        global $conn_vn;
        if ($id == 141) {
            $sql = "SELECT * FROM brand WHERE category = 1";
        }
        if ($id == 140) {
            $sql = "SELECT * FROM brand WHERE category = 2";
        }
        if ($id == 139) {
            $sql = "SELECT * FROM brand WHERE category = 3";
        }
        if ($id == 124) {
            $sql = "SELECT * FROM brand WHERE category = 4";
        }
        $result = mysqli_query($conn_vn, $sql);
        $rows = array();
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    if (in_array($rowCatLang['productcat_id'], $main_id)) {
        $list_brand = listBrand($rowCatLang['productcat_id']);
    } else {
        $parent_id = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'], $lang)['productcat_parent'];
        $list_brand = listBrand($parent_id);
    }
    
    // var_dump($_SESSION['brand']);
?>
<div class="gb-labelcheckbox-mia">
    <h3>Thương hiệu</h3>
    <ul>
        <?php 
        foreach ($list_brand as $item) { 
            $check = '';
            if (in_array($item['id'], $_SESSION['brand'])) {
                $check = "checked";
            }
        ?>
        <li>
            <input type="checkbox" onclick="brand(<?= $item['id'] ?>)" <?= $check ?> > <span><?= $item['name'] ?></span>
        </li>
        <?php } ?>
    </ul>
</div>
<script>
    function brand (id) {
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
          xhttp.open("GET", "/functions/ajax/brand.php?id="+id, true);
          xhttp.send();

        setTimeout(function(){  
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var out = this.responseText;
             // alert(out);
             // location.reload();
             window.location.href = "/index.php?page=<?= $_GET['page'] ?>"+ out;
            }
          };
          xhttp.open("GET", "/functions/ajax/setlink.php?id="+id, true);
          xhttp.send();
        }, 100);
    }
</script>