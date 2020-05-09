<?php 
    $sidebar_procatid = array(141, 140, 139, 124);
    $home_procat = $action->getList('productcat', 'productcat_parent', '0', 'productcat_id', 'desc', '', '', '');
    $sidebar_procatid = array();
    foreach ($home_procat as $item_procat) {
        $sidebar_procatid[] = $item_procat['productcat_id'];
    }

    function active ($page, $link) {
        global $conn_vn;
        $action_product = new action_product();

        if ($page == $link) {
            return true;
        } else {
            $link_parent_item_lang = $action_product->getProductCatLangDetail_byUrl($page, 'vn');//echo $page;
            $link_parent_item = $action_product->getProductCatDetail_byId($link_parent_item_lang['productcat_id'], 'vn');
            $productcat_parent = $link_parent_item['productcat_parent'];//echo $productcat_parent;
            if ($productcat_parent == 0) {
                return false;
            } else {
                $link_parent = $action_product->getProductCatDetail_byId($productcat_parent, 'vn')['friendly_url'];//echo $link_parent;
                if ($link == $link_parent) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
?>
<div class="gb-danhmucsanpham_cuanhom widget-sidebar">
    <aside class="widget">
        <div class="widget-content">
            <div class="accordion-default">
                <ul class="accordion">
                    <?php 
                    foreach ($sidebar_procatid as $item) {
                        $procat = $action_product->getProductCatDetail_byId($item, $lang); 
                        $list_procat_sub = $action_product->getProductCat_byProductCatIdParent($item, 'desc');
                        $active_muc = active($_GET['page'], $procat['friendly_url']);
                    ?>
                    <li class="accordion-toggle <?= ($active_muc) ? 'active' : '' ?>" ><a href="/<?= $procat['friendly_url'] ?>"><?= $procat['productcat_name'] ?></a></li>
                    <ul class="accordion-content" style="display: <?= ($active_muc) ? 'block' : 'none' ?>">
                        <?php 
                        foreach ($list_procat_sub as $item_sub) { 
                        ?>
                        <li><a href="/<?= $item_sub['friendly_url'] ?>" style="color: <?= ($_GET['page']==$item_sub['friendly_url']) ? '#ff6600' : '' ?> "><?= $item_sub['productcat_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!--KÍCH THƯỚC-->
        <?php //include DIR_SIDEBAR."MS_SIDEBAR_MIA_0006.php";?>
        <!--THƯƠNG HIỆU-->
        <?php //include DIR_SIDEBAR."MS_SIDEBAR_MIA_0007.php";?>
        <!--CHẤT LIỆU-->
        <?php //include DIR_SIDEBAR."MS_SIDEBAR_MIA_0008.php";?>
        <!-- laptop -->
        <?php //include DIR_SIDEBAR."MS_SIDEBAR_MIA_0014.php";?>
        <!--Tính năng đặc biệt-->
        <?php //include DIR_SIDEBAR."MS_SIDEBAR_MIA_0009.php";?>
        <!--Gía tiền-->
        <?php include DIR_SIDEBAR."MS_SIDEBAR_MIA_0010.php";?>
        <!--MÀU SẮC-->
        <?php //include DIR_SIDEBAR."MS_SIDEBAR_MIA_0011.php";?>
    </aside>
</div>

<script>
    $(document).ready(function () {
        $('.accordion-default .accordion .accordion-toggle').on('click', function (e) {
            $(this).next().slideToggle('600');
            $(".accordion-content").not($(this).next()).slideUp('600');
            $(this).toggleClass('active').siblings().removeClass('active');
        });
    });
</script>