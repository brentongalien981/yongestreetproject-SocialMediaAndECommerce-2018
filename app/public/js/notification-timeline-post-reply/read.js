function read_timeline_post_reply_notifications() {

    /* Prepare */
    if (getIsNotificationTimelinePostReplyReading() || (getNumOfFailedNotificationTimelinePostReplyAjaxRead() >= 3)) { return; }
    setIsNotificationTimelinePostReplyReading(true);


    // Set the loader element.
    var clonedLoaderElSuffixId = "notification-timeline-post-reply";
    var loaderMsg = "Loading more timeline-post-reply-notifications...";

    var clonedLoaderEl = getClonedLoaderEl(clonedLoaderElSuffixId, loaderMsg);

    var loaderContainer = $("#rateable-item-notification-container").find(".loader-el-container")[0];

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);


    /* Set */
    var crud_type = "read";
    var request_type = "GET";
    var earliestNotificationDate = getLimitDateOfDomElement("earliest", "notification-timeline-post-reply");

    var key_value_pairs = {
        read: "yes",
        earliestNotificationDate: earliestNotificationDate
    };


    /* Execute */
    var obj = new NotificationTimelinePostReply(crud_type, request_type, key_value_pairs);
    obj.read();
}

function getContentForNotificationTimelinePostReply(anXNotification) {
    var n = anXNotification;
    var msg = ""; // The main content...
    var notificationEl = document.createElement("p");
    var replyMsg = n["reply_message"];
    var postMsg = n["post_message"];
    var replyMsgEllipsis = "";
    var postMsgEllipsis = "";

    if (replyMsg.length > 40) {
        replyMsg = replyMsg.substring(0, 40);
        replyMsgEllipsis = "...";
    }
    if (postMsg.length > 40) {
        postMsg = postMsg.substring(0, 40);
        postMsgEllipsis = "...";
    }


    // CJ commented "ayots to ah:)" a post.

    msg += n["notifier_user_name"] + " commented";
    msg += " \"" + replyMsg + replyMsgEllipsis + "\"";
    msg += " on ";
    msg += n["post_owner_user_name"] + "'s wall post ";
    msg += "\"";
    msg += postMsg + postMsgEllipsis;
    msg += "\".";


    //
    $(notificationEl).html(msg);

    return notificationEl;
}

function canIReadMoreNotificationTimelinePostReplies() {

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