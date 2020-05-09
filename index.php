<?php
// phpinfo();die;
session_start();
ob_start();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$folder = dirname(__FILE__);
include_once('config.php');
include_once('__autoload.php');
$action = new action();
include_once dirname(__FILE__).DIR_FUNCTIONS."database.php";
// $urlAnalytic = $action->showabc();    
include_once dirname(__FILE__).DIR_FUNCTIONS_PAGING."pagination.php";
include_once 'functions/phpmailer/class.smtp.php';
include_once 'functions/phpmailer/class.phpmailer.php';
include_once "functions/vi_en.php";
// // LÀM RÕ NHỮNG THƯ VIỆN NÀY
// // include_once('lib/vi_en.php');
// // include_once('lib/nganLuong/NL_Checkoutv3.php');

// // LÀM RÕ Install Cart

// Install MultiLanguage
include_once dirname(__FILE__).DIR_FUNCTIONS_LANGUAGE."lang_config.php";
include_once dirname(__FILE__).DIR_FUNCTIONS_LANGUAGE.$lang_file;
// Install Friendly Url
include_once dirname(__FILE__).DIR_FUNCTIONS_URL."url_config.php";
// Configure Website
include_once dirname(__FILE__).DIR_FUNCTIONS."website_config.php";
// echo $translate['link_contact'];die;
$trang = isset($_GET['trang']) ? $_GET['trang'] : '1';
// $action = new action();
$cart = new action_cart();
$menu = new action_menu();
$action_product = new action_product();
$action_news = new action_news();
$action_page = new action_page();
$action_email = new action_email();
if($lang == "vn"){
    $rowConfig_lang = $action->getDetail('config_languages','id',1);
}else{
    $rowConfig_lang = $action->getDetail('config_languages','id',2);
}


$rowConfig = $action->getDetail('config','config_id',1);

$action_email->newletter();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?= $meta_des ?>"> 
    <meta name="keywords" content="<?= $meta_key ?>">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <meta name="google-site-verification" content="5jHYHUDXANv9zNQvnDpQvLkCLcY0Em4hUR-m2i4B0GM" />
    <title><?= $title ?></title>
    <link rel="icon" href="/images/<?= $rowConfig['icon_web'] ?>" type="image/gif" sizes="16x16">

    <link rel="stylesheet" href="/plugin/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/plugin/bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" href="/plugin/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style-miavn.css">
    <script src="/plugin/jquery/jquery-2.0.2.min.js"></script>
    <script src="/plugin/bootstrap/js/bootstrap.js"></script>
</head>

<body>
<?php include_once dirname(__FILE__).DIR_THEMES."header.php";?>

<div class="gb-content">
    <?php
    if (isset($_GET['page'])){

        $urlAnalytic = $action->getTypePage_byUrl($_GET['page'],$lang);
        // echo $urlAnalytic;
        switch ($urlAnalytic) {

            case 'newscat_languages':

                include_once dirname(__FILE__).DIR_THEMES."tintuc.php"; break;

            case 'news_languages':

                include_once dirname(__FILE__).DIR_THEMES."chitiettintuc.php"; break;
            case 'lien-he':

                include_once dirname(__FILE__).DIR_THEMES."lienhe.php"; break;

            case 'gio-hang':

                include_once dirname(__FILE__).DIR_THEMES."giohang.php"; break;

            case 'khuyen-mai':

                include_once dirname(__FILE__).DIR_THEMES."khuyenmai.php"; break;
            case 'san-pham':

                include_once dirname(__FILE__).DIR_THEMES."sanpham.php"; break;

            case 'productcat_languages':
                include_once dirname(__FILE__).DIR_THEMES."sanpham.php"; break;

            case 'sale':
                $title = "Sale";
                include_once dirname(__FILE__) . DIR_THEMES . "sale.php";break;

            case 'search-product':
                include_once dirname(__FILE__) . DIR_THEMES . "search-product.php";break;

            case 'brand':
                include_once dirname(__FILE__) . DIR_THEMES . "thuong-hieu.php";break;
                
            case 'hang-thanh-ly':

                include_once dirname(__FILE__).DIR_THEMES."hangthanhly.php"; break;

            case 'thanh-toan':

                include_once dirname(__FILE__).DIR_THEMES."thanhtoan.php"; break;
            case 'product_languages':

                include_once dirname(__FILE__).DIR_THEMES."chitietsanpham.php"; break;
            case 'huong-dan-dat-hang':

                include_once dirname(__FILE__).DIR_THEMES."huongdanmuahang.php"; break;
            case 'huong-dan-thanh-toan':

                include_once dirname(__FILE__).DIR_THEMES."cachthucthanhtoan.php"; break;

            case 'chinh-sach-van-chuyen':

                include_once dirname(__FILE__).DIR_THEMES."chinhsachvanchuyen.php"; break;
            case 'page_language':

                include_once dirname(__FILE__).DIR_THEMES."gioithieu.php"; break;
            case 'danh-muc-tin-tuc':

                include_once dirname(__FILE__).DIR_THEMES."danhmuctintuc.php"; break;
            // case 'gio-hang1':

            //     include_once dirname(__FILE__).DIR_THEMES."giohang.php"; break;

            // case 'test':
            //     include_once dirname(__FILE__) . DIR_THEMES . "test.php";break;

            // case 'city':
            //     include_once dirname(__FILE__) . DIR_THEMES . "city.php";break;

        }
    }
    else include_once dirname(__FILE__).DIR_THEMES."home.php";
    ?>
</div>


<?php include_once dirname(__FILE__).DIR_THEMES."footer.php"; ?>
<div class="gb-likeshare-fixed">
    <!-- <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FValikeodulich.vn&width=58&layout=box_count&action=like&size=small&show_faces=true&share=true&height=65&appId=220693348668109" width="58" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe> -->
</div>

<div id="share_us2">
	<div class="share_us2-img">
		<img src="/images/G2iSYip.png" alt="" class="img-responsive">
	</div>
	<div  class="share_us2-text">
		<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook&tabs=timeline&width=500&height=550&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=220693348668109" width="500" height="550" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
	</div>
    </div>

    <a href="tel:<?= $rowConfig['content_home3'] ?>" class="suntory-alo-phone suntory-alo-green" id="suntory-alo-phoneIcon" style="left: 0px; bottom: 0px;" datasqstyle="{&quot;top&quot;:null}" datasquuid="4c643075-c7e6-4adf-8841-746771cfb831" datasqtop="640">
  <div class="suntory-alo-ph-circle"></div>
  <div class="suntory-alo-ph-circle-fill"></div>
  <div class="suntory-alo-ph-img-circle"><i class="fa fa-phone" style="float: none;"></i></div>
</a>

<!-- BACKTOPTOP -->
<style>

#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  /*font-size: 18px;*/
  border: none;
  outline: none;
  /*background-color: red;*/
  color: white;
  cursor: pointer;
  /*padding: 15px;*/
  /*border-radius: 4px;*/
}

#myBtn:hover {
  /*background-color: #555;*/
}
</style>
<!-- <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button> -->
<div onclick="topFunction()" id="myBtn" title="Go to top"><img src="/images/icons/totop.png" alt=""></div>
<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  // document.body.scrollTop = 0;
  // document.documentElement.scrollTop = 0;
  $("html, body").animate({scrollTop: 0}, 1000);
}
</script>
<!-- end button top -->
</body>

</html>

