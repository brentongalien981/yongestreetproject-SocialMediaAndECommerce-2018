function setVideoThumbnailHoldersHeight() {
    var width = $(".video-thumbnails").width();
    var height = width * 0.5625;

    $(".video-thumbnails").height(height);

}

function doVideoPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            // Unset loader el.
            var loaderEl = $("#loader-for-video-xxx");
            removeClonedLoaderEl(loaderEl);
            break;

        case "show":

            //
            var loaderEl = $("#loader-for-show-video-xxx");
            removeClonedLoaderEl(loaderEl);
            break;

        case "create":
        case "update":
        case "delete":
        case "fetch":
        case "patch":
            break;
    }
}

function doVideoAfterEffects(className, crudType, json, xObj) {
    switch (crudType) {
        case "read":

            displayVideos(json, xObj);

            break;

        case "show":

            soloDisplayVideo(json);


            /* Set the identityOfRateStatusContainer. */
            var video = json.objs[0];
            var rateableItemId = video["rateableItem"]["rateable_item_id"];

            //
            var rateStatusContainer = $(".rate-status-container")[0];

            //
            setIdentityOfRateStatusContainer(rateStatusContainer, rateableItemId)


            /*
                Set the rate-status-item-containers (the pseudo-buttons of
                the rate-status-container).
            */
            readUserTwoCentsOfRateableItem(rateableItemId);
            readRatingSigmaOfRateableItem(rateableItemId);
            readAverageRatingOfRateableItem(rateableItemId);

            /* */
            var loaderContainer = $("#comments-plug-in").find(".loader-element-container");
            readComments(loaderContainer);

            /**/
            readVideoRecommendationItems();

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

function getVideoCategoryContainer(readForPageSection) {


    var videoCategoryContainer = null;

    // Checks if the video-category-container that is being populated has already done a previous read.
    if (readForPageSection == null) {

        videoCategoryContainer = cnCloneTemplateEl("video-category-container-template");
        $(videoCategoryContainer).addClass("video-category-containers");
        $(videoCategoryContainer).attr("pageSection", "recommended");
    }
    else if (readForPageSection === "recommended") {

        // alert ("YEAH RECOMMENDED");
        videoCategoryContainer = $("[pageSection=recommended]");
    }

    //
    if (readForPageSection != null) {
        $(videoCategoryContainer).attr("id", readForPageSection + "-videos-section");
    }
    else {
        $(videoCategoryContainer).attr("id", "recommended-videos-section");
    }


    //
    return videoCategoryContainer;
}

function soloDisplayVideo(json) {

    //
    var videos = json.objs;

    //
    for (var i = 0; i < videos.length; i++) {

        //
        var video = videos[i];

        //
        setSoloVideoItemEl(video);
        fillVideoMetaDetailsContainer(video);

    }
}

function setSoloVideoItemEl(video) {

    var videoFrame = $(".video-container").find(".video-item")[0];
    var youtubeVideoSrcExtraDetails = "?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1";
    // var youtubeVideoSrcExtraDetails = "?autoplay=1";
    var videoSrc = video["url"] + youtubeVideoSrcExtraDetails;

    var videoId = "video" + video["id"];
    $(videoFrame).attr("id", videoId);
    $(videoFrame).attr("src", videoSrc);
    $(videoFrame).attr("rateable-item-id", video["rateableItem"]["rateable_item_id"]);
    $(videoFrame).css("display", "block");
}

function fillVideoMetaDetailsContainer(video) {

    $("#video-meta-details-container h3").html(video["title"]);
    $("#video-meta-details-container .poster-user-name").html("by " + video["poster_user_name"]);
    $("#video-meta-details-container .upload-date").html("uploaded " + video["human_date"]);
    $("#video-meta-details-container .description").html(video["description"]);

    $("#video-meta-details-container").css("display", "block");
}

function displayVideos(json, xObj) {

    //
    var videos = json.objs;

    // Figure out which page section calls the reading of the videos. It could be
    // the "Featured Section", "Recommended Section", etc...
    var readForPageSection = xObj.key_value_pairs["readForPageSection"];

    //
    var videoCategoryContainer = getVideoCategoryContainer(readForPageSection);



    // Iterates through all the video-json-objects.
    for (var i = 0; i < videos.length; i++) {

        var video = videos[i];


        // Check if same video is already displayed.
        if (isVideoDisplayed(video["id"])) { continue; }


        // Clones a video-item-template.
        var videoItem = cnCloneTemplateEl("video-recommendation-item-template");

        //
        setVideoRecommendationItem(videoItem, video);


        // Appends the cloned template to the video-item-container.
        var videosSection = $(videoCategoryContainer).find(".videos-sections")[0];
        $(videosSection).append($(videoItem));
    }


    //
    $("#cn-center-col").append($(videoCategoryContainer));

    //
    setCenterCol();


    //
    var showMoreVideosBtn = $(videoCategoryContainer).find("button");
    addClickListenerToShowMoreVideosBtn(showMoreVideosBtn);

    //
    setHasDoneInitialReadAttr(videoCategoryContainer);

}

/**
 * fills-in the cloned template with details from the currently iterated video-json-obj.
 * @param videoRecommendationItem
 * @param video
 */
function setVideoRecommendationItem(videoRecommendationItem, video, playlistId, doOpenLinkInCurrentTab) {

    var videoId = (video["id"] != null) ? video["id"] : video["video_id"];

    $(videoRecommendationItem).addClass("video-recommendation-item");
    $(videoRecommendationItem).attr("id", "video" + videoId);
    $(videoRecommendationItem).attr("video-id", videoId);

    // If this method is for showing thumbnails to a
    // playlist, the use date when this particular video
    // was added to the playlist and not when this video was uploaded
    // so that you can use that attr ("created_at" which is the "dateAddedToPlaylist")
    // for reading more playlist-videos.
    if (playlistId != null) {
        $(videoRecommendationItem).attr("created-at", video["dateAddedToPlaylist"]);
    } else {
        $(videoRecommendationItem).attr("created-at", video["created_at"]);
    }



    // Set the actual video-frame.
    var videoFrame = $(videoRecommendationItem).find("iframe")[0];
    var youtubeVideoSrcExtraDetails = "?rel=0&amp;controls=0&amp;showinfo=0";
    var videoSrc = video["url"] + youtubeVideoSrcExtraDetails;
    $(videoFrame).attr("src", videoSrc);


    //
    // setVideoMaskHref(videoRecommendationItem, videoSrc);
    if (playlistId != null) {
        setVideoMaskHref(videoRecommendationItem, videoId, playlistId, doOpenLinkInCurrentTab);
    }
    else {
        setVideoMaskHref(videoRecommendationItem, videoId);
    }


    // Set the video title.
    var videoThumbnailTitle = $(videoRecommendationItem).find(".video-thumbnail-titles")[0];
    // var videoTitle = getBreakPointReactiveVideoTitle(video["title"]);
    var videoTitle = video["title"];
    $(videoThumbnailTitle).html(videoTitle);

    var videoAlt = video["title"];
    $(videoThumbnailTitle).attr("title", videoAlt);


    var videoTitleHref = getVideoTitleHref(videoId, playlistId);
    $(videoThumbnailTitle).attr("href", videoTitleHref);



    // Set the name of the poster (the user).
    var posterUserNameEl = $(videoRecommendationItem).find(".video-thumbnail-poster-user-names")[0];
    $(posterUserNameEl).html(video["poster_user_name"]);

    var videoUploaderLinkHref = getVideoUploaderLinkHref(video["poster_user_name"]);
    $(posterUserNameEl).attr("href", videoUploaderLinkHref);
}

function setVideoThumbnailMask(videoItem) {

    var videoThumbnailContainer = $(videoItem).find(".video-thumbnail-containers")[0];

    var videoThumbnailContainerHeight = $(videoThumbnailContainer).height();


    var videoThumbnailMask = $(videoItem).find(".video-thumbnail-masks")[0];

    $(videoThumbnailMask).css("margin-top", "-" + videoThumbnailContainerHeight + "px");
}

function setVideoThumbnailMasks() {

    var videoThumbnailContainers = $(".video-thumbnail-containers");

    var videoThumbnailContainerHeight = $(videoThumbnailContainers).height();


    var videoThumbnailMasks = $(".video-thumbnail-masks");

    $(videoThumbnailMasks).css("margin-top", "-" + videoThumbnailContainerHeight + "px");
}





function setVideoThumbnailContainerHeight(videoItem) {

    var videoThumbnailContainer = $(videoItem).find(".video-thumbnail-containers")[0];

    var width = $(videoThumbnailContainer).width();
    var height = width * 0.5625;

    $(videoThumbnailContainer).height(height);
}

function setVideoThumbnailContainersHeight() {

    var videoThumbnailContainers = $(".video-thumbnail-containers");

    var width = $(videoThumbnailContainers).width();
    var height = width * 0.5625;

    $(videoThumbnailContainers).height(height);
}

function setVideoThumbnailContainersWidth() {

    //video-recommendation-item-template
    var videoRecommendationItems = $(".video-recommendation-item");

    var videoThumbnailContainers = $(".video-thumbnail-containers");

    var width = $(videoRecommendationItems).width();

    $(videoThumbnailContainers).width(width);
}

function setVideoMaskHref(videoItem, videoId, playlistId, doOpenLinkInCurrentTab) {

    var mask = $(videoItem).find(".video-thumbnail-masks")[0];

    //
    var href = get_local_url() + "video/show.php?id=" + videoId;

    if (playlistId != null) {
        href += "&playlist_id=" + playlistId;
    }

    //
    $(mask).attr("href", href);

    if (doOpenLinkInCurrentTab != null) {
        $(mask).removeAttr("target");
    }
}

function getBreakPointReactiveVideoTitle(rawTitle) {

    var breakPointName = cnGetBreakPointName();
    var adjustedTitle = rawTitle;
    var maxNumOfChars = 11;

    switch (breakPointName) {
        case "xs":
            maxNumOfChars = 28;
            break;
        case "sm":
            maxNumOfChars = 32;
            break;
        case "md":
            maxNumOfChars = 11;
            break;
        case "lg":
            maxNumOfChars = 14;
            break;
    }

    // maxNumOfChars -= 3;

    // if (rawTitle.length > maxNumOfChars) {
    //     adjustedTitle = rawTitle.substring(0, maxNumOfChars);
    //     adjustedTitle += "..";
    // }


    return adjustedTitle;
}



function getVideoTitleHref(videoId, playlistId) {


    //
    var href = get_local_url() + "video/show.php?id=" + videoId;

    //
    if (playlistId != null) {
        href += "&playlist_id=" + playlistId;
    }

    //
    return href;
}

function getVideoUploaderLinkHref(uploaderUserName) {

    //
    var href = get_local_url() + "profile/index.php?user_name=" + uploaderUserName;

    //
    return href;
}

function isVideoDisplayed(videoId) {

    var videoEls = $(".video-recommendation-item");

    for (var i = 0; i < videoEls.length; i++) {

        var currentVideoId = $(videoEls[i]).attr("id");

        if (currentVideoId === ("video" + videoId)) {
            cnLog("Video is already displayed");
            return true;
        }

    }

    cnLog("Video is NOT yet displayed");
    return false;
}

function setHasDoneInitialReadAttr(videoCategoryContainer) {

    $(videoCategoryContainer).attr("hasDoneInitialRead", "yes");
}