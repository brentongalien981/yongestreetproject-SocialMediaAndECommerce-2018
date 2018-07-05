function doMyPhotoPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            //
            unsetLoaderElForPhotoRead();

            //
            if (!isCnAjaxResultOk(json)) {
                setNumOfFailedPhotoAjaxRead(parseInt(getNumOfFailedPhotoAjaxRead()) + 1);
            }

            break;

        case "create":
            unsetLoaderElForPhotoCreation();
            break;

        case "update":

            unsetLoaderElForPhotoUpdate();
            break;

        case "delete":
        case "fetch":
        case "patch":
            break;
    }
}

function doMyPhotoAfterEffects(className, crudType, json, xObj) {
    switch (crudType) {
        case "fetch":
            break;
        case "read":
            populate_photos_container(json);
            break;
        case "create":

            $('#my-photo-modal').modal('hide');

            clearMyPhotoFormInputs();

            reSetPhotoContainer();
            readPhotos();

            break;

        case "update":

            reSetPhotoContainer();
            readPhotos();

            break;
        case "delete":

            // domUpdateEl(xObj);

            $('#my-photo-update-modal').modal('hide');
            clearMyPhotoUpdateFormInputs();

            reSetPhotoContainer();

            readPhotos();

            break;
        case "patch":
            break;
    }
}

function populate_photos_container(json) {

    //
    var photos = json.objs;

    //
    setNumOfNewlyDisplayedPhotos(0);

    //
    while (getNumOfNewlyDisplayedPhotos() < photos.length) {

        //
        display_row_of_photos(photos, json);

    }
}

function display_row_of_photos(photos, json) {

    var num_of_photos_in_row = getRandomInt(2, 4);

    //
    var rawHeightOfTallestPhotoInRow = getRawHeightOfTallestPhotoInRow(photos, num_of_photos_in_row);

    // array of photos in one row.
    var photos_to_be_displayed = getPhotosToBeDisplayed(photos, num_of_photos_in_row, rawHeightOfTallestPhotoInRow);


    // Calculate the total reference width of all the photos.
    var total_reference_width = getRawWidthOfCombinedPhotosInRow (photos_to_be_displayed);

    //
    doRegularDisplayOfRowPhotos (photos_to_be_displayed, total_reference_width, json);

    //
    setHorizontalDividerForRowOfPhotos();
}

/**
 * Of those photos to be displayed in a row, find which has the largest height.
 * Set that as the maximum reference height.
 */
function getRawHeightOfTallestPhotoInRow(photos, num_of_photos) {
    var rawHeightOfTallestPhotoInRow = -1;

    for (i = 0; i < num_of_photos; i++) {

        if (photos[i] == null) {
            break;
        }

        var embed_code = photos[i];


        var h = embed_code['height'];

        if (h >= rawHeightOfTallestPhotoInRow) {
            rawHeightOfTallestPhotoInRow = h;
        }
    }

    return rawHeightOfTallestPhotoInRow;
}

function reSetPhotoContainer() {

    $(".individual_photo_container").remove();
    $(".horizontal_divider").remove();

    setPhotoContainerWidth();
    setNumOfFailedPhotoAjaxRead(0);
}

function clearMyPhotoFormInputs() {
    $('#photo-title-input').val("");
    $('#photo-embed-code-input').val("");
}


function unsetLoaderElForPhotoUpdate() {

    var loaderEl = $("#loader-for-photo-update-xxx");
    removeClonedLoaderEl(loaderEl);

    setIsPhotoUpdating(false);

    // Re-show the modal's main content.
    $("#my-photo-update-modal").find(".modal-content").css("display", "block");
}

function unsetLoaderElForPhotoCreation() {

    var loaderEl = $("#loader-for-photo-create-xxx");
    removeClonedLoaderEl(loaderEl);

    setIsPhotoCreating(false);

    // Re-show the modal's main content.
    $("#my-photo-modal").find(".modal-content").css("display", "block");
}

function unsetLoaderElForPhotoRead() {

    var loaderEl = $("#loader-for-photo-xxx");
    removeClonedLoaderEl(loaderEl);

    setIsPhotoReading(false);
}