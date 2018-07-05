function showPlaylistVideos() {

    var isOkToProceed = doPreShowPlaylistVideos();

    if (!isOkToProceed) { return; }

    doRegularShowPlaylistVideos();
    doPostShowPlaylistVideos();
}

function doRegularShowPlaylistVideos() {

    // App extracts playlist-id from the url.
    var url = window.location.href;
    var playlistId = extractValueFromUrl(url, "id");

    //
    if (playlistId == false) { return; }

    var crud_type = "show";
    var request_type = "GET";
    var earliestElDate = getLimitDateOfDomElement("earliest", "video-recommendation-item");

    var videoIdsOfAlreadyShownPlaylistVideos = getVideoIdsOfAlreadyShownPlaylistVideos();
    var stringifiedVideoIdsOfAlreadyShownPlaylistVideos = cnStringify(videoIdsOfAlreadyShownPlaylistVideos);

    var key_value_pairs = {
        show: "yes",
        playlist_id: playlistId,
        earliest_el_date: earliestElDate,
        stringified_video_ids_of_already_shown_playlist_videos: stringifiedVideoIdsOfAlreadyShownPlaylistVideos,
        read_video_for_what: READ_VIDEO_FOR_VIDEO_PLAYLIST
    };



    var obj = new Playlist(crud_type, request_type, key_value_pairs);
    obj.show();

}

function getVideoIdsOfAlreadyShownPlaylistVideos() {

    var videoIdsOfAlreadyShownPlaylistVideos = [];

    var alreadyShownPlaylistVideos = $("#video-playlist").find(".video-recommendation-item");

    for (i = 0; i < alreadyShownPlaylistVideos.length; i++) {
        var currentVideoId = $(alreadyShownPlaylistVideos[i]).attr("video-id");

        videoIdsOfAlreadyShownPlaylistVideos[i] = currentVideoId;

    }

    return videoIdsOfAlreadyShownPlaylistVideos;
}

function doPreShowPlaylistVideos() {
    //
    if (getArePlaylistVideosShowing() || (getNumOfFailedPlaylistVideosAjaxShow() >= 3)) { return false; }
    setArePlaylistVideosShowing(true);

    return true;
}


function doPostShowPlaylistVideos() {}