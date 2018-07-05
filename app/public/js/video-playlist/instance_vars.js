const READ_VIDEO_FOR_VIDEO_PLAYLIST = 1;

var arePlaylistVideosShowing = false;
var numOfFailedPlaylistVideosAjaxShow = 0;

function getArePlaylistVideosShowing() {
    return arePlaylistVideosShowing;
}

function setArePlaylistVideosShowing(value) {
    arePlaylistVideosShowing = value;
}

function getNumOfFailedPlaylistVideosAjaxShow() {
    return numOfFailedPlaylistVideosAjaxShow;
}

function setNumOfFailedPlaylistVideosAjaxShow(value) {
    numOfFailedPlaylistVideosAjaxShow = value;
}