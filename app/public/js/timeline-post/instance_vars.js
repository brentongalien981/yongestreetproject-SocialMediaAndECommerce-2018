var can_timeline_posts_fetch = true;
var timeline_posts_fetch_handler = null;
var tpspw_mouseout_handler = null;

var isTimelinePostReading = false;
var isTimelinePostFetching = false;
var numOfFailedAjaxRead = 0;
var maxNumOfObjsPerAjaxRead = 5;

var hasTimelinePostFetched = false;

function getHasTimelinePostFetched() {
    return hasTimelinePostFetched;
}

function setHasTimelinePostFetched(value) {
    hasTimelinePostFetched = value;
}

function getIsTimelinePostFetching() {
    return isTimelinePostFetching;
}

function setIsTimelinePostFetching(value) {
    isTimelinePostFetching = value;
}

function getNummOfFailedAjaxRead() {
    return numOfFailedAjaxRead;
}

function setNumOfFailedAjaxRead(value) {
    numOfFailedAjaxRead = value;
}

function getMaxNumOfObjsPerAjaxRead() {
    return maxNumOfObjsPerAjaxRead;
}

function getIsTimelinePostReading() {
    return isTimelinePostReading;
}

function setIsTimelinePostReading(value) {
    isTimelinePostReading = value;
}
