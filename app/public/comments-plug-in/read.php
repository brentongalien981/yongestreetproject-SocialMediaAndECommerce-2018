<!--external views (domains or menus or features)-->
<!--############################-->

<!--general (optional)-->
<?php //require_once(PUBLIC_PATH . "rate-status-plug-in/general.php"); ?>

<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/comments-plug-in/read.css"; ?>">


<!--templates / extentional-->
<?php //require_once(PUBLIC_PATH . "comments-plug-in/templates/read/comment-plug-in-item-template.php"); ?>

<!--templates / main-->
<?php require_once(PUBLIC_PATH . "comments-plug-in/templates/read/comment-plug-in-item-template.php"); ?>


<!--extentional views-->
<?php //require_once(PUBLIC_PATH . "video-user-playlists-plug-in/read.php"); ?>


<!--components / main-->
<?php require_once(PUBLIC_PATH . "comments-plug-in/components/read/comments-plug-in.php"); ?>
<?php require_once(PUBLIC_PATH . "comments-plug-in/components/read/main.php"); ?>


<!--js / extentional-->
<?php //tryLoadingJsFilesFor("rateable-item-user", "read", ['tasks', 'read', 'general_functions', 'update']); ?>


<!--js / main-->
<?php tryLoadingJsFilesFor("comments-plug-in", "read", ['tasks']); ?>