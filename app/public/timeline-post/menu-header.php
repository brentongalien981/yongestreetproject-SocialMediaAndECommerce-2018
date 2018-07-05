<?php if ($session->is_logged_in()) { ?>
    <div id="cn-header" class="container-fluid">

        <div id="sub-menu" class="d-flex flex-row justify-content-center align-items-center">
            <a id="create_post_link" class="mx-3">+ Create Post</a>
            <a id="edit_post_link" class="mx-3">* Edit Post</a>

        </div>

        <div id="cn-header-pop-up" class="container-fluid animated">
            <?php require_once(PUBLIC_PATH . "timeline-post/create.php"); ?>
        </div>

    </div>
<?php } ?>