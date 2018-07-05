var isCommentReading = false;
var isCommentFetching = false;
var numOfFailedCommentAjaxRead = 0;
var hasCommentInitializedFetching = false;
var commentIntervalFetchHandler = null;

function getIsCommentFetching() {
    return isCommentFetching;
}

function setIsCommentFetching(value) {
    isCommentFetching = value;
}

function setHasCommentInitializedFetching(value) {
    hasCommentInitializedFetching = value;
}

function getHasCommentInitializedFetching() {
    return hasCommentInitializedFetching;
}

function getIsCommentReading() {
    return isCommentReading;
}

function setIsCommentReading(value) {
    isCommentReading = value;
}

function getNumOfFailedCommentAjaxRead() {
    return numOfFailedCommentAjaxRead;
}

function setNumOfFailedCommentAjaxRead(value) {
    numOfFailedCommentAjaxRead = value;
}

