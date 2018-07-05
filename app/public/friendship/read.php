<!--templates-->
<?php require_once(PUBLIC_PATH . "friendship/friend-social-media-item.php"); ?>


<div id="connections-container">

    <div>
        <h3>Connections</h3>
    </div>


    <div id="connections-scrollbar">

        <div id="friend-item-holder">

            <div id="friend-item-template" class="cn-template m-5">


                <div class="friend-photo-container">
                    <img src="https://www.touristisrael.com/wp-content/uploads/justin-300x300.jpg">
                </div>


                <div class="friend-details-container">


                    <div class="friend-name-holder">
                        <h5 class="friend-name">Russel Westbrook @russ0</h5>
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
    }

    #connections-scrollbar {
        /*background-color: yellow;*/
        /*max-width: 1000px;*/
        overflow-x: auto;
    }

    #friend-item-holder {
        white-space: nowrap;
    }

    .friend-item {
        display: inline-block;
        box-shadow: 0 0 25px rgb(170, 170, 170);
    }

    .friend-item {
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