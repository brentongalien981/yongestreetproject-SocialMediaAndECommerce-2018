$("#notification-widget-container").scroll(function () {

    /**/
    if (canIReadMoreNotificationTimelinePostReplies()) {
        read_timeline_post_reply_notifications();
    }
});