const PHOTO_CONTAINER_WIDTH = 990;

var isPhotoReading = false;
var numOfFailedPhotoAjaxRead = 0;
var numOfNewlyDisplayedPhotos = 0;
var stackIndex = 0;
var photoContainerWidth = 990;

function getPhotoContainerWidth() {
    return photoContainerWidth;
}

function setPhotoContainerWidth() {
    var bodyWidth = $("#the_body").width();
    photoContainerWidth = bodyWidth * 0.6;

    $("#photo-main-container").width(photoContainerWidth);
}

function setStackIndex(value) {
    stackIndex = value;
}

function getStackIndex() {
    return parseInt(stackIndex);
}

function getNumOfNewlyDisplayedPhotos() {
    return parseInt(numOfNewlyDisplayedPhotos);
}

function setNumOfNewlyDisplayedPhotos(value) {
    numOfNewlyDisplayedPhotos = value;
}

function getIsPhotoReading() {
    return isPhotoReading;
}

function setIsPhotoReading(value) {
    isPhotoReading = value;
}

function getNumOfFailedPhotoAjaxRead() {
    return numOfFailedPhotoAjaxRead;
}

function setNumOfFailedPhotoAjaxRead(value) {
    numOfFailedPhotoAjaxRead = value;
}