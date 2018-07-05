function readIimelinePosts() {

    //
    if (getIsTimelinePostReading() || (getNummOfFailedAjaxRead() >= 3)) { return; }
    setIsTimelinePostReading(true);

    // //
    // setLoaderEl("main_content2", "Loading timeline posts...");

    // Set the loader element.
    var loaderMsg = "Loading timeline posts...";
    var loaderId = "timeline-post-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#main_content2");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);


    var crud_type = "read";
    var request_type = "GET";
    var earliestTimelinePostDate = getLimitDateOfDomElement("earliest", "message_post");

    var key_value_pairs = {
        read : "yes",
        earliestTimelinePostDate: earliestTimelinePostDate
    };



    var obj = new TimelinePost(crud_type, request_type, key_value_pairs);
    obj.read();
}

function canIReadMoreTimelinePosts() {

    // Boundaries of the sides of the reference.
    var referencForLoadingMoreObjs = $("#reference-for-loading-more-timeline-posts").get(0).getBoundingClientRect();

    var windowHeight = $(window).height();

    // // DEBUG:
    // console.log("ref POS: " + referencForLoadingMoreObjs.top);

    if (referencForLoadingMoreObjs.top <= windowHeight) {
        return true
    }


    return false;
}