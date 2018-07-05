const READ_VIDEO_FOR_VIDEO_PLAYLIST_PLUG_IN = 2;


var isPlaylistShowing = false;
var numOfFailedPlaylistAjaxShow = 0;

function getIsPlaylistShowing() {
    return isPlaylistShowing;
}

function setIsPlaylistShowing(value) {
    isPlaylistShowing = value;
}

function getNumOfFailedPlaylistAjaxShow() {
    return numOfFailedPlaylistAjaxShow;
}

function setNumOfFailedPlaylistAjaxShow(value) {
    numOfFailedPlaylistAjaxShow = value;
}