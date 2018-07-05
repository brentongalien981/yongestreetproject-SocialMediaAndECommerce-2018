function readPhotos() {

    //
    doPreReadPhotos();

    //
    doRegularReadPhotos();

    //
    // doPostReadPhotos();
}

function doPreReadPhotos() {

    //
    if (getIsPhotoReading() || (getNumOfFailedPhotoAjaxRead() >= 3)) { return; }
    setIsPhotoReading(true);


    // Set the loader element.
    var loaderMsg = "Loading photos...";
    var loaderId = "photo-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#photo-main-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);
}

function doRegularReadPhotos() {
    var crud_type = "read";
    var request_type = "GET";
    var earliestElDate = getLimitDateOfDomElement("earliest", "photo");

    var key_value_pairs = {
        read : "yes",
        earliestElDate: earliestElDate
    };


    var obj = new Photo(crud_type, request_type, key_value_pairs);
    obj.read();
}

function canIReadMorePhotos() {

    // Boundaries of the sides of the reference.
    var referencForLoadingMoreObjs = $("#reference-for-loading-more-photos").get(0).getBoundingClientRect();

    var windowHeight = $(window).height();

    // // DEBUG:
    // console.log("ref POS: " + referencForLoadingMoreObjs.top);

    if (referencForLoadingMoreObjs.top <= windowHeight) {
        return true
    }


    return false;
}