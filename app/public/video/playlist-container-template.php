<div id="playlist-container-template">

    <h5 class="playlist-container-title">[My Playlists]</h5>
    <hr>

    <a class="playlist-title" href="#cn">[Playlist 1]</a>
    <a class="playlist-title" href="#cn">[Playlist 2]</a>
    <a class="playlist-title" href="#cn">[My Guitar Covers]</a>

    <button type="button" class="btn btn-outline-info btn-sm show-more-playlist-btn">show more</button>
    <button type="button" class="btn btn-outline-info btn-sm show-less-playlist-btn">show less</button>

</div>



<style>
    div#playlist-container-template,
    .playlist-container {
        margin: 30px 10px;
        padding: 0 10px;
    }

    a.playlist-title {
        display: block;
        color: black;
        font-size: 80%;
        font-weight: 100;
    }

    #playlists-container button {
        margin-top: 20px;
    }


</style>