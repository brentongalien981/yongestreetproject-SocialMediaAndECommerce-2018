function delete_photo(photo_id) {
    var crud_type = "delete";
    var request_type = "POST";

    var key_value_pairs = {
        delete: "yes",
        photo_id: photo_id
    };



    var obj = new MyPhoto(crud_type, request_type, key_value_pairs);
    obj.delete();
}