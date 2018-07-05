<!--mandatory-->
<?php //require_once("../layout/master.php"); ?>


<!--general (optional)-->
<?php //require_once(PUBLIC_PATH . "video/general.php"); ?>

<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/video/read.css"; ?>">


<!--components / main-->
<?php require_once(PUBLIC_PATH . "video/components/read/main.php"); ?>


<!--extentional views-->
<?php require_once(PUBLIC_PATH . "video-user-playlists-plug-in/read.php"); ?>
<?php require_once(PUBLIC_PATH . "page-outline-plug-in/read.php"); ?>


<!--js / main-->
<?php //tryLoadingJsFilesFor("video", "read", ['tasks', 'event_listeners']); ?>
