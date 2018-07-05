function readVideos(callingBtn) {

    //
    doPreReadVideos(callingBtn);

    //
    doRegularReadVideos(callingBtn);

    //
    // doPostReadVideos();
}

function doPreReadVideos(callingBtn) {

    // Set the loader element.
    var loaderMsg = "Loading videos..";
    var loaderId = "video-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = null;

    if (callingBtn == null) {
        loaderContainer = $("#cn-center-col");
    }
    else {
        loaderContainer = $(callingBtn).parent().find(".loader-container");
    }


    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);
}

function doRegularReadVideos(callingBtn) {
    var crud_type = "read";
    var request_type = "GET";
    // var earliestElDate = getLimitDateOfDomElement("earliest", "video-recommendation-item");
    var readForPageSection = (callingBtn == null) ? null : $(callingBtn).parent().attr("pageSection");
    var displayedVideoIds = getDisplayedVideoIds();

    var key_value_pairs = {
        read : "yes",
        // earliestElDate: earliestElDate,
        readForPageSection: readForPageSection,
        displayedVideoIds: displayedVideoIds
    };


    var obj = new Video(crud_type, request_type, key_value_pairs);
    obj.read();
}

function getDisplayedVideoIds() {

    var displayedVideoItems = $(".video-recommendation-item");
    var videoIds = [];



    for (var i = 0; i < displayedVideoItems.length; i++) {

        var currentVideoId = $(displayedVideoItems[i]).attr("id");

        // Remove the "video" from "video6".
        currentVideoId = currentVideoId.substring(5);

        videoIds.push(currentVideoId);
    }

    //
    var stringOfVideoIds = videoIds.join();

    return stringOfVideoIds;

}