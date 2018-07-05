function initVideoRecommendationItemTemplate() {
    setVideoRecommendationItemTemplateDefaultOrientation("landscape");
}

function setVideoRecommendationItemTemplateDefaultOrientation(orientation) {

    /* TODO: DEBUG: Set the video thumbnails. */
    var videoRecommendationItemTemplate = $("#video-recommendation-item-template");
    // $("#video-playlist-shell").append($(videoRecommendationItemTemplate));

    if (orientation == "landscape") {
        $(videoRecommendationItemTemplate).removeClass("col-md-6");
        $(videoRecommendationItemTemplate).addClass("row");

        //
        $(videoRecommendationItemTemplate).find(".video-thumbnail-containers").removeClass("col-6");
        $(videoRecommendationItemTemplate).find(".video-thumbnail-containers").addClass("col-lg-6 col-md-7 col-sm-12");

        //
        $(videoRecommendationItemTemplate).find(".video-thumbnail-details-containers").removeClass("col-4");
        $(videoRecommendationItemTemplate).find(".video-thumbnail-details-containers").addClass("col-lg-5 col-md-5 col-sm-12");

    }


}

function doPlaylistPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":
            break;
        case "show":

            setArePlaylistVideosShowing(false);

            //
            if (!isCnAjaxResultOk(json)) {
                setNumOfFailedPlaylistVideosAjaxShow(parseInt(getNumOfFailedPlaylistVideosAjaxShow()) + 1);
            }

            setPlaylistVideoErrorMessage(json);

            break;
        case "create":
        case "update":
        case "delete":
        case "fetch":
        case "patch":
            break;
    }
}


function setPlaylistVideoErrorMessage(json) {

    var hasActualError = (json.comments.length > 0) ? true : false;

    if (!isCnAjaxResultOk(json) && hasActualError) {

        //
        $("#video-playlist").find("#error-showing-playlist-message").css("display", "block");
        $("#video-playlist").find("#error-showing-playlist-message").html("Sorry, but that playlist doesn't exist.");

        //
        for (i = 0; i < json.comments.length; i++) {
            if (json.comments[i] === "Sorry, but this playlist is private.") {
                $("#video-playlist").find("#error-showing-playlist-message").html("Sorry, but this playlist is private.");
                break;
            }
        }
    }
    else {
        $("#video-playlist").find("#error-showing-playlist-message").css("display", "none");
    }
}

function doPlaylistAfterEffects(className, crudType, json, xObj) {

    switch (crudType) {
        case "read":
            break;
        case "show":
            displayPlaylistVideos(json);
            break;
        case "create":
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            break;
        case "patch":
            break;
    }
}

function displayPlaylistVideos(json) {
    doPreDisplayPlaylistVideos(json);
    doRegularDisplayPlaylistVideos(json);
    doPostDisplayPlaylistVideos();
}

function doPostDisplayPlaylistVideos() {

}

function doRegularDisplayPlaylistVideos(json) {

    //
    var playlist = json.objs;
    var playlistId = playlist.playlist_id;
    var videos = playlist.videos;
    var doOpenLinkInCurrentTab = true;

    // Loop through the returned video-objs.
    for (var i = 0; i < videos.length; i++) {

        var video = videos[i];

        // Clone the #video-recommendation-item-template.
        var videoRecommendationItem = cnCloneTemplateEl("video-recommendation-item-template");


        // Fill-in the cloned template with details from the
        // currently iterated video-json-obj.
        setVideoRecommendationItem(videoRecommendationItem, video, playlistId, doOpenLinkInCurrentTab);

        //
        addEventListenersToVideoRecommendationItem(videoRecommendationItem);


        // Append the cloned template to the video-recommendation-items-container.
        $("#video-playlist-shell").append($(videoRecommendationItem));
    }
}

function doPreDisplayPlaylistVideos(json) {

    // Display the playlist.
    //
    var playlist = json.objs;
    var videos = playlist.videos;

    if (videos.length > 0) {

        // Set the title element of the playlist.
        // $(".video-playlist-items-container-title").html(playlist.title);

        $("#video-playlist").find("#video-playlist-title").html(playlist.title);
    }
}