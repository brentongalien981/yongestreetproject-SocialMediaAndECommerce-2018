function doPhotoPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            // Unset loader el.
            var loaderEl = $("#loader-for-photo-xxx");
            removeClonedLoaderEl(loaderEl);

            setIsPhotoReading(false);


            // // TODO: method setPhotoFetcher().
            // if (!getHasPhotoFetched()) {
            //     setHasPhotoFetched(true);
            //     setPhotoFetcher();
            // }


            //
            if (!isCnAjaxResultOk(json)) {
                setNumOfFailedPhotoAjaxRead(parseInt(getNumOfFailedPhotoAjaxRead()) + 1);
            }

            break;

        case "create":
        case "update":
        case "delete":
        case "fetch":
        case "patch":
            break;
    }
}

function doPhotoAfterEffects(className, crudType, json, xObj) {
    switch (crudType) {
        case "fetch":
            break;
        case "read":
            populate_photos_container(json);
            break;
        case "create":
        case "update":
        case "delete":
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