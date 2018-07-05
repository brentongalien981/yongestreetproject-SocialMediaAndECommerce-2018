<?php if ($session->is_logged_in()) { ?>
    <div id="cn-header" class="container-fluid">

        <div id="sub-menu" class="d-flex flex-row justify-content-center align-items-center">
            <a id="TODO_create_post_link" class="mx-3">+ Create Photo</a>
            <a id="TODO_edit_post_link" class="mx-3">* Edit Photo</a>

        </div>

        <div id="cn-header-pop-up" class="container-fluid animated">
            <?php require_once(PUBLIC_PATH . "photo/create.php"); ?>
        </div>

    </div>
<?php } ?>