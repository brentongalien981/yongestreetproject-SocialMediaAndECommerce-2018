function add_click_listener_to_edit_icon(icon) {

    // TODO: add_click_listener_to_edit_icon().

    $(icon).click(function (event) {
        cnLog("TODO: add_click_listener_to_edit_icon()");
        return;

        event.stopPropagation();
        hide_element($('#add_photo_form'));
        hide_element($('#add_photo_link'));
        show_element($('#edit_photo_form'), "block");


        b_remove_animation($('#edit_photo_form').get(0), "fadeOutUp");
        b_add_animation($('#edit_photo_form').get(0), "fadeInDown");


        //
        populate_edit_form(this);
    });
}

function add_click_listener_to_delete_icon(icon) {

    // TODO: add_click_listener_to_delete_icon().

    $(icon).click(function (event) {

        cnLog("TODO: add_click_listener_to_delete_icon()");
        return;

        event.stopPropagation();


        var is_deletion_sure = confirm("Are you sure you wanna delete this photo?");

        if (is_deletion_sure == true) {
            // Delete the damn thing.
            var current_photo_container = this.parentElement.parentElement.parentElement;
            var current_photo = current_photo_container.childNodes[0];
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