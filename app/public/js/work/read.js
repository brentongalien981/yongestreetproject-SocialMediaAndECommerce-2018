function readWorks() {

    //
    doPreReadWorks();

    //
    doRegularReadWorks();

    //
    // doPostReadWorks();
}

function doPreReadWorks() {

    // //
    // if (getIsPhotoReading() || (getNumOfFailedPhotoAjaxRead() >= 3)) { return; }
    // setIsPhotoReading(true);


    // Set the loader element.
    var loaderMsg = "Loading user's employment profile...";
    var loaderId = "work-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#work-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);
}


function doRegularReadWorks() {
    var crud_type = "read";
    var request_type = "GET";

    var key_value_pairs = {
        read : "yes"
    };


    var obj = new Work(crud_type, request_type, key_value_pairs);
    obj.read();
}