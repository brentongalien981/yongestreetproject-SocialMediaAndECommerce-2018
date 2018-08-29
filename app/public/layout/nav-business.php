<?php if (!\App\Model\Session::getInstance()->is_logged_in()) return; ?>

<li class="nav-item dropdown" data-toggle="tooltip" data-placement="bottom" title="Business">

    <a class="nav-link menus menus_with_sub_menus dropdown-toggle" id="menu-business" menu-name="business" data-toggle="dropdown"
        href=""
        aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bitcoin"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="admin-dropdown-toggle">

        <a id="menu-earth-store" class="dropdown-item menus sub_menu_links" href="#">
            <i class="fa fa-globe"></i>Earth Store</a>

        <a id="menu-user-store" class="dropdown-item menus sub_menu_links" href="<?= PUBLIC_LOCAL . 'my-store/'; ?>">

            <?php $storeTitle = (\App\Model\Session::getInstance()->is_viewing_own_account()) ? 'My Store' :  \App\Model\Session::getInstance()->currently_viewed_user_name . "'s Store"; ?>

            <i class="fa fa-user-circle"></i><?=$storeTitle?></a>

        <a id="menu-store-manager" class="dropdown-item menus sub_menu_links" 
            href="<?= PUBLIC_LOCAL . 'store-manager/'; ?>">
            <i class="fa fa-bar-chart"></i>Store Manager</a>

    </div>
</li>
