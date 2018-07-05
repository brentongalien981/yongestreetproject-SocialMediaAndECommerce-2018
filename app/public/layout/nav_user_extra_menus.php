<div class="dropdown">
    <a id="actual-user-options"
       class="nav-link dropdown-toggle"
       href="#"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false">
    </a>

    <div class="dropdown-menu"
         aria-labelledby="">


        <?php require_once(LAYOUT_PATH . "nav-site-logo.php"); ?>


        <?php if ($session->is_logged_in()) { ?>

            <a class="dropdown-item user-options"
               href="<?= LOCAL . 'app/request/request.php?menu=Login&action=delete'; ?>">
                <i class="fa fa-sign-out user-options-icon"></i>Log-out
            </a>

        <?php } else { ?>

            <a class="dropdown-item user-options"
               href="<?= PUBLIC_LOCAL . "log-in/index.php"; ?>">
                <i class="fa fa-sign-in user-options-icon"></i>Log-in
            </a>

            <a class="dropdown-item user-options"
               href="<?= PUBLIC_LOCAL . "sign-up/index.php"; ?>">
                <i class="fa fa-circle-thin user-options-icon"></i>Sign-up
            </a>

        <?php } ?>
    </div>
</div>



<style>

    a.user-options {
        /*width: 25px;*/
    }

    #actual-user-options {
        padding-left: 0;
    }

    .user-options-icon,
    #site-logo-nav-photo {
        width: 25px;
        font-size: 25px;
        margin-right: 5px;
    }

    /*#site-logo-nav-photo {*/
        /*width: 25px;*/
    /*}*/
</style>