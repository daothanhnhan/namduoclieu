<?php 
    $post_new = $action_news->getNewsList_byMultiLevel_orderNewsId('','desc',1,7,'')['data'];
    $post_new_count = count($post_new);
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<link rel="stylesheet" href="/plugin/animsition/css/animate.css">
<div class="gb-tinnongtrongngay_vaxin">
    <div class="container">
        <div class="gb-tinnongtrongngay_vaxin-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="gb-tinnongtrongngay_vaxin-big-slide owl-carousel owl-theme">
                        <?php
                        $d = 0; 
                        foreach ($post_new as $k => $item) {
                            $rowLang = $action_news->getNewsLangDetail_byId($item['news_id'],$lang);
                            $d++;
                            if ($d == 6) {
                                break;
                            }
                        ?>
                        <div class="item">
                            <div class="gb-tinnongtrongngay_vaxin-big">
                                <div class="item-big_vaxin-img">
                                    <a href="/<?= $rowLang['friendly_url'] ?>"><img src="/images/<?= $item['news_img'] ?>" alt="<?= $rowLang['lang_news_name'] ?>" class="img-responsive"></a>
                                </div>
                                <div class="item-big_vaxin-text">
                                    <h3><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_news_name'] ?></a></h3>
                                </div>
                            </div>
                        </div>
                        <?php 
                        unset($post_new[$k]);
                        } ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <?php 
                    if ($post_new_count > 5) {
                        foreach ($post_new as $item) {  
                            $rowLang = $action_news->getNewsLangDetail_byId($item['news_id'],$lang);
                    ?>
                    <div class="gb-tinnongtrongngay_vaxin-small">
                        <div class="item-big_vaxin-img">
                            <a href="/<?= $rowLang['friendly_url'] ?>"><img src="/images/<?= $item['news_img'] ?>" alt="<?= $rowLang['lang_news_name'] ?>" class="img-responsive"></a>
                        </div>
                        <div class="item-big_vaxin-text">
                            <h3><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_news_name'] ?></a></h3>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-tinnongtrongngay_vaxin-big-slide').owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
            nav:false,
            dots: false,
            autoplay: true,
            rewind: true,
            navText:[],
            items:1,
        });
    });
</script>