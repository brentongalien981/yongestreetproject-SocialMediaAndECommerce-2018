function doPlaylistPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":
            break;
        case "show":

            setIsPlaylistShowing(false);

            //
            if (!isCnAjaxResultOk(json)) {
                setNumOfFailedPlaylistAjaxShow(parseInt(getNumOfFailedPlaylistAjaxShow()) + 1);
            }

            break;
        case "create":
        case "update":
        case "delete":
        case "fetch":
        case "patch":
            break;
    }
}

function doPlaylistAfterEffects(className, crudType, json, xObj) {

    switch (crudType) {
        case "read":
            break;
        case "show":
            displayPlaylistVideoThumbnails(json);
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

function displayPlaylistVideoThumbnails(json) {
    doPreDisplayPlaylistVideoThumbnails(json);
    doRegularDisplayPlaylistVideoThumbnails(json);
    doPostDisplayPlaylistVideoThumbnails();
}

function doPreDisplayPlaylistVideoThumbnails(json) {

    // Display the playlist.
    //
    var playlist = json.objs;
    var videos = playlist.videos;

    if (videos.length > 0) {

        initVideoPlaylistPlugIn();

        // Set the title element of the playlist.
        var playlist = json.objs;
        var playlistUrl = get_local_url() + "video-playlist/show.php?id=" + playlist.playlist_id;

        $(".video-playlist-items-container-title").html(playlist.title);
        $(".video-playlist-items-container-title").attr("href", playlistUrl);
    }
}

function doRegularDisplayPlaylistVideoThumbnails(json) {

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


        // Append the cloned template to the video-recommendation-items-container.
        var videoRecommendationItemContainer = $("#video-playlist-plug-in").find(".video-recommendation-items-container")[0];
        $(videoRecommendationItemContainer).append($(videoRecommendationItem));
    }
}

function doPostDisplayPlaylistVideoThumbnails() {

    setPlaylistVideoThumbnailsDimensions();
}

function setPlaylistVideoThumbnailsDimensions() {

    setPlaylistVideoThumbnailContainersWidth();
    setPlaylistVideoThumbnailContainersHeight();

    setPlaylistVideoThumbnailMasks();
}

function setPlaylistVideoThumbnailMasks() {

    var videoThumbnailContainers = $("#video-playlist-plug-in").find(".video-thumbnail-containers");

    var videoThumbnailContainerHeight = $(videoThumbnailContainers).height();


    var videoThumbnailMasks = $("#video-playlist-plug-in").find(".video-thumbnail-masks");

    $(videoThumbnailMasks).css("margin-top", "-" + videoThumbnailContainerHeight + "px");
}
function setPlaylistVideoThumbnailContainersHeight() {

    var videoThumbnailContainers = $("#video-playlist-plug-in").find(".video-thumbnail-containers");

    var width = $(videoThumbnailContainers).width();
    var height = width * 0.5625;
    height = roundToTwo(height);

    $(videoThumbnailContainers).height(height);
    // $(".video-thumbnails").height(height);
}

function setPlaylistVideoThumbnailContainersWidth() {

    //video-recommendation-item-template
    // var videoRecommendationItems = $(".video-recommendation-item");
    var videoRecommendationItems = $("#video-playlist-plug-in").find(".video-recommendation-item");

    var videoThumbnailContainers = $("#video-playlist-plug-in").find(".video-thumbnail-containers");

    var width = $(videoRecommendationItems).width();
    width = roundToTwo(width);

    $(videoThumbnailContainers).width(width);
    // $(".video-thumbnails").width(width);
}

function initVideoPlaylistPlugIn() {

    var videoPlaylistPlugIn = $("#video-playlist-plug-in");
    // $("#cn-center-col").append($(videoPlaylistPlugIn));

    $(videoPlaylistPlugIn).removeClass("initially-hidden-el");
}