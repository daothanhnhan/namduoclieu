<?php   
    if (isset($_GET['slug']) && $_GET['slug'] != '') {
        $slug = $_GET['slug'];//echo 'tuan';die;                    
        $rowCatLang = $action_news->getNewsCatLangDetail_byUrl($slug,$lang);
        $rowCat = $action_news->getNewsCatDetail_byId($rowCatLang[$nameColIdNewsCat_newsCatLanguage],$lang);
        if (newsCatPageHasSub) {
            $rows = $action_news->getNewsList_byMultiLevel_orderNewsId($rowCat[$nameColId_newsCat],'desc',$trang,6,$slug);
        } else {
            $rows = $action_news->getNewsCat_byNewsCatIdParentHighest($rowCat[$nameColId_newsCat],'desc');//var_dump($rows);die;
        }        
    }
    else $rows = $action->getList($nameTable_news,'','',$nameColId_news,'desc',$trang,6,'tin-tuc'); 
    // var_dump($rows);die;
?>
<?php include DIR_BREADCRUMBS."MS_BREADCRUMS_MIA_0004.php";?>
<div class="gb-page-blog_ruouvang">
    <div class="container">
        <div class="row">
            <?php 
            $d = 0;
            foreach ($rows['data'] as $item) {
                $d++;
                $rowLang = $action_news->getNewsLangDetail_byId($item['news_id'],$lang); 
            ?>
            <div class="col-sm-4">
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
            <?php 
            if ($d%3==0) {
                echo '<hr style="width:100%;border:0;" />';
            }
            } ?>
        </div>
        <div style="text-align: center;"><?= $rows['paging'] ?></div>
    </div>
</div>