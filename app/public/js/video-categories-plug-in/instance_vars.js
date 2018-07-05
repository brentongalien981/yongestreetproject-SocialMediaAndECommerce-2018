var isCategoryReading = false;
var isCategoryFetching = false;
var numOfFailedCategoryAjaxRead = 0;
var hasCategoryInitializedFetching = false;
var userPlaylistIntervalFetchHandler = null;

function getIsCategoryFetching() {
    return isCategoryFetching;
}

function setIsCategoryFetching(value) {
    isCategoryFetching = value;
}

function setHasCategoryInitializedFetching(value) {
    hasCategoryInitializedFetching = value;
}

function getHasCategoryInitializedFetching() {
    return hasCategoryInitializedFetching;
}

function getIsCategoryReading() {
    return isCategoryReading;
}

function setIsCategoryReading(value) {
    isCategoryReading = value;
}

function getNumOfFailedCategoryAjaxRead() {
    return numOfFailedCategoryAjaxRead;
}

function setNumOfFailedCategoryAjaxRead(value) {
    numOfFailedCategoryAjaxRead = value;
}

