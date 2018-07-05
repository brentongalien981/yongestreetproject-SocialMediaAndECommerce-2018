function populate_edit_form(edit_icon) {
    var current_photo_container = $(edit_icon).closest(".individual_photo_container")[0];
    var current_photo = $(current_photo_container).find("img")[0];

    $('#my-photo-update-photo-title-input').val($(current_photo).attr('alt'));

    var edit_embed_code = "<a";
    edit_embed_code += " data-flickr-embed=\"true\"";
    edit_embed_code += " href=\"" + $(current_photo).attr("for-href") + "\"";
    edit_embed_code += " title=\"" + $(current_photo).attr("alt") + "\">";
    edit_embed_code += "<img src=\"" + $(current_photo).attr("src") + "\"";
    edit_embed_code += " width=\"" + $(current_photo).attr("raw-width") + "\"";
    edit_embed_code += " height=\"" + $(current_photo).attr("raw-height") + "\"";
    edit_embed_code += " alt=\"" + $(current_photo).attr("alt") + "\"";
    edit_embed_code += "</a>";


    $("#my-photo-update-embed-code-input").val(edit_embed_code);


    //
    var current_photo_id = $(current_photo).attr("id");
    current_photo_id = current_photo_id.substring(5); // Remove the "photo" from photo113
    $("#my-photo-update-photo-id").attr("value", current_photo_id);

}

function updatePhoto() {

    //
    doPreUpdatePhoto();
    doRegularUpdatePhoto();
    // doPostUpdatePhoto();
}

function doPreUpdatePhoto() {

    //
    if (getIsPhotoUpdating()) { return; }
    setIsPhotoUpdating(true);


    // Set the loader element.
    var loaderMsg = "Updating your photo...";
    var loaderId = "photo-update-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#my-photo-update-modal").find(".loader-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);


    // Temporarily hide the modal's main content to show the loader
    // while updating.
    $("#my-photo-update-modal").find(".modal-content").css("display", "none");
}

function doRegularUpdatePhoto() {

    var crud_type = "update";
    var request_type = "POST";

    var photo_id = $('#my-photo-update-photo-id').val();
    var photo_title = $('#my-photo-update-photo-title-input').val();
    var photo_embed_code = $('#my-photo-update-embed-code-input').val();

    var href = get_attribute_value(photo_embed_code, "href");
    var src = get_attribute_value(photo_embed_code, "src");
    var width = get_attribute_value(photo_embed_code, "width");
    var height = get_attribute_value(photo_embed_code, "height");

    // If the attributes are type incorrectly or not at all (eg. hre/hef/ref and
    // not href), then show an error alert.
    if (href == false) { window.alert("Sorry, but the href attribute is not valid..."); unsetLoaderElForPhotoUpdate(); return; }
    if (src == false) { window.alert("Sorry, but the src attribute is not valid..."); unsetLoaderElForPhotoUpdate(); return; }
    if (width == false) { window.alert("Sorry, but width attribute is not valid..."); unsetLoaderElForPhotoUpdate(); return; }
    if (height == false) { window.alert("Sorry, but the height attribute is not valid..."); unsetLoaderElForPhotoUpdate(); return; }



    var key_value_pairs = {
        update: "yes",
        my_photo_update_photo_id: photo_id,
        my_photo_update_photo_title: photo_title,
        my_photo_update_href: href,
        my_photo_update_src: src,
        my_photo_update_width: width,
        my_photo_update_height: height

    };



    var obj = new MyPhoto(crud_type, request_type, key_value_pairs);
    obj.update();
}

function clearMyPhotoUpdateFormInputs() {
    $('#my-photo-update-photo-title-input').val("");
    $('#my-photo-update-embed-code-input').val("");
}

function domUpdateEl(xObj) {

    //
    var photoId = "photo" + xObj.key_value_pairs["my_photo_update_photo_id"];
    //
    var newTitle = xObj.key_value_pairs["my_photo_update_photo_title"];
    $('#' + photoId).attr("alt", newTitle);
}