<!--mandatory-->
<?php require_once(PUBLIC_PATH . 'layout/master-v3.php'); ?>



<!--css / extentional-->

<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= CN_URL_PUBLIC . "css/my-store/index/index.css"; ?>">



<!--templates / extentional-->

<!--templates / main-->



<!--extentional views-->
<?php require_once(PUBLIC_PATH . "store-manager-plug-in/index/index.php"); ?>



<!--components / extentional-->
<?php require_once(PUBLIC_PATH . "three-columned-page/index.php"); ?>

<!--components / main-->
<?php require_once(PUBLIC_PATH . "my-store/index/components/main.php"); ?>




<!--js / extentional-->

<!--js / main-->
<script src="<?= CN_URL_PUBLIC . "js/js-controllers/MyStorePageController.js"; ?>" type="module"></script>