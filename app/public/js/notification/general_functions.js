function getLimitDateOfDomNotifications(limitType, className) {
    var specificClassName = "";

    switch (className) {
        case "NotificationRateableItem":
            specificClassName = "rateable-item-notifications";
            break;
        case "NotificationMyShopping":
            specificClassName = "my_shopping_notifications";
            break;
        case "NotificationFriendship":
            specificClassName = "friendship_notifications";
            break;
        case "NotificationTimelinePostReply":
            specificClassName = "timeline_post_reply_notifications";
            break;
    }

    var limitDate = "2010-09-11 10:54:45";
    var length = $("." + specificClassName).length;

    if (length == 0) {
        if (limitType == "earliest") {
            limitDate = "0000-00-00 00:00:00";
        }

        return limitDate;
    }

    if (limitType == "earliest") {
        var earliestXNotification = $("." + specificClassName)[length - 1];
        limitDate = earliestXNotification.attr("created-at");
    }
    else {
        var latestXNotification = $("." + specificClassName)[0];
        limitDate = latestXNotification.attr("created-at");
    }

    return limitDate;
}

function populateXNotificationContent(xNotifications, className, crudType) {

    for (var i = 0; i < xNotifications.length; i++) {

        var anXNotification = xNotifications[i];

        //
        var anIdentifiedXNotificationItemContainer = getAnIdentifiedXNotificationItemContainer(anXNotification);

        //
        setXNotificationElClassName(anIdentifiedXNotificationItemContainer, className);

        var specificXNotificationMainContent = getSpecificXNotificationMainContent(anXNotification, className);

        var humanDate = anXNotification["human_date"];
        setXNotificationHumanDate(anIdentifiedXNotificationItemContainer, humanDate);


        // Insert the notification's main content to the
        // notification container.
        anIdentifiedXNotificationItemContainer.find(".notification-main-content-holder").append($(specificXNotificationMainContent));


        // Add listener to the delete-link of the xNotification.
        addListenerToDeleteNotificationBtn(anIdentifiedXNotificationItemContainer, anXNotification, className);


        // This is specifically for crudType "fetch".
        if (crudType == "fetch") {
            tryDomRemoveOldNotification(anXNotification);
        }



        // Stack or append the xNotification to the xNotification-content-holder
        //       depending on the crudType (read / fetch).
        insertXNotificationElToDom(className, crudType, anIdentifiedXNotificationItemContainer);

    }
}

/**
 * Stack or append the xNotification to the xNotification-content-holder
 depending on the crudType (read / fetch).
 * @param className
 * @param crudType
 * @param anIdentifiedXNotificationItemContainer
 */
function insertXNotificationElToDom(className, crudType, xNotificationEl) {

    if (crudType == "read") {
        // Append
        $("#rateable-item-notification-content").append(xNotificationEl);
    }
    else {
        // Stack
        stackXNotificationElToContainer(className, xNotificationEl);
    }
}

function stackXNotificationElToContainer(className, xNotificationEl) {

    var container = null;

    switch (className) {
        case "NotificationRateableItem":
        case "NotificationTimelinePostReply":
            container = $("#rateable-item-notification-content");
            break;
    }

    $(container).prepend($(xNotificationEl));
}

function getSpecificXNotificationMainContent(anXNotification, className) {

    var notificationMsgId = parseInt(anXNotification['notification_msg_id']);
    var specificXNotificationMainContent = null;

    switch (notificationMsgId) {
        case NOTIFICATION_FOR_RATING_TIMELINE_POST_MSG_ID:
            specificXNotificationMainContent = getNotificationContentForRatingATimelinePost(anXNotification);
            break;
        case NEW_TIMELINE_POST_REPLY_NOTIFICATION_MSG_ID:
            specificXNotificationMainContent = getContentForNotificationTimelinePostReply(anXNotification);
            break;
        case NOTIFICATION_FOR_RATING_VIDEO_MSG_ID:
            specificXNotificationMainContent = getNotificationContentForRatingAVideo(anXNotification);
            break;
    }

    return specificXNotificationMainContent;
}

function getAnIdentifiedXNotificationItemContainer(anXNotification) {

    var xNotificationItemConatainer = $("#x-notification-item-template").clone(true);
    xNotificationItemConatainer.css("display", "block");

    var notificationId = "notification" + anXNotification["notification_id"];
    xNotificationItemConatainer.attr("id", notificationId);

    var notificationObjCreationDate = anXNotification["initiation_date"];
    xNotificationItemConatainer.attr("created-at", notificationObjCreationDate);

    return xNotificationItemConatainer;
}

function setXNotificationHumanDate(anIdentifiedXNotificationItemContainer, humanDate) {
    $(anIdentifiedXNotificationItemContainer).find(".notification-human-date").append("<h6>" + humanDate + "</h6>");
}

function setXNotificationElClassName(xNotificationEl, className) {

    switch (className) {
        case "NotificationRateableItem":
            $(xNotificationEl).addClass("notification-rateable-item");
            break;
        case "NotificationTimelinePostReply":
            $(xNotificationEl).addClass("notification-timeline-post-reply");
            break;
    }
}