function do_notification_timeline_post_replies_after_effects(className, crudType, json, xObj) {
    switch (crudType) {
        case "fetch":
        case "read":

            var xNotifications = json.objs;

            populateXNotificationContent(xNotifications, className, crudType);

            break;
        case "create":
            cnLog("SUCCESS on notifying all subscribers on that post about that comment.");
            break;
        case "update":
            break;
        case "delete":
            var notificationId = xObj.key_value_pairs['notificationId'];
            domRemoveNotification(notificationId);
            break;
    }
}

function doNotificationTimelinePostRepliesPreAfterEffects(className, crudType, json, xObj) {

    switch (crudType) {
        case "fetch":
            setIsNotificationTimelinePostReplyFetching(false);
            break;

        case "read":

            var loaderEl = $("#loader-for-notification-timeline-post-reply");
            removeClonedLoaderEl(loaderEl);

            setIsNotificationTimelinePostReplyReading(false);


            if (!isCnAjaxResultOk(json)) {
                var numOfFailedNotificationTimelinePostReplyAjaxRead = parseInt(getNumOfFailedNotificationTimelinePostReplyAjaxRead())
                setNumOfFailedNotificationTimelinePostReplyAjaxRead(numOfFailedNotificationTimelinePostReplyAjaxRead + 1);
            }

            //
            //
            if (!getHasNotificationTimelinePostReplyFetched()) {
                setNotificationTimelinePostReplyFetcher();
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