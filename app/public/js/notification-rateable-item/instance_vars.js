var isNotificationRateableItemReading = false;
var isNotificationRateableItemFetching = false;
var numOfFailedNotificationRateableItemAjaxRead = 0;
var hasNotificationRateableItemFetched = false;

function getHasNotificationRateableItemFetched() {
    return hasNotificationRateableItemFetched;
}

function setHasNotificationRateableItemFetched(value) {
    hasNotificationRateableItemFetched = value;
}

function getNumOfFailedNotificationRateableItemAjaxRead() {
    return numOfFailedNotificationRateableItemAjaxRead;
}

function setNumOfFailedNotificationRateableItemAjaxRead(value) {
    numOfFailedNotificationRateableItemAjaxRead = value;
}

function getIsNotificationRateableItemFetching() {
    return isNotificationRateableItemFetching;
}

function setIsNotificationRateableItemFetching(value) {
    isNotificationRateableItemFetching = value;
}

function getIsNotificationRateableItemReading() {
    return isNotificationRateableItemReading;
}

function setIsNotificationRateableItemReading(value) {
    isNotificationRateableItemReading = value;
}