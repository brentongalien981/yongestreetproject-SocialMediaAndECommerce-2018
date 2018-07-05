<!--mandatory-->
<?php require_once("../layout/master.php"); ?>


<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/video-manager/index.css"; ?>">


<!--templates / extentional-->

<!--templates / main-->
<?php require_once(PUBLIC_PATH . "video-manager/templates/index/itemx-managing-section-pseudo-btn-template.php"); ?>
<?php require_once(PUBLIC_PATH . "video-manager/templates/index/itemx-managing-section-template.php"); ?>


<!--components / extentional-->

<!--components / main-->
<?php require_once(PUBLIC_PATH . "video-manager/components/index/main.php"); ?>


<!--extentional views-->
<?php require_once(PUBLIC_PATH . "video-user-playlists-plug-in/read.php"); ?>
<?php require_once(PUBLIC_PATH . "page-outline-plug-in/read.php"); ?>
<?php require_once(PUBLIC_PATH . "video-categories-plug-in/read.php"); ?>



<!--js / extentional-->

<!--js / main-->
<?php tryLoadingSpecificJsFilesFor("cn-components", ["ItemxManagingSectionPseudoBtnTemplate", "ItemxManagingSectionTemplate"]); ?>
<?php tryLoadingJsFilesFor("video-manager", "index", ['tasks', 'event_listeners']); ?>
