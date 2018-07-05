<!--mandatory-->
<?php require_once("../layout/master.php"); ?>

<!--css-->
<!--<link rel="stylesheet" type="text/css" href="--><?//= PUBLIC_LOCAL . "css/my-photo/index.css"; ?><!--">-->


<!--CN-Header-->
<?php require_once(PUBLIC_PATH . "my-photo/menu-header.php"); ?>


<!--Main-->
<?php require_once(PUBLIC_PATH . "my-photo/read.php"); ?>
<?php require_once(PUBLIC_PATH . "my-photo/create.php"); ?>
<?php require_once(PUBLIC_PATH . "my-photo/update.php"); ?>


<!--Templates-->
<?php require_once(PUBLIC_PATH . "my-photo/solo-view-container.php"); ?>



<!--Extentional Menus-->



<!--Extentional: extra-->



<!--Main Scripts-->
<?php tryLoadingJsFilesFor("my-photo"); ?>


<!--Extentional Scripts-->
