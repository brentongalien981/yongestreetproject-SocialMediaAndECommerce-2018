function setNotificationRateableItemFetcher() {
    setHasNotificationRateableItemFetched(true);
    // Get an update every x second.
    setInterval(fetchNotificationRateableItems, 3000);
}


function fetchNotificationRateableItems() {

    if (getIsNotificationRateableItemFetching()) { return; }
    setIsNotificationRateableItemFetching(true);

    var latestNotificationRateableItemElDate = getLimitDateOfDomElement("latest", "notification-rateable-item");

    var crud_type = "fetch";
    var request_type = "GET";
    var key_value_pairs = {
        fetch : "yes",
        latestNotificationRateableItemElDate: latestNotificationRateableItemElDate
    };


    var obj = new NotificationRateableItem(crud_type, request_type, key_value_pairs);
    obj.fetch();
}