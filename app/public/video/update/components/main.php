<?php require_once(PUBLIC_PATH . "three-columned-page/index.php"); ?>


<main id="update-video-page-main" class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <?php require_once(PUBLIC_PATH . "video/update/components/videos-table.php"); ?>
        </div>

        <div class="col-md-7">
            <?php require_once(PUBLIC_PATH . "video/create/components/video-details-form.php"); ?>
        </div>
    </div>
</main>