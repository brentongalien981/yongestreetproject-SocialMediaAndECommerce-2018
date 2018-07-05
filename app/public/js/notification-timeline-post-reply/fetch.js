function setNotificationTimelinePostReplyFetcher() {
    setHasNotificationTimelinePostReplyFetched(true);
    // Get an update every x second.
    setInterval(fetchNotificationTimelinePostReplies, 5000);
}


function fetchNotificationTimelinePostReplies() {
    // return;

    if (getIsNotificationTimelinePostReplyFetching()) { return; }
    setIsNotificationTimelinePostReplyFetching(true);

    var latestNotificationTimelinePostReplyElDate = getLimitDateOfDomElement("latest", "notification-timeline-post-reply");

    var crud_type = "fetch";
    var request_type = "GET";
    var key_value_pairs = {
        fetch : "yes",
        latestNotificationTimelinePostReplyElDate: latestNotificationTimelinePostReplyElDate
    };


    var obj = new NotificationTimelinePostReply(crud_type, request_type, key_value_pairs);
    obj.fetch();
}