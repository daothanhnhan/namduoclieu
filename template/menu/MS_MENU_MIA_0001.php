<nav class="gb-main-menu_ldpvinhome" >
    <div class="main-navigation uni-menu-text_ldpvinhome">
        <div class="cssmenu">
            
            <?php 
                $list_menu = $menu->getListMainMenu_byOrderASC();
                $menu->showMenu_byMultiLevel_mainMenuMia($list_menu,0,$lang,0);
            ?>
        </div>
    </div>
</nav>