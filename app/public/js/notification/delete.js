function deleteXNotification(className, notificationId) {
    var crud_type = "delete";
    var request_type = "POST";
    
    var key_value_pairs = {
        delete : "yes",
        notificationId : notificationId
    };


    var obj = null;

    switch(className) {
        case "NotificationFriendship":
            obj = new NotificationFriendship(crud_type, request_type, key_value_pairs);
            break;
        case "NotificationMyShopping":
            obj = new NotificationMyShopping(crud_type, request_type, key_value_pairs);
            break;
        case "NotificationRateableItem":
            obj = new NotificationRateableItem(crud_type, request_type, key_value_pairs);
            break;
        case "NotificationTimelinePostReply":
            obj = new NotificationTimelinePostReply(crud_type, request_type, key_value_pairs);
            break;
    }


    obj.delete();

}

function domRemoveNotification(notificationId) {

    var elId = "notification" + notificationId;

    animateElRemoval(elId);

}

function tryDomRemoveOldNotification(xNotificationObj) {

    var notificationId = xNotificationObj['notification_id'];

    var possibleOldNotification = $("#notification" + notificationId);

    //
    if (possibleOldNotification != null) {

        var oldNotificationCreationDate = $(possibleOldNotification).attr("created-at");
        var newNotificationCreationDate = xNotificationObj['initiation_date'];


        if (newNotificationCreationDate > oldNotificationCreationDate) {

            // domRemoveNotification(notificationId);
            var elId = "notification" + notificationId;
            $("#" + elId).remove();
        }
    }
}

function animateElRemoval(elId) {
    var animationCounter = 10;
    var animationTimePerInterval = 35;
    var animationHandler = setInterval(function () {


        var elOpacity = animationCounter * .1;
        $("#" + elId).css("opacity", elOpacity);

        --animationCounter;

        if (animationCounter <= 0) {

            $("#" + elId).remove();

            //
            clearInterval(animationHandler);
        }
    }, animationTimePerInterval);
}