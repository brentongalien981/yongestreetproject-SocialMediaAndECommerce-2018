function readUserTopActivity() {

    //
    doPreReadUserTopActivity();

    //
    doRegularReadUserTopActivity();

    //
    // doPostReadUserTopActivity();
}

function doPreReadUserTopActivity() {

    // //
    // if (getIsPhotoReading() || (getNumOfFailedPhotoAjaxRead() >= 3)) { return; }
    // setIsPhotoReading(true);


    // Set the loader element.
    var loaderMsg = "Loading user's activity photos...";
    var loaderId = "user-top-activity-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#user-top-activities-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);
}


function doRegularReadUserTopActivity() {
    var crud_type = "read";
    var request_type = "GET";

    var key_value_pairs = {
        read : "yes"
    };


    var obj = new UserTopActivity(crud_type, request_type, key_value_pairs);
    obj.read();
}