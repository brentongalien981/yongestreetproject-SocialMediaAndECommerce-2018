function create_rateable_item(item_x_id) {

    var crud_type = "create";
    var request_type = "POST";

    var key_value_pairs = {
        create: "yes",
        item_x_id: item_x_id,
        item_x_type_id: type_id_of_post
    };


    var rateable_item = new RateableItem(crud_type, request_type, key_value_pairs);
    rateable_item.create();
}