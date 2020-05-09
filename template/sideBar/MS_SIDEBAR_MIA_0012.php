<?php 
    $sidebar_news_hot = $action_news->getListNewsHot_hasLimit(8);
?>
<div class="gb-danhmuctintuc-sidebar-miavn widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-miavn">Sụ kiện nổi bật</h3>
        <div class="widget-content">
            <div class="gb-blog-left-recent-posts_ruouvang">
                <ul>
                    <?php 
                    foreach ($sidebar_news_hot as $item) { 
                        $rowLang = $action_news->getNewsLangDetail_byId($item['news_id'],$lang); 
                    ?>
                    <li>
                        <div class="gb-item-recent-posts_ruouvang">
                            <div class="gb-item-recent-posts_ruouvang-img">
                                <a href="/<?= $rowLang['friendly_url'] ?>"><img src="/images/<?= $item['news_img'] ?>" alt="<?= $rowLang['lang_news_name'] ?>"></a>
                            </div>
                            <div class="gb-item-recent-posts_ruouvang-text">
                                <h2><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_news_name'] ?></a></h2>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </aside>
</div>