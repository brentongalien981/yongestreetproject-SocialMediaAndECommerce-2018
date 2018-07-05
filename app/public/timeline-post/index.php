<!--mandatory-->
<?php require_once("../layout/master.php"); ?>

<!--css-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/timeline-post/index.css"; ?>">


<!--CN-Header-->
<?php require_once(PUBLIC_PATH . "timeline-post/menu-header.php"); ?>

<!--Main-->
<?php require_once(PUBLIC_PATH . "timeline-post/read.php"); ?>

<!--Templates-->
<?php require_once(PUBLIC_PATH . "rateable-item/templates/rate_bar.php"); ?>

<!--Extentional Menus-->
<!--Extentional: menu-->
<?php require_once(PUBLIC_PATH . "timeline-post-reply/index.php"); ?>
<!--Extentional: extra-->
<?php require_once(PUBLIC_PATH . "timeline-post/settings_pop_up_window.php"); ?>





<!-- *** SCRIPTS ***-->
<!--Main Scripts-->
<?php tryLoadingJsFilesFor("timeline-post"); ?>

<!--Extentional Scripts-->
<?php tryLoadingJsFilesFor("rateable-item"); ?>
<?php tryLoadingJsFilesFor("rateable-item-user"); ?>
<?php tryLoadingJsFilesFor("timeline-post-user-subscription"); ?>