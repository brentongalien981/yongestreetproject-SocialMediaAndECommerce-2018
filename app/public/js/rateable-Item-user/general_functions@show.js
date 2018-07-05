function do_rateable_item_user_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":

            // to_read is the options for these 3 pseudo-buttons..
            var what_to_read = x_obj.key_value_pairs["what_to_read"];

            switch (what_to_read) {
                case "rate_tags":
                    setTwoCentsItem(json.objs);
                    break;
                case "rate_sigma":
                    setRatingSigma(json.objs);
                    break;
                case "rate_value_sigma":
                    setAverageRating(json.objs);
                    break;
            }


            break;
        case "create":

        case "update":

            //
            var rateableItemId = x_obj.key_value_pairs["rateable_item_id"];
            var rateValue = x_obj.key_value_pairs["rate_value"];
            var notificationMsgId = 6;


            // Create the rateable-item-notification-record.
            create_rateable_item_notification(rateableItemId, rateValue, notificationMsgId);


            // Re-read the rateable-item's total-ratings-count.
            readRatingSigmaOfRateableItem(rateableItemId);


            // Re-read the rateable-item's average-rating.
            readAverageRatingOfRateableItem(rateableItemId);

            break;

        case "delete":
            break;
    }
}