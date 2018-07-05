function readProfileSummary() {

    //
    doPreReadProfileSummary();

    //
    doRegularReadProfileSummary();

    //
    // doPostReadProfileSummary();
}

function doPreReadProfileSummary() {

    // //
    // if (getIsPhotoReading() || (getNumOfFailedPhotoAjaxRead() >= 3)) { return; }
    // setIsPhotoReading(true);


    // Set the loader element.
    var loaderMsg = "Loading user-profile's summary...";
    var loaderId = "profile-summary-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#user-summary-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);
}

function doRegularReadProfileSummary() {
    var extra_key_value_pairs = {
        for_section: "summary"
    };


    doRegularReadProfile(extra_key_value_pairs);
}

function doRegularReadProfile(extraKeyValuePairs) {
    var crud_type = "read";
    var request_type = "GET";

    var key_value_pairs = {
        read : "yes"
    };


    // Add extra details to obj.
    for (var key in extraKeyValuePairs) {
        if (extraKeyValuePairs.hasOwnProperty(key)) {
            var val = extraKeyValuePairs[key];

            key_value_pairs[key] = val;
        }
    }

    var obj = new Profile(crud_type, request_type, key_value_pairs);
    obj.read();
}