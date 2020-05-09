<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<link rel="stylesheet" href="/plugin/animsition/css/animate.css">
<div class="gb-slideshow_ruouvang">
    <div class="container">
        <div class="gb-slideshow_ruouvang-slide owl-carousel owl-theme">
            <?php
            $list_slide = $action->getList('slide', '', '', 'id', 'asc', '', '', '');
            foreach ($list_slide as $key => $val) {
                    ?> 
            <div class="item">
                <a href="<?= $val['link'] ?>"><img src="/images/<?= $val['image']?>" alt="slideshow" class="img-responsive"></a>
            </div>
            <?php                            
                  }
            ?>   
        </div>
    </div>
</div>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-slideshow_ruouvang-slide').owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
            nav:true,
            dots: true,
            autoplay: true,
            rewind: true,
            navText:[],
            items:1,
            responsive:{
                0:{
                    nav:false
                },
                767:{
                    nav:true
                }
            }
        });
    });
</script>