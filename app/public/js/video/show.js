function showVideo() {

    //
    var url = window.location.href;
    // var id = getUrlParamValue(url, "?id");
    var id = extractValueFromUrl(url, "id");

    //
    doPreShowVideo();

    //
    doRegularShowVideo(id);

    //
    // doPostShowVideo();
}

function doRegularShowVideo(id) {
    var crud_type = "show";
    var request_type = "GET";

    var key_value_pairs = {
        show : "yes",
        id: id
    };


    var obj = new Video(crud_type, request_type, key_value_pairs);
    obj.show();
}

function doPreShowVideo() {

    // Set the loader element.
    var loaderMsg = "Loading video..";
    var loaderId = "show-video-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = null;

    loaderContainer = $(".video-container .loader-container");


    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);
}


function getIdOfShownVideo() {
    var url = window.location.href;
    // var id = getUrlParamValue(url, "?id");
    var id = extractValueFromUrl(url, "id");

    //
    if (id == false) { id = 0; }

    return id;
}