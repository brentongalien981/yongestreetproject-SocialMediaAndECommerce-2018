<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/layout/nav.css"; ?>">

<!--<nav id="the-navbar" class="navbar navbar-expand-xl sticky-top navbar-dark bg-dark">-->
<nav id="the-navbar" class="navbar navbar-expand-xl navbar-light bg-light sticky-top">
    <a id="the-navbar-brand"
       class="navbar-brand"
       data-toggle="tooltip"
       data-placement="bottom"
       title="Go to My Timeline"
       href="<?= PUBLIC_LOCAL . 'user/index.php' ?>">

        <?php $actualUserId = (isset(\App\Model\Session::getInstance()->actual_user_id)) ? \App\Model\Session::getInstance()->actual_user_id : -69; ?>
        <img id="home-profile-img" src="<?= b_get_profile_pic_src($actualUserId); ?>"
             class="rounded">
    </a>


    <!--    user-extra-menus-->
    <?php require_once(LAYOUT_PATH . "nav_user_extra_menus.php"); ?>


    <!--    nav_search_bar-->
    <?php require_once(LAYOUT_PATH . "nav_search_bar.php"); ?>


    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
            data-target="#cn-navbar-menu"
            aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="navbar-collapse collapse" id="cn-navbar-menu" style="">
        <!--        <ul class="nav navbar-nav ml-auto w-100 justify-content-end">-->
        <ul class="nav navbar-nav ml-auto justify-content-end">

            <!--    For the timeline icon.-->
            <?php if (\App\Model\Session::getInstance()->is_logged_in()) { ?>
                <li class="nav-item active"
                    data-toggle="tooltip"
                    data-placement="bottom"
                    title="Timeline">


                    <a id="menu_wall" class='menus nav-link' href="<?= PUBLIC_LOCAL . "timeline-post/index.php" ?>">
                        <i class="fa fa-thumb-tack"></i>
                    </a>

                </li>
            <?php } ?>


            <!--#######################################-->
            <!--    Beta-Profile    -->
            <!--#######################################-->
            <?php if (\App\Model\Session::getInstance()->is_logged_in()) { ?>
                <li class="nav-item"
                    data-toggle="tooltip"
                    data-placement="bottom"
                    title="Profile">

                    <a id="menu_profile"
                       class='menus nav-link'
                       href="<?= PUBLIC_LOCAL . 'profile/index.php' ?>">
                        <?php show_user_home_icon(\App\Model\Session::getInstance()->currently_viewed_user_id, "icon", "profile") ?>
                        <span class="sr-only">(current)</span>
                    </a>

                </li>
            <?php } ?>


            <!--Photos-->
            <li class="nav-item dropdown"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Photos">
                <a class="nav-link menus menus_with_sub_menus dropdown-toggle"
                   href="<?= PUBLIC_LOCAL . 'photo/index.php' ?>"
                   id="menu_photos"
                   menu_name="photo"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    <i class="fa fa-instagram"
                       style="color: purple;">
                    </i>
                </a>
                <div class="dropdown-menu dropdown-menu-right"
                     aria-labelledby="photo-dropdown-toggle">
                    <a id="menu_photos"
                       class="dropdown-item menus sub_menu_links"
                       href="<?= PUBLIC_LOCAL . 'photo/index.php'; ?>">
                        <i class="fa fa-fire"></i>
                        Trending
                    </a>

                    <?php if (\App\Model\Session::getInstance()->is_logged_in()) { ?>
                        <a id="menu_my_photos"
                           class="dropdown-item menus sub_menu_links"
                           href="<?= PUBLIC_LOCAL . 'my-photo/index.php'; ?>">
                            <i class="fa fa-camera"></i>
                            MyPhotos
                        </a>
                    <?php } ?>
                </div>
            </li>


            <!--Videos-->
            <?php require_once(PUBLIC_PATH . "layout/nav-videos.php"); ?>


            <!--Ads-->
            <li class="nav-item"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Ads">
                <?php if (\App\Model\Session::getInstance()->is_logged_in() && \App\Model\Session::getInstance()->is_viewing_own_account()) { ?>
                    <a id="menu_my_ads" class='menus nav-link'
                       href="<?= LOCAL . "/public/__view/view_my_ads/index.php" ?>">
                        <i class="fa fa-buysellads"></i>
                        <span class="sr-only">(current)</span>
                    </a>
                <?php } ?>
            </li>


            <!--MyBusiness-->
            <?php require_once(PUBLIC_PATH . "layout/nav-business.php"); ?>


            <!--TODO: New cart-->
            <!--TODO: Put this in the user-home-icon pop-up options-->
            <?php if (\App\Model\Session::getInstance()->is_logged_in() && \App\Model\Session::getInstance()->is_viewing_own_account()) { ?>
                <li class="nav-item"
                    data-toggle="tooltip"
                    data-placement="bottom"
                    title="MyCart">
                    <a id="menu_my_ads" class='menus nav-link'
                       href="<?= LOCAL . "/public/__view/store_carts/index.php" ?>">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            <?php } ?>


            <!--TODO: Refund-->
            <!--TODO: Put this in the user-home-icon pop-up options-->
            <!--            --><?php //if (\App\Model\Session::getInstance()->is_logged_in() && \App\Model\Session::getInstance()->is_viewing_own_account()) { ?>
            <!--                <li class="nav-item">-->
            <!--                    <a id="menu_my_ads" class='menus nav-link'-->
            <!--                       href="--><? //= LOCAL . "/public/__view/store_carts/index.php" ?><!--">-->
            <!--                        <i class="fa fa-shopping-cart"></i>-->
            <!--                        <span class="sr-only">(current)</span>-->
            <!--                    </a>-->
            <!--                </li>-->
            <!--            --><?php //} ?>


            <!--AdminTools-->
            <?php if (\App\Model\Session::getInstance()->is_logged_in() && \App\Model\Session::getInstance()->is_viewing_own_account() && \App\Model\Session::getInstance()->is_admin()) { ?>

                <li class="nav-item dropdown"
                    data-toggle="tooltip"
                    data-placement="bottom"
                    title="AdminTools">
                    <a id="menu_admin_tools"
                       class="nav-link menus menus_with_sub_menus dropdown-toggle"
                       href="<?= LOCAL . "/public/__view/admin_tools/index.php" ?>"
                       menu_name="admin_tools"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fa fa-id-card"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right"
                         aria-labelledby="admin-dropdown-toggle">

                        <a id="admin_tools_sub_menu"
                           class="dropdown-item menus sub_menu_links"
                           href="<?= LOCAL . "/public/__view/admin_tools/user_management/index.php"; ?>">

                            <i class="	fa fa-user-secret"></i>
                            User Management
                        </a>
                    </div>
                </li>

            <?php } ?>


        </ul>

    </div>


    <?php //require_once(LAYOUT_PATH . "nav-page-actions.php"); ?>

</nav>


<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>