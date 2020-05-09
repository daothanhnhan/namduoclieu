<?php 
    $sidebar_post_new = $action_news->getListNewsNew_hasLimit(4);
?>
<div class="gb-recenpost-sidebar-miavn widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-miavn">Tin tức về du lịch</h3>
        <div class="widget-content">
            <div class="gb-blog-left-recent-posts_ruouvang">
                <ul>
                    <?php 
                    foreach ($sidebar_post_new as $item) { 
                        $rowLang = $action_news->getNewsLangDetail_byId($item['news_id'],$lang); 
                    ?>
                    <li>
                        <div class="gb-item-recent-posts_ruouvang">
                            <div class="gb-item-recent-posts_ruouvang-img">
                                <a href="/<?= $rowLang['friendly_url'] ?>"><img src="/images/<?= $item['news_img'] ?>" alt="<?= $rowLang['lang_news_name'] ?>"></a>
                            </div>
                            <div class="gb-item-recent-posts_ruouvang-text">
                                <h2><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_news_name'] ?></a></h2>
                                <div class="gb-item-recent-post-time_ruouvang">
                                    <a href="/<?= $rowLang['friendly_url'] ?>">Chi tiết <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </aside>
</div>