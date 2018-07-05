function readRateableItemNotificationObjs() {

    //
    if (getIsNotificationRateableItemReading() || (getNumOfFailedNotificationRateableItemAjaxRead() >= 3)) { return; }
    setIsNotificationRateableItemReading(true);

    // //
    // setLoaderEl("notification-widget-container", "Loading notification rateable items...");

    // Set the loader element.
    var clonedLoaderElSuffixId = "notification-rateable-item";
    var loaderMsg = "Loading more rateable-item-notifications...";

    var clonedLoaderEl = getClonedLoaderEl(clonedLoaderElSuffixId, loaderMsg);

    var loaderContainer = $("#rateable-item-notification-container").find(".loader-el-container")[0];

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);

    //
    var crud_type = "read";
    var request_type = "GET";
    var earliestNotificationDate = getLimitDateOfDomElement("earliest", "notification-rateable-item");

    var key_value_pairs = {
        read: "yes",
        earliestNotificationDate: earliestNotificationDate
    };


    //
    var obj = new NotificationRateableItem(crud_type, request_type, key_value_pairs);
    obj.read();
}

function canIReadMoreNotificationRateableItems() {

    // Boundaries of the sides of the reference.
    var referencForLoadingMoreObjs = $("#reference-for-loading-more-notification-rateable-items").get(0).getBoundingClientRect();

    var triggerYPositionForAjaxReadingMoreObjs = 900;

    // // DEBUG:
    // console.log("ref POS: " + referencForLoadingMoreObjs.top);

    if (referencForLoadingMoreObjs.top <= triggerYPositionForAjaxReadingMoreObjs) {
        return true
    }


    return false;
}