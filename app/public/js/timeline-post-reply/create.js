function create_timeline_post_reply(parent_post_id) {

    //
    var timeline_post_el = $("#post" + parent_post_id).get(0);
    // var timeline_post_container_el = timeline_post_el.parentElement;

    /* Check if the reply textarea is empty. */
    var reply_msg = $(timeline_post_el).find("textarea").val().trim();

    // If the comment is empty, return.
    if (reply_msg.length == 0 || reply_msg == null) { return; }


    //
    var crud_type = "create";
    var request_type = "POST";

    var key_value_pairs = {
        create: "yes",
        parent_post_id: parent_post_id,
        message: reply_msg
    };


    var obj = new TimelinePostReply(crud_type, request_type, key_value_pairs);
    obj.create();
}