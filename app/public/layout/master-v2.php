<?php //require_once __DIR__ . '/../../../vendor/autoload.php'; ?>
<?php require_once __DIR__ . '/../../request/request.php'; ?>


<!doctype html>
<html lang="en">
<head>
    <title id="title">Bootstrapped FatBoy</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!--#################################################################-->
    <!--#################################################################-->
    <!--EARLY-BIND CSS/JS DEPENDENCIES-->
    <!--#################################################################-->
    <!--offline css/js dependencies.-->
    <?php require_once(PUBLIC_PATH . "cn-dependencies/offline.php"); ?>
    <!--#################################################################-->
    <!--online css/js dependencies.-->
    <!--        --><?php //require_once(PUBLIC_PATH . "cn-dependencies/online.php"); ?>
    <!--#################################################################-->
    <!--agnostic css/js dependencies.-->
    <?php require_once(PUBLIC_PATH . "cn-dependencies/agnostic.php"); ?>
    <!--#################################################################-->
    <!--#################################################################-->


    <!-- master -->
    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_LOCAL . "css/layout/master.css"; ?>">


    <?php require_once(JS_PATH . "layout/mcn_core_js_scripts.php"); ?>
</head>
<body id="the_body">


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<!--#################################################################-->
<!--#################################################################-->
<!--Late-bind css/js dependencies-->
<!--#################################################################-->
<!--late-bind-offline css/js dependencies.-->
<?php require_once(PUBLIC_PATH . "cn-dependencies/late-bind-offline.php"); ?>
<!--#################################################################-->
<!--late-bind-online css/js dependencies.-->
<?php //require_once(PUBLIC_PATH . "cn-dependencies/late-bind-online.php"); ?>
<!--#################################################################-->
<!--late-bind-agnostic css/js dependencies.-->
<?php require_once(PUBLIC_PATH . "cn-dependencies/late-bind-agnostic-v2.php"); ?>
<!--#################################################################-->
<!--#################################################################-->


<!--nav-->
<?php require_once(LAYOUT_PATH . "nav.php"); ?>


<!-- elements_for_updating_session_user_attribs -->
<?php require_once(LAYOUT_PATH . "elements_for_updating_session_user_attribs.php"); ?>


<!-- Script for updating the session-user-attributes. -->
<!--TODO: When you're finalizing the "Chat", refactor this updating -->
<!--TODO: of the session-attributes just like what you did in dawesdental.-->
<?php //require_once(JS_PATH . "layout/mcn_core_js_scripts2.php"); ?>

<!--mcn-loader-el-->
<?php require_once(LAYOUT_PATH . "general_loader_el.php"); ?>

<!--cn-sticky-bottom-->
<?php require_once(LAYOUT_PATH . "cn-sticky-bottom.php"); ?>

<!--footer-->
<?php require_once(LAYOUT_PATH . "footer.php"); ?>


</body>
</html>


<!--Main scripts-->
<!--TODO: Put this in js/layout/master/index.php.-->
<script src="<?= PUBLIC_LOCAL . "js/layout/tasks.js"; ?>"></script>
