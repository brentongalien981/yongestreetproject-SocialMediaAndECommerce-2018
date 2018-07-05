$(window).scroll(function () {
    if (!getArePlaylistVideosShowing()) {

        /**/
        if (isScrollingPositionOkToShowMorePlaylistVideos()) {
            showPlaylistVideos();
        }
    }
});


function isScrollingPositionOkToShowMorePlaylistVideos() {

    // Boundaries of the sides of the reference.
    var referencForLoadingMoreObjs = $("#reference-for-loading-more-playlist-videos").get(0).getBoundingClientRect();

    var windowHeight = $(window).height();

    // // LOG:
    // cnLog("ref POS: " + referencForLoadingMoreObjs.top);

    if (referencForLoadingMoreObjs.top <= windowHeight) {
        return true
    }


    return false;
}