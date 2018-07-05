function create_timeline_post_reply_notifications(timeline_post_id, timeline_post_reply_id) {
    var crud_type = "create";
    var request_type = "POST";

    var key_value_pairs = {
        create : "yes",
        timeline_post_id: timeline_post_id,
        timeline_post_reply_id: timeline_post_reply_id
    };

    var obj = new NotificationTimelinePostReply(crud_type, request_type, key_value_pairs);
    obj.create()
}