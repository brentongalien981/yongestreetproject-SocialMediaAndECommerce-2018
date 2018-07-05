function attach_rateable_item_ids(rateable_items) {
    var len = rateable_items.length;

    for (i = 0; i < len; i++) {
        var item_x_id = rateable_items[i]['item_x_id'];
        var rateable_item_id = rateable_items[i]['id'];

        var post_id = "post" + item_x_id;

        // Attach the id.
        $('#' + post_id).find('.b-post-response-bar').attr("rateable-item-id", rateable_item_id);

        add_rate_pseudo_button_hover_listener(post_id);

    }

    // // If len is 1, this means that it was a newly created post. So attach an event listener.
    // if (are_rateable_item_ids_set && len == 1) {
    //     add_rate_pseudo_button_hover_listener(post_id);
    // }

    // are_rateable_item_ids_set = true;
}

//
function set_rateable_item_ids() {
    var post_ids = get_post_ids();

    read_rateable_item_ids(post_ids);
}

function get_post_ids() {
    var posts = $('.message_post');
    var post_ids = [];

    var length = posts.length;

    for (i=0; i<length; i++) {
        var id = posts[i].id;
        post_ids[i] = id.substring(4);
    }

    return post_ids;
}

function read_rateable_item_id(post_id) {

    var crud_type = "read";
    var request_type = "GET";


    var key_value_pairs = {
        read: "yes",
        post_id: post_id,
        item_x_type_id: type_id_of_post
    };



    var obj = new RateableItem(crud_type, request_type, key_value_pairs);
    obj.read();
}