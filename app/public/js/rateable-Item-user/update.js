function update_rateable_item_user(rateable_item_id, rate_value) {
    // window.alert("rateable_item_id: " + rateable_item_id);
    // window.alert("rate_value: " + rate_value);

    var crud_type = "update";
    var request_type = "POST";

    var key_value_pairs = {
        update: "yes",
        rateable_item_id: rateable_item_id,
        rate_value: rate_value
    };


    var obj = new RateableItemUser(crud_type, request_type, key_value_pairs);
    obj.update();
}

