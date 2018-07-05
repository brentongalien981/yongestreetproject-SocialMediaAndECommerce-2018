function readFriends() {

    //
    doPreReadFriends();

    //
    doRegularReadFriends();

    //
    // doPostReadFriends();
}

function doPreReadFriends() {

    //
    if (getIsFriendReading() || (getNumOfFailedFriendAjaxRead() >= 3)) { return; }
    setIsFriendReading(true);


    // Set the loader element.
    var loaderMsg = "Loading user's connections...";
    var loaderId = "connection-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#connections-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);
}


function doRegularReadFriends() {
    var crud_type = "read";
    var request_type = "GET";

    var key_value_pairs = {
        read : "yes"
    };


    var obj = new Friend(crud_type, request_type, key_value_pairs);
    obj.read();
}