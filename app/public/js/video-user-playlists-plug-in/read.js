function readVideoUserPlaylists() {

    var isOkToProceed = doPreReadVideoUserPlaylists();

    if (!isOkToProceed) { return; }

    doRegularReadUserPlaylists();
    doPostReadUserPlaylists();
}


function doPostReadUserPlaylists() {

}


function doRegularReadUserPlaylists() {

    var crud_type = "read";
    var request_type = "GET";
    var earliestElDate = getLimitDateOfDomElement("earliest", "playlist-items");


    var key_value_pairs = {
        read: "yes",
        earliest_el_date: earliestElDate
    };


    var obj = new UserPlaylist(crud_type, request_type, key_value_pairs);
    obj.read();

}


function doPreReadVideoUserPlaylists() {

    //
    if (getIsUserPlaylistReading() || (getNumOfFailedUserPlaylistAjaxRead() >= 3)) { return false; }
    setIsUserPlaylistReading(true);


    // // App shows the loaders element.
    // // Set the loader element.
    // var loaderMsg = "Loading playlists...";
    // var loaderId = "video-user-playlists-plug-in";
    // var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);
    //
    // var loaderContainer = $("#video-user-playlists-plug-in").find(".loader-element-container");
    //
    // appendClonedLoaderEl(loaderContainer, clonedLoaderEl);

    return true;
}