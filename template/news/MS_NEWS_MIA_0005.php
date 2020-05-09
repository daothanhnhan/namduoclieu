<?php 
    $tintuc_slide = $action->getList('news_slide', '', '', 'id', 'asc', '', '', '');
    $tintuc_banner = $action->getList('news_banner', '', '', 'id', 'asc', '', '', '');
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
                        <?php foreach ($tintuc_slide as $item) { ?>
                        <div class="item">
                            <div class="gb-tinnongtrongngay_vaxin-big">
                                <div class="item-big_vaxin-img">
                                    <a href="/<?= $item['link'] ?>"><img src="/images/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="img-responsive"></a>
                                </div>
                                <div class="item-big_vaxin-text">
                                    <h3><a href="/<?= $item['link'] ?>"><?= $item['name'] ?></a></h3>
                                </div>
                            </div>
                        </div>
                        <?php 
                        } ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <?php 
                    foreach ($tintuc_banner as $item) { 
                    ?>
                    <div class="gb-tinnongtrongngay_vaxin-small">
                        <div class="item-big_vaxin-img">
                            <a href="/<?= $item['link'] ?>"><img src="/images/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="img-responsive"></a>
                        </div>
                        <div class="item-big_vaxin-text">
                            <h3><a href="/<?= $item['link'] ?>"><?= $item['name'] ?></a></h3>
                        </div>
                    </div>
                    <?php } ?>
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