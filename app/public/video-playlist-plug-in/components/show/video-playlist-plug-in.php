<div id="video-playlist-plug-in" class="initially-hidden-el container-fluid row">

    <div id="#video-playlist-plug-in-shell" class="col-10 mx-auto">

        <div id="video-playlist-plug-in-header">

            <a class="video-playlist-items-container-title">[My 90’s Favorites]</a>

            <button id="show-playlist-items-btn" type="button" class="btn btn-sm btn-outline-dark">show</button>

            <button id="hide-playlist-items-btn" type="button" class="btn btn-sm btn-outline-dark">hide</button>

        </div>


        <div class="video-recommendation-items-container row animated fadeIn"></div>


        <button id="show-more-playlist-videos-btn" type="button" class="btn btn-outline-light">show more videos</button>

    </div>


</div>



<style>
    #video-playlist-plug-in {
        background-color: rgb(70, 70, 70);
        padding-top: 80px;
        padding-bottom: 100px;
        /*visibility: hidden;*/
    }

    #video-playlist-plug-in * {
        color: rgb(220, 220, 220);
        /*font-weight: 100;*/
    }

    #video-playlist-plug-in-shell {
        /*background-color: lawngreen;*/
    }

    #video-playlist-plug-in-header h4,
    #video-playlist-plug-in-header .video-playlist-items-container-title {
        display: inline-block;
        font-weight: 100;
        margin-right: 20px;
        font-size: 140%;
    }

    #video-playlist-plug-in button {
        font-weight: 100;
    }

    #show-more-playlist-videos-btn {
        width: 100%;
        margin-top: 50px;
    }
</style>