<!--external views (domains or menus or features)-->
<!--############################-->

<!--general (optional)-->
<?php //require_once(PUBLIC_PATH . "video-recommendations-plug-in/general.php"); ?>


<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/video-recommendations-plug-in/read.css"; ?>">


<!--templates / extentional-->
<?php require_once(PUBLIC_PATH . "video/templates/general/video-recommendation-item-template.php"); ?>

<!--templates / main-->
<?php //require_once(PUBLIC_PATH . "video-recommendations-plug-in/templates/general/video-recommendation-item-template.php"); ?>


<!--components / extentional-->
<?php //require_once(PUBLIC_PATH . "video-playlist-plug-in/components/show/video-playlist-plug-in.php"); ?>

<!--components / main-->
<?php require_once(PUBLIC_PATH . "video-recommendations-plug-in/components/read/video-recommendations-plug-in.php"); ?>
<?php require_once(PUBLIC_PATH . "video-recommendations-plug-in/components/read/main.php"); ?>


<!--js / extentional-->
<!--Only uncomment this if these files haven't been loaded in the DOM.-->
<?php //tryLoadingSpecificJsFilesFor('video', ['general_functions', 'Video']); ?>

<!--js / main-->
<?php tryLoadingJsFilesFor("video-recommendations-plug-in", "read", ['tasks', 'event_listeners']); ?>
