<?php 
    $main_id = array(124, 139, 140, 141);

    function listSize ($id) {
        global $conn_vn;
        if ($id == 141) {
            $sql = "SELECT * FROM size WHERE size_cat = 1";
        }
        if ($id == 140) {
            $sql = "SELECT * FROM size WHERE size_cat = 2";
        }
        if ($id == 139) {
            $sql = "SELECT * FROM size WHERE size_cat = 3";
        }
        if ($id == 124) {
            $sql = "SELECT * FROM size WHERE size_cat = 4";
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
        $list_size = listSize($rowCatLang['productcat_id']);
    } else {
        $parent_id = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'], $lang)['productcat_parent'];
        $list_size = listSize($parent_id);
    }
    
    // var_dump($_SESSION['brand']);
?>
<div class="gb-labelcheckbox-mia">
    <h3>Kích thước</h3>
    <ul>
        <?php 
        foreach ($list_size as $item) { 
            $check = '';
            if (in_array($item['size_id'], $_SESSION['size'])) {
                $check = "checked";
            }
        ?>
        <li>
            <input type="checkbox" onclick="sizef(<?= $item['size_id'] ?>)" <?= $check ?> > <span><?= $item['size_name'] ?></span>
        </li>
        <?php } ?>
    </ul>
</div>
<script>
    function sizef (id) {
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
          xhttp.open("GET", "/functions/ajax/size.php?id="+id, true);
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