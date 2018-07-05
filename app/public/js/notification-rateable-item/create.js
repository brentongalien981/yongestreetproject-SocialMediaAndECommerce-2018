function create_rateable_item_notification(rateableItemId, rateValue, notificationMsgId) {
    var crud_type = "create";
    var request_type = "POST";

    // Default value to handle notification-rateable-item for post,
    // because of the old code..
    if (notificationMsgId == null) { notificationMsgId = 4; }

    var key_value_pairs = {
        create : "yes",
        rateable_item_id: rateableItemId,
        // notified_user_id : For this instance, this will always be the session->currently_viewed_user_id
        notification_msg_id : notificationMsgId, // eg. 4 means => CJ rated your post "llskjdfslkdfj" "bomb"
        rate_value: rateValue
    };


    var obj = new NotificationRateableItem(crud_type, request_type, key_value_pairs);
    obj.create()
}