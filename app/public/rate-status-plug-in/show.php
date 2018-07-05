<!--general (optional)-->
<?php //require_once(PUBLIC_PATH . "rate-status-plug-in/general.php"); ?>

<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/rate-status-plug-in/show.css"; ?>">


<!--templates / main-->
<?php require_once(PUBLIC_PATH . "rate-status-plug-in/templates/show/rate-status-container-template.php"); ?>


<!--components / main-->
<?php require_once(PUBLIC_PATH . "rate-status-plug-in/components/show/rate-options-pop-up.php"); ?>


<!--js / main-->
<?php tryLoadingJsFilesFor("rate-status-plug-in", "show", ['tasks']); ?>

<!--js / extentional-->
<?php tryLoadingJsFilesFor("rateable-item-user", "show", ['tasks', 'read', 'general_functions', 'update']); ?>

