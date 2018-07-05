var isUserPlaylistReading = false;
var isUserPlaylistFetching = false;
var numOfFailedUserPlaylistAjaxRead = 0;
var hasUserPlaylistInitializedFetching = false;
var userPlaylistIntervalFetchHandler = null;

function getIsUserPlaylistFetching() {
    return isUserPlaylistFetching;
}

function setIsUserPlaylistFetching(value) {
    isUserPlaylistFetching = value;
}

function setHasUserPlaylistInitializedFetching(value) {
    hasUserPlaylistInitializedFetching = value;
}

function getHasUserPlaylistInitializedFetching() {
    return hasUserPlaylistInitializedFetching;
}

function getIsUserPlaylistReading() {
    return isUserPlaylistReading;
}

function setIsUserPlaylistReading(value) {
    isUserPlaylistReading = value;
}

function getNumOfFailedUserPlaylistAjaxRead() {
    return numOfFailedUserPlaylistAjaxRead;
}

function setNumOfFailedUserPlaylistAjaxRead(value) {
    numOfFailedUserPlaylistAjaxRead = value;
}

