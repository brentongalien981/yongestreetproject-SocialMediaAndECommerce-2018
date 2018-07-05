<!--general (optional)-->
<?php //require_once(PUBLIC_PATH . "rate-status-plug-in/general.php"); ?>

<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/video-playlist-plug-in/show.css"; ?>">


<!--templates / extentional-->
<?php require_once(PUBLIC_PATH . "video/templates/general/video-recommendation-item-template.php"); ?>

<!--templates / main-->
<?php //require_once(PUBLIC_PATH . "video/templates/general/video-recommendation-item-template.php"); ?>



<!--components / main-->
<?php require_once(PUBLIC_PATH . "video-playlist-plug-in/components/show/video-playlist-plug-in.php"); ?>


<!--js / main-->
<?php tryLoadingJsFilesFor("video-playlist-plug-in", "show", ['tasks', 'event_listeners']); ?>

<!--js / extentional-->
<?php //tryLoadingJsFilesFor("rateable-item-user", "show", ['tasks', 'read', 'general_functions', 'update']); ?>


