<!--mandatory-->
<?php require_once("../layout/master.php"); ?>


<!--general (optional)-->
<?php //require_once(PUBLIC_PATH . "video-playlist/general.php"); ?>


<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/video-playlist/show.css"; ?>">


<!--templates / extentional-->
<?php require_once(PUBLIC_PATH . "video/templates/general/video-recommendation-item-template.php"); ?>


<!--components / main-->
<?php require_once(PUBLIC_PATH . "video-playlist/components/show/main.php"); ?>
<?php require_once(PUBLIC_PATH . "video-playlist/components/show/video-playlist.php"); ?>


<!--extentional views-->
<?php require_once(PUBLIC_PATH . "video/general.php"); ?>


<!--js / main-->
<?php tryLoadingJsFilesFor("video-playlist", "show", ['tasks', 'event_listeners']); ?>

<!--js / extentional-->
<?php tryLoadingSpecificJsFilesFor('video', ['general_functions']); ?>
