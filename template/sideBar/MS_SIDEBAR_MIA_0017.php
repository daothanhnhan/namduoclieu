<?php 
    $sidebar_list_material = $action_product->sidebarListMaterial();
?>
<div class="gb-labelcheckbox-mia">
    <h3>Chất liệu</h3>
    <ul>
        <?php 
        foreach ($sidebar_list_material as $item) { 
            $check = '';
            if (in_array($item['id'], $_SESSION['material_brand'])) {
                $check = "checked";
            }
        ?>
        <li>
            <input type="checkbox" onclick="material('<?= $item['id'] ?>')" <?= $check ?> > <span><?= $item['name'] ?></span>
        </li>
        <?php } ?>
    </ul>
</div>
<script>
    function material (id) {
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
          xhttp.open("GET", "/functions/ajax/material_brand.php?id="+id, true);
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