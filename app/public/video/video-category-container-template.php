<div id="video-category-container-template" class="container-fluid cn-template">

    <h3 class="video-category-title">[Recommended for You]</h3>
    <hr>

    <div class="videos-sections row">

        <?php require_once(PUBLIC_PATH . "video/video-recommendation-item-template.php"); ?>

    </div>

    <div class="loader-container"></div>

    <button type="button" class="btn mx-auto btn-outline-info show-more-playlist-btn">show more</button>

</div>




<!--<style>-->
<!---->
<!--    #video-category-container-template .show-more-playlist-btn,-->
<!--    .video-category-containers .show-more-playlist-btn {-->
<!--        display: block;-->
<!--        /*padding-left: 300px;*/-->
<!--        /*padding-right: 300px;*/-->
<!--        width: 100%-->
<!--        margin-top: 50px;-->
<!--    }-->
<!---->
<!--    #video-category-container-template,-->
<!--    .video-category-containers {-->
<!--        padding: 30px 8%;-->
<!--        padding-bottom: 70px;-->
<!--    }-->
<!--</style>-->