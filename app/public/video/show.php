<!--mandatory-->
<?php require_once("../layout/master.php"); ?>


<!--general (optional)-->
<?php //require_once(PUBLIC_PATH . "video/general.php"); ?>

<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/video/show.css"; ?>">

<!--components / main-->
<?php require_once(PUBLIC_PATH . "video/components/show/main.php"); ?>
<?php require_once(PUBLIC_PATH . "video/components/show/video-meta-details-container.php"); ?>


<!--extentional views-->
<?php require_once(PUBLIC_PATH . "video-user-playlists-plug-in/read.php"); ?>
<?php require_once(PUBLIC_PATH . "page-outline-plug-in/read.php"); ?>
<?php require_once(PUBLIC_PATH . "video-categories-plug-in/read.php"); ?>

<?php require_once(PUBLIC_PATH . "rate-status-plug-in/show.php"); ?>
<?php require_once(PUBLIC_PATH . "video-playlist-plug-in/show.php"); ?>
<?php require_once(PUBLIC_PATH . "comments-plug-in/read.php"); ?>
<?php require_once(PUBLIC_PATH . "video-recommendations-plug-in/read.php"); ?>


<!--js / main-->
<?php tryLoadingJsFilesFor("video", "show", ['tasks', 'event_listeners']); ?>
