<?php require_once(PUBLIC_PATH . "notification/read.php"); ?>
<?php require_once(PUBLIC_PATH . "notification/x_notification_item_template.php"); ?>

<!--Try loading scripts.-->
<?php tryLoadingJsFilesFor("notification"); ?>


<!--Extentionals-->
<?php require_once(PUBLIC_PATH . "notification-rateable-item/index.php"); ?>
<?php tryLoadingJsFilesFor("notification-timeline-post-reply"); ?>