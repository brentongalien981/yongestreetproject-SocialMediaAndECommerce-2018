<li class="nav-item"
    data-toggle="tooltip"
    data-placement="bottom"
    title="Videos">

    <a class="nav-link menus menus_with_sub_menus dropdown-toggle"
       href="<?= PUBLIC_LOCAL . 'video/index.php' ?>"
       id="menu_videos"
       menu_name="video"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false">
        <i class="fa fa-youtube-play"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right"
         aria-labelledby="photo-dropdown-toggle">

        <a id="menu_videos"
           class="dropdown-item menus sub_menu_links"
           href="<?= PUBLIC_LOCAL . 'video/index.php'; ?>">
            <i class="fa fa-youtube-play"></i>
            CuteVideos
        </a>

        <?php if ($session->is_logged_in()) { ?>
            <a id="menu_video_manager"
               class="dropdown-item menus sub_menu_links"
               href="<?= PUBLIC_LOCAL . 'video-manager/index.php'; ?>">
                <i class="fa fa-video-camera"></i>
                VideoManager
            </a>
        <?php } ?>
    </div>

</li>