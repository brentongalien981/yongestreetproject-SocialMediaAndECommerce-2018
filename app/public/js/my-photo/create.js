function createPhoto() {


    //
    doPreCreatePhoto();

    //
    doRegularCreatePhoto();

}

function doPreCreatePhoto() {

    //
    if (getIsPhotoCreating()) { return; }
    setIsPhotoCreating(true);


    // Set the loader element.
    var loaderMsg = "Saving your new photo...";
    var loaderId = "photo-create-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#my-photo-modal").find(".loader-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);


    // Temporarily hide the modal's main content.
    $("#my-photo-modal").find(".modal-content").css("display", "none");
}

function doRegularCreatePhoto() {

    var crud_type = "create";
    var request_type = "POST";

    var embed_code = $('#photo-embed-code-input').val();

    var href = get_attribute_value(embed_code, "href");
    var src = get_attribute_value(embed_code, "src");
    var width = get_attribute_value(embed_code, "width");
    var height = get_attribute_value(embed_code, "height");
    var photo_title = $('#photo-title-input').val();




    // If the attributes are type incorrectly or not at all (eg. hre/hef/ref and
    // not href), then show an error alert.
    if (href == false) { window.alert("Sorry, but the href attribute is not valid..."); unsetLoaderElForPhotoCreation(); return; }
    if (src == false) { window.alert("Sorry, but the src attribute is not valid..."); unsetLoaderElForPhotoCreation(); return; }
    if (width == false) { window.alert("Sorry, but width attribute is not valid..."); unsetLoaderElForPhotoCreation(); return; }
    if (height == false) { window.alert("Sorry, but the height attribute is not valid..."); unsetLoaderElForPhotoCreation(); return; }


    var key_value_pairs = {
        create: "yes",
        photo_title: photo_title,
        href: href,
        src: src,
        width: width,
        height: height
    };


    var obj = new MyPhoto(crud_type, request_type, key_value_pairs);
    obj.create();
}