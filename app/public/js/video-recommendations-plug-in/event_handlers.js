function addResizeListenerToVideoRecommendationItemEl(videoRecommendationItemEl) {

    $(window).resize(function () {

        setVideoRecommendationItemWidth(videoRecommendationItemEl);
        setVideoRecommendationItemHeight(videoRecommendationItemEl);

        setVideoRecommendationItemThumbnailMasks(videoRecommendationItemEl);

    });
}

function setVideoRecommendationItemWidth(el) {

    var videoRecommendationItem = el;

    var videoThumbnailContainer = $(el).find(".video-thumbnail-containers");

    var width = $("#video-recommendations-plug-in").width();
    width = roundToTwo(width);

    $(videoThumbnailContainer).width(width);

    cnLog("####################################");
    cnLog("videoThumbnailContainer: " + $(videoThumbnailContainer).css("width"));
    cnLog("plug-in width: " + width);
    cnLog("recommendation-item width: " + $(el).width());
    cnLog("videoThumbnailContainer width: " + $(videoThumbnailContainer).width());
    cnLog("####################################");
}

function setVideoRecommendationItemHeight(el) {

    var videoThumbnailContainer = $(el).find(".video-thumbnail-containers");

    var width = $("#video-recommendations-plug-in").width();
    var height = width * 0.5625;
    height = roundToTwo(height);

    $(videoThumbnailContainer).height(height);
}

function setVideoRecommendationItemThumbnailMasks(el) {

    var videoThumbnailContainer = $(el).find(".video-thumbnail-containers");

    var videoThumbnailContainerHeight = $(videoThumbnailContainer).height();


    var videoThumbnailMask = $(el).find(".video-thumbnail-masks");

    $(videoThumbnailMask).css("margin-top", "-" + videoThumbnailContainerHeight + "px");
}