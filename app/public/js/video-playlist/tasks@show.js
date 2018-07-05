$(document).ready(function () {
    setPageTitle("Playlist | CuteNinjar");

    initPage();

    showPlaylistVideos();
});

function initPage() {
    initMainSections();
}


function initMainSections() {
    initCenterCol();
}

function initCenterCol() {

    //
    initVideoRecommendationItemTemplate();
    initVideoPlaylist();
    // initRateStatusPlugIn();

    //
    $("#the_body").append($("#main-content"));

    //
    $("#the_body").append($("footer"));

}

function initVideoPlaylist() {

    //
    $("#cn-center-col").append($("#video-playlist"));
}