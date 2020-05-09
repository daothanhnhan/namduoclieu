<?php 
    $sidebar_list_laptop = $action_product->sidebarListLaptop();
?>
<div class="gb-labelcheckbox-mia">
    <h3>Ngăn đựng laptop</h3>
    <ul>
        <?php 
        foreach ($sidebar_list_laptop as $item) { 
            $check = '';
            if (in_array($item['id'], $_SESSION['laptop_brand'])) {
                $check = "checked";
            }
        ?>
        <li>
            <input type="checkbox" onclick="laptop('<?= $item['id'] ?>')" <?= $check ?> > <span><?= $item['name'] ?></span>
        </li>
        <?php } ?>
    </ul>
</div>
<script>
    function laptop (id) {
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
          xhttp.open("GET", "/functions/ajax/laptop_brand.php?id="+id, true);
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