<?php 
    $list_news_relative = $action_news->getListNewsRelate_byIdCat_hasLimit($row['newscat_id'], 6);//var_dump($list_news_ralative);
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<link rel="stylesheet" href="/plugin/animsition/css/animate.css">
<div class="gb-tintuc-lienquan">
    <h3 class="gb-tintuc-lienquan-title">Bài viết liên quan</h3>
    <div class="gb-tintuc-lienquan-postlist owl-carousel owl-theme">
        <?php 
        foreach ($list_news_relative as $item) {
            $rowLang = $action_news->getNewsLangDetail_byId($item['news_id'],$lang);
        ?>
        <div class="item">
            <div class="gb-newscategory-vaxin-big">
                <div class="itemimg-newscategory-vaxin">
                    <a href="/<?= $rowLang['friendly_url'] ?>"><img src="/images/<?= $item['news_img'] ?>" alt="<?= $rowLang['lang_news_name'] ?>" class="img-responsive"></a>
                </div>
                <div class="itemtext-newscategory-vaxin">
                    <h3><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_news_name'] ?></a></h3>
                    <div class="item-time_vaxin"><i class="fa fa-eye" aria-hidden="true"></i> <?= $item['news_views'] ?></div>
                    <p>
                        <?= $rowLang['lang_news_des'] ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-tintuc-lienquan-postlist').owlCarousel({
            loop:true,
            margin:30,
            navSpeed:500,
            nav:true,
            dots: false,
            autoplay: true,
            rewind: true,
            navText:[],
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                767:{
                    items:4,
                    nav:true
                }
            }
        });
    });
</script>