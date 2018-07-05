function do_rateable_item_user_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":

            // to_read is the options for these 3 pseudo-buttons..
            var what_to_read = x_obj.key_value_pairs["what_to_read"];

            switch (what_to_read) {
                case "rate_tags":
                    set_rate_pseudo_buttons(json.objs);
                    break;
                case "rate_sigma":
                    set_rate_sigmas(json.objs);
                    break;
                case "rate_value_sigma":
                    set_rate_averages(json.objs);
                    break;
            }


            break;
        case "create":
        case "update":
            var rateable_item_id = x_obj.key_value_pairs["rateable_item_id"];
            var rate_value = x_obj.key_value_pairs["rate_value"];

            set_rate_pseudo_button(rateable_item_id, rate_value);

            /* Create the NotificationPost record. */
            // Get the id of the post.
            var post_id = $("[rateable-item-id='" + rateable_item_id + "']").closest(".message_post").attr("id");
            post_id = post_id.substring(4);

            // create_timeline_post_notification(post_id);
            create_rateable_item_notification(rateable_item_id, rate_value);
            break;
        case "delete":
            break;
    }
}