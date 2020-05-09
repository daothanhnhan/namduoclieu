<!--MENU MOBILE-->
<?php include_once DIR_MENU."MS_MENU_MIA_0002.php"; ?>
<!-- End menu mobile-->
<style>

</style>
<!--MENU DESTOP-->
<header>
    <div class="gb-header-miavn">
        <div class="gb-top-header_ruouvang">
            <div class="header-info-top">
                <div class="container" style="">
                    <div class="hotline" style="">
                        <span class="glyphicon glyphicon-earphone"></span>
                        <span class="text" style="padding-left: 10px;">Hotline: <?= $rowConfig['content_home3'] ?></span>
                    </div>
                    <div class="menu-top" style="">
                        <ul>
                            <li><a href="/">Trang chủ</a></li>
                            <li><a href="/gioi-thieu">Giới thiệu</a></li>
                            <li><a href="/lien-he">Liên hệ</a></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-1 col-sm-4">
                        <div class="gb-top-header_ruouvang-left">
                            <h1>
                                <a href="/"><img src="/images/<?= $rowConfig['web_logo'] ?>" alt="logo" class="img-responsive" style="margin-bottom: 5px;"></a>
                            </h1>
                           <!--  <div class="gb-top-header-left-miavn-likeshare">
                                <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FValikeodulich.vn&width=135&layout=button_count&action=like&size=small&show_faces=true&share=true&height=46&appId=220693348668109" width="135" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="col-md-8 col-sm-8">
                        <div class="gb-top-header_ruouvang-right">
                            <img src="/images/vanchuyen.JPG" alt="" class="img-responsive">
                        </div>
                    </div> -->
                    <div class="col-md-8 col-sm-12">
                        <?php include DIR_MENU."MS_MENU_MIA_0004.php";?>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <?php include DIR_SEARCH."MS_SEARCH_MIA_0002.php";?>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container">
            <div class="gb-header-between_ruouvang">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <?php include DIR_MENU."MS_MENU_MIA_0004.php";?>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <?php include DIR_SEARCH."MS_SEARCH_MIA_0002.php";?>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</header>

<script src="/plugin/sticky/jquery.sticky.js"></script>
<script>
    $(document).ready(function () {
        $(".sticky-menu").sticky({topSpacing:0});
    });
</script>