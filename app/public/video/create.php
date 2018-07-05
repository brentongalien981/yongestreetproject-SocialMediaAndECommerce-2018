<!--mandatory-->
<?php require_once("../layout/master-v2.php"); ?>



<!--css / extentional-->
<!--<link rel="stylesheet" type="text/css" href="--><?//= PUBLIC_LOCAL . "css/video-manager/index.css"; ?><!--">-->

<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/video/create.css"; ?>">



<!--templates / extentional-->

<!--templates / main-->



<!--extentional views-->
<?php require_once(PUBLIC_PATH . "video-user-playlists-plug-in/read.php"); ?>
<?php require_once(PUBLIC_PATH . "page-outline-plug-in/read.php"); ?>
<?php require_once(PUBLIC_PATH . "video-categories-plug-in/read.php"); ?>



<!--components / extentional-->

<!--components / main-->
<?php require_once(PUBLIC_PATH . "video/create/components/video-details-form.php"); ?>
<?php require_once(PUBLIC_PATH . "video/create/components/main.php"); ?>




<!--js / extentional-->

<!--js / main-->
<?php tryLoadingScriptFor("video", "tasks@create", true); ?>