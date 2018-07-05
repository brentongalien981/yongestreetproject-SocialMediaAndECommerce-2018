<?php if (!$session->is_logged_in()) { return; }?>

<div id="cn-sticky-bottom-container" class="cn-sticky-bottom fixed-bottom">
    <div class="cn-sticky-bottom-content d-flex align-items-end">

        <div id="view-toggle-btns-section" class="mr-auto">

            <button id="left-col-toggle-btn" type="button" is-activated="yes" class="btn btn-success col-toggle-btn">
                <i class="fa fa-align-left"></i>
            </button>

            <button id="center-col-toggle-btn" type="button" is-activated="yes" class="btn btn-success col-toggle-btn">
                <i class="fa fa-align-center"></i>
            </button>

            <button id="right-col-toggle-btn" type="button" is-activated="yes" class="btn btn-success col-toggle-btn">
                <i class="fa fa-align-right"></i>
            </button>

        </div>



        <div id="widgets-section"></div>

    </div>
</div>


<!--css-->
<style>

    #cn-sticky-bottom-container {
        margin: 10px;
        padding: 0;
        pointer-events: none;
    }

    #cn-sticky-bottom-container button {
        box-shadow: 0 0 15px rgb(120, 120, 120);
    }


    .col-toggle-btn,
    .widgets {
        pointer-events: auto;
    }

    #widgets-section {
        text-align: right;
        max-width: 900px;
    }

    #view-toggle-btns-section {
        /*display: none;*/
        /*visibility: hidden;*/

    }


    .btn:hover {
        cursor: pointer;
    }

    /*Hide the #toggle-view-section on sm breakpoint*/
    @media screen and (max-width: 1199px) {
        #view-toggle-btns-section {
            /*min-width: 150px;*/
            /*display: block;*/
            /*visibility: visible;*/

        }
    }

    .widgets {
        display: inline-block;
        vertical-align: bottom;
        text-align: left;
        background-color: white;
        /*margin-top: 10px;*/
        /*margin-left: 10px;*/
    }

    .widget-toggled-on {
        width: 100px;
        height: 100px;
        background: red;
        position: relative;
        -webkit-animation: toggleOnWidget 5s; /* Safari 4.0 - 8.0 */
        animation: toggleOnWidget 5s;
    }

    @keyframes toggleOnWidget {
        0% {width: 50px; height:50px}
        100% {width: 100px; height:70px}
    }


</style>


<!--js-->
<?php tryLoadingJsFilesFor("cn-sticky-bottom"); ?>


<!--Extentionals-->
<?php require_once(PUBLIC_PATH . "widget/index.php"); ?>
<?php require_once(PUBLIC_PATH . "notification/index.php"); ?>
<?php require_once(PUBLIC_PATH . "chat/index.php"); ?>