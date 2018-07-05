<!--external views (domains or menus or features)-->
<!--############################-->


<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/video-categories-plug-in/read.css"; ?>">


<!--templates / extentional-->
<?php //require_once(PUBLIC_PATH . "comments-plug-in/templates/read/comment-plug-in-item-template.php"); ?>

<!--templates / main-->
<?php //require_once(PUBLIC_PATH . "comments-plug-in/templates/read/comment-plug-in-item-template.php"); ?>



<!--components / main-->
<?php require_once(PUBLIC_PATH . "video-categories-plug-in/components/read/video-categories-plug-in.php"); ?>


<!--js / extentional-->
<?php //tryLoadingJsFilesFor("rateable-item-user", "read", ['tasks', 'read', 'general_functions', 'update']); ?>


<!--js / main-->
<?php tryLoadingJsFilesFor("video-categories-plug-in", "read", ['tasks', 'event_listeners']); ?>