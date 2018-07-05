function doNotificationRateableItemsAfterEffects(className, crudType, json, xObj) {
    switch (crudType) {
        case "fetch":
        case "read":

            var xNotifications = json.objs;

            populateXNotificationContent(xNotifications, className, crudType);

            break;
        case "create":
            // TODO: DEBUG
            cnLog("success ajax-create-NotificationRateableItem");
            break;
        case "update":
            break;

        case "delete":

            var notificationId = xObj.key_value_pairs['notificationId'];
            domRemoveNotification(notificationId);
            break;
    }
}

function getNotificationContentForRatingATimelinePost(anXNotification) {

    var n = anXNotification;
    var notificationEl = document.createElement("p");
    var msg = "";


    // CJ rated your post “[Conor McGregor knocked Floyd Ma...]” “bomb”.

    msg += " " + n["user_name"];
    msg += " rated your ";
    msg += "<a href='#'>";
    msg += "post";
    msg += "</a> ";
    msg += "\"";
    msg += n["message"].substring(0, 40) + " ...";
    msg += "\" ";
    msg += "\"" + n["name"] + "\".";

    $(notificationEl).html(msg);

    return notificationEl;
}

function getNotificationContentForRatingAVideo(anXNotification) {

    var n = anXNotification;
    var notificationEl = document.createElement("p");
    var videoTitle = n["video_title"];


    //
    if (videoTitle.length > 40) {
        videoTitle = videoTitle.substring(0, 40);
        videoTitle += "...";
    }

    //
    var msg = "";


    // CJ rated your video “[Kendrick Lamar - HUMBLE...]” “bomb”.

    msg += " " + n["user_name"];
    msg += " rated your ";

    msg += "<a href='#'>";
    msg += "video";
    msg += " \"";
    msg += videoTitle;
    msg += "\"";
    msg += "</a>";

    msg += " \"" + n["name"] + "\".";

    $(notificationEl).html(msg);

    return notificationEl;
}

function doNotificationRateableItemsPreAfterEffects(className, crudType, json, xObj) {

    switch (crudType) {
        case "fetch":
            setIsNotificationRateableItemFetching(false);
            break;

        case "read":

            var loaderEl = $("#loader-for-notification-rateable-item");
            removeClonedLoaderEl(loaderEl);

            setIsNotificationRateableItemReading(false);


            if (!isCnAjaxResultOk(json)) {
                var numOfFailedNotificationRateableItemAjaxRead = parseInt(getNumOfFailedNotificationRateableItemAjaxRead())
                setNumOfFailedNotificationRateableItemAjaxRead(numOfFailedNotificationRateableItemAjaxRead + 1);
            }

            //
            if (!getHasNotificationRateableItemFetched()) {
                setNotificationRateableItemFetcher();
            }
            break;
        case "create":
            break;
        case "update":
            break;

        case "delete":
            break;
    }
}