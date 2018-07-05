$("#notification-widget-container").scroll(function () {

    /**/
    if (canIReadMoreNotificationRateableItems()) {
        readRateableItemNotificationObjs();
    }
});