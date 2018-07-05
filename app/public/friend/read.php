<!--templates-->
<?php require_once(PUBLIC_PATH . "friend/friend-social-media-item.php"); ?>


<!--<div id="connections-container">-->
<div id="connections-container" class="profile-main-item">


<!--    <div id="connections-header">-->
<!---->
<!--        <h3>Connections</h3>-->
<!--        <hr>-->
<!---->
<!--    </div>-->



    <div class="row justify-content-center">

        <div class="col-11">

            <h2 class="profile-header-title">Connections</h2>

            <a href="#TODO"><i class="fa fa-eye profile-header-icon"></i></a>

            <hr>

        </div>

    </div>



    <div id="connections-scrollbar" class="actual-content">

        <div id="friend-item-holder">

            <div id="friend-item-template" class="cn-template">


                <div class="friend-photo-container">
                    <img src="">
                </div>


                <div class="friend-details-container">


                    <div class="friend-name-holder">
                        <a class="friend-name" href="<?= PUBLIC_LOCAL . "profile/index.php?user_name="?>">Russel Westbrook @russ0</a>
                    </div>


                    <div class="friend-social-media-holder">

                        <!--                <button type="button" class="btn btn-outline-dark"><i class="fa fa-globe"></i></button>-->
                        <!---->
                        <!--                <button type="button" class="btn btn-outline-dark"><i class="fa fa-comments-o"></i></button>-->
                        <!---->
                        <!--                <button type="button" class="btn btn-outline-dark"><i class="fa fa-twitter"></i></button>-->
                        <!---->
                        <!--                <button type="button" class="btn btn-outline-dark"><i class="fa fa-facebook-square"></i></button>-->
                        <!---->
                        <!--                <button type="button" class="btn btn-outline-dark"><i class="fa fa-snapchat"></i></button>-->
                        <!---->
                        <!--                <button type="button" class="btn btn-outline-dark"><i class="fa fa-instagram"></i></button>-->
                        <!---->
                        <!--                <button type="button" class="btn btn-outline-dark"><i class="fa fa-linkedin"></i></button>-->

                    </div>


                    <div class="friend-action-btns-holder">
                        <button class="add-friend-btn btn btn-info">add friend</button>
                        <button class="unfriend-btn btn btn-warning">unfriend</button>
                    </div>


                </div>


            </div>

        </div>

    </div>

</div>


<style>

    #connections-container {
        background-color: white;
        /*padding-top: 50px;*/
        padding-bottom: 0;
    }

    #connections-header {
        /*margin: 0 48px;*/
    }

    #connections-scrollbar {
        /*background-color: yellow;*/
        /*max-width: 1000px;*/
        overflow-x: auto;
        padding-bottom: 150px;
    }

    #friend-item-holder {
        white-space: nowrap;
    }


    .friend-item {
        display: inline-block;
        margin-left: 80px;
        margin-right: 40px;
        box-shadow: 0 0 30px rgb(150, 150, 150);
        background-color: white;
        /*padding: 1%;*/
        border-radius: 5px;
        width: 640px;
    }

    .friend-photo-container img {
        width: 200px;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .friend-item > div {
        display: inline-block;
        /*background-color: darkseagreen;*/
    }

    .friend-details-container {
        vertical-align: top;
        padding: 20px 10px;
        padding-left: 30px;
        padding-bottom: 0;
    }

    .friend-details-container > div {
        /*margin: 15px;*/
        margin-bottom: 25px;
        /*background-color: lightpink;*/
    }

    /*.friend-social-media-item {*/
    /*display: inline-block;*/
    /*border: 1px solid brown;*/
    /*padding: 3px 7px;*/
    /*text-align: center;*/
    /*border-radius: 8px;*!*/
    /*}*/

    .friend-item i {
        font-size: 150%;
    }
</style>