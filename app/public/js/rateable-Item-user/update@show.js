function updateRateableItemUser(rateableItemId, rateValue) {

    var crud_type = "update";
    var request_type = "POST";

    var key_value_pairs = {
        update: "yes",
        rateable_item_id: rateableItemId,
        rate_value: rateValue
    };


    var obj = new RateableItemUser(crud_type, request_type, key_value_pairs);
    obj.update();
}

