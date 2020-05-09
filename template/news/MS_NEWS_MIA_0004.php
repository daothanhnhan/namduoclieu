<?php 
    $home_post_new = $action_news->getListNewsNew_hasLimit(4);
?>
<div class="gb-thongtinhuuich_ruouvang">
    <div class="gb-tieubieu-product_ruouvang-title">
        <b></b>
        <h3>Tin tức</h3>
        <b></b>
    </div>
    <div class="container">
        <div class="row">
            <?php 
            foreach ($home_post_new as $item) { 
                $rowLang = $action_news->getNewsLangDetail_byId($item['news_id'],$lang); 
            ?>
            <div class="col-sm-3">
                <div class="gb-news-blog_ruouvang-item">
                    <div class="gb-news-blog_ruouvang-item-img">
                        <a href="/<?= $rowLang['friendly_url'] ?>"><img src="/images/<?= $item['news_img'] ?>" alt="<?= $rowLang['lang_news_name'] ?>" class="img-responsive"></a>
                    </div>
                    <div class="gb-news-blog_ruouvang-item-text">
                        <div class="gb-news-blog_ruouvang-item-title">
                            <h3><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_news_name'] ?></a></h3>
                        </div>
                        <div class="gb-news-blog_ruouvang-item-text-des">
                            <p><?= $rowLang['lang_news_des'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>