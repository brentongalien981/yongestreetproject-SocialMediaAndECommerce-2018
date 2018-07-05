function add_click_listener_to_edit_icon(icon) {

    $(icon).click(function (event) {

        event.stopPropagation();

        //
        populate_edit_form(this);

        $('#my-photo-update-modal').modal('show');
    });
}

function add_click_listener_to_delete_icon(icon) {

    $(icon).click(function (event) {

        event.stopPropagation();

        var is_deletion_sure = confirm("Are you sure you wanna delete this photo?");

        if (is_deletion_sure == true) {
            // Delete the damn thing.
            var current_photo_container = $(icon).closest(".individual_photo_container")[0];
            var current_photo = $(current_photo_container).find("img")[0];

            var photo_id = $(current_photo).attr("id");
            photo_id = photo_id.substring(5); // Remove the "photo" from photo113

            delete_photo(photo_id);
        }
    });
}

function add_click_listener_to_caption(caption) {

    $(caption).click(function () {

        var the_img = caption.parentElement.childNodes[0];

        if (the_img != null &&
            $(the_img).is("img")) {
            show_solo_img(the_img);
        }
    });
}


function add_listener_to_solo_link_holder() {
    $('#link_holder').click(function (event) {
        event.stopPropagation();
    });

}