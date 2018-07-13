<!--mandatory-->
<?php require_once(PUBLIC_PATH . 'layout/master-v3.php'); ?>



<!--css / extentional-->
<!--<link rel="stylesheet" type="text/css" href="--><?//= PUBLIC_LOCAL . "css/video-manager/index.css"; ?><!--">-->

<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= CN_URL_PUBLIC . "css/video/create/index.css"; ?>">



<!--templates / extentional-->

<!--templates / main-->



<!--extentional views-->
<?php require_once(PUBLIC_PATH . "video-user-playlists-plug-in-v2/read/index.php"); ?>
<?php require_once(PUBLIC_PATH . "video-categories-plug-in-v2/read/index.php"); ?>



<!--components / extentional-->

<!--components / main-->
<?php require_once(PUBLIC_PATH . "video/create/components/video-details-form.php"); ?>
<?php require_once(PUBLIC_PATH . "video/create/components/main.php"); ?>




<!--js / extentional-->

<!--js / main-->
<script src="<?= CN_URL_PUBLIC . "js/js-controllers/CreateVideoPageController.js"; ?>" type="module"></script>