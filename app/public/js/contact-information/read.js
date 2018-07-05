function readContactInformation() {

    //
    doPreReadContactInformation();

    //
    doRegularReadContactInformation();

    //
    // doPostReadContactInformation();
}

function doPreReadContactInformation() {

    // //
    // if (getIsPhotoReading() || (getNumOfFailedPhotoAjaxRead() >= 3)) { return; }
    // setIsPhotoReading(true);


    // Set the loader element.
    var loaderMsg = "Loading user's contact info...";
    var loaderId = "profile-contact-info-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#contact-information-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);
}

function doRegularReadContactInformation() {
    var extra_key_value_pairs = {
        for_section: "contactInformation"
    };


    doRegularReadProfile(extra_key_value_pairs);
}