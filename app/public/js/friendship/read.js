function readFriendships() {

    //
    doPreReadFriendships();

    //
    doRegularReadFriendships();

    //
    // doPostReadFriendships();
}

function doPreReadFriendships() {

    //
    if (getIsFriendshipReading() || (getNumOfFailedFriendshipAjaxRead() >= 3)) { return; }
    setIsFriendshipReading(true);


    // Set the loader element.
    var loaderMsg = "Loading user's connections...";
    var loaderId = "connection-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#connections-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);
}


function doRegularReadFriendships() {
    var crud_type = "read";
    var request_type = "GET";

    var key_value_pairs = {
        read : "yes"
    };


    var obj = new Friendship(crud_type, request_type, key_value_pairs);
    obj.read();
}