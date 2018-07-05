<!--external views (domains or menus or features)-->
<!--############################-->


<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/page-outline-plug-in/read.css"; ?>">


<!--templates / extentional-->
<?php //require_once(PUBLIC_PATH . "comments-plug-in/templates/read/comment-plug-in-item-template.php"); ?>

<!--templates / main-->
<?php //require_once(PUBLIC_PATH . "comments-plug-in/templates/read/comment-plug-in-item-template.php"); ?>



<!--components / main-->
<?php require_once(PUBLIC_PATH . "page-outline-plug-in/components/read/page-outline-plug-in.php"); ?>


<!--js / extentional-->
<?php //tryLoadingJsFilesFor("rateable-item-user", "read", ['tasks', 'read', 'general_functions', 'update']); ?>


<!--js / main-->
<?php tryLoadingJsFilesFor("page-outline-plug-in", "read", ['tasks', 'event_listeners']); ?>