<?php //for ($i = 0; $i < 6; $i++) { ?>
<div id="video-recommendation-item-template" class="col-md-4 col-sm-6 cn-template">
    <!--    <div id="video-recommendation-item-template" class="col col-md-4 col-sm-4">-->


    <div class="video-thumbnail-containers">

        <div class="video-thumbnails">
            <!--            https://www.youtube.com/embed/FESJlsKeYGo-->
            <iframe src="" encrypted-media" frameborder="0"></iframe>
        </div>

        <a href="https://www.facebook.com" target="_blank" class="video-thumbnail-masks"></a>
    </div>

    <div class="video-thumbnail-details-containers">
        <a href="#cn" class="video-thumbnail-titles">Shaqtin' a fool</a>
        <a href="#cn" class="video-thumbnail-poster-user-names">Shaquille O'neal</a>
    </div>


</div>
<?php //} ?>

<style>
    #video-recommendation-item-template {
        /* min-width: 150px; */
        /*background-color: orange;*/
        /*min-height: 200px; */
        /* Should be the min-height of a youtube video. */
        /*padding: 0 10px;*/
        /*border: 1px solid gray;*/
    }

    .video-thumbnail-containers {
        margin-top: 40px;
        width: 90%;
    }

    .video-thumbnails {
        /*background-color: green;*/
        /*min-height: 150px;*/
    }

    .video-thumbnails > iframe {
        width: 100%;
        /*height = width * 0.5625*/
        height: 100%;
        /*height: 250px;*/
        /*width: -webkit-fill-available;*/
    }

    .video-thumbnail-details-containers {
        /*background-color: blue;*/
    }

    .video-thumbnail-details-containers a {
        display: block;
        color: black;
    }

    a.video-thumbnail-titles {
        font-size: 110%;
    }

    a.video-thumbnail-poster-user-names {
        font-size: 90%;
        font-weight: 100;
    }

    a.video-thumbnail-masks {
        /* width: 90%; */
        /*height: 187.989px;*/
        width: 100%;
        height: 100%;
        background-color: goldenrod;
        opacity: 0;
        /*margin-top: -187.989px;*/
        position: relative;
        display: block;
    }
</style>