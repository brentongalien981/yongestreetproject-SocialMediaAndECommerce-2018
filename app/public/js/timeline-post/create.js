function create_timeline_post() {
    // Check if textarea is empty.
    if (is_textarea_empty(document.getElementById("message_post_textarea"))) { return; }

    var message = $("#message_post_textarea").val();

    var crud_type = "create";
    var request_type = "POST";

    var key_value_pairs = {
        create: "yes",
        message: message
    };


    var obj = new TimelinePost(crud_type, request_type, key_value_pairs);
    obj.create();
}