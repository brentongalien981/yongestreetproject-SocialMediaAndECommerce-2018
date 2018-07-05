function createTimelinePostUserSubscription() {

    //
    var crud_type = "create";
    var request_type = "POST";
    var timeline_post_id = get_selected_timeline_post_id();


    var key_value_pairs = {
        create: "yes",
        timeline_post_id: timeline_post_id
    };


    var obj = new TimelinePostUserSubscription(crud_type, request_type, key_value_pairs);
    obj.create();
}