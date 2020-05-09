<?php 
    $newscat_list = $action_news->getNewsCat_byNewsCatIdParent(0, 'desc');
?>
<div class="gb-newscategory-vaxin">
    <div class="row">
        <?php 
        foreach ($newscat_list as $item) { 
            $row = $action_news->getNewsList_byMultiLevel_orderNewsId($item['newscat_id'],'desc',1,3,'')['data'];
            $count = count($row);
        ?>
        <div class="col-sm-6">
            <div class="gb-newscategory-vaxin-item">
                <div class="gb-newscategory-vaxin-title">
                    <h2><a href="/<?= $item['friendly_url'] ?>"><?= $item['newscat_name'] ?></a></h2>
                </div>
                <?php if ($count > 0) { ?>
                <div class="gb-newscategory-vaxin-big">
                    <div class="itemimg-newscategory-vaxin">
                        <a href="/<?= $row[0]['friendly_url'] ?>"><img src="/images/<?= $row[0]['news_img'] ?>" alt="<?= $row[0]['news_name'] ?>" class="img-responsive"></a>
                    </div>
                    <div class="itemtext-newscategory-vaxin">
                        <h3><a href="/<?= $row[0]['friendly_url'] ?>"><?= $row[0]['news_name'] ?></a></h3>
                        <div class="item-time_vaxin"><i class="fa fa-eye" aria-hidden="true"></i> <?= $row[0]['news_views'] ?></div>
                        <p>
                            <?= $row[0]['news_des'] ?>
                        </p>
                    </div>
                </div>
                <?php } ?>
                <?php if ($count > 1) { ?>
                <div class="gb-newscategory-vaxin-small">
                    <ul>
                        <?php 
                        unset($row[0]);
                        foreach ($row as $item_sub) { 
                        ?>
                        <li>
                            <div class="item_tintucslideshow_vaxin">
                                <div class="item-img_vaxin">
                                    <a href="/<?= $item_sub['friendly_url'] ?>"><img src="/images/<?= $item_sub['news_img'] ?>" alt="<?= $item_sub['news_name'] ?>" class="img-responsive"></a>
                                </div>
                                <div class="item-text_vaxin">
                                    <h3><a href="/<?= $item_sub['friendly_url'] ?>"><?= $item_sub['news_name'] ?></a></h3>
                                    <div class="item-time_vaxin"><i class="fa fa-eye" aria-hidden="true"></i> <?= $item_sub['news_views'] ?></div>
                                    <p>
                                        <?= $item_sub['news_des'] ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>