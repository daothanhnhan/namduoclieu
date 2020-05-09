<style>
	
</style>
<nav class="gb-main-menu_miavn4" >
    <div class="main-navigation uni-menu-text_ldpvinhome menu-category">
        <div class="cssmenu">
            <?php 
                $list_menu = $menu->getListMainMenu_byOrderASC();
                // $menu->showMenu_byMultiLevel_mainMenuMia($list_menu,0,$lang,0);
                $menu->showMenu_byMultiLevel_mainMenuTraiCam($list_menu,0,$lang,0);
            ?>
        </div>
    </div>
</nav>