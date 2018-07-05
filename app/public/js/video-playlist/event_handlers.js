function addEventListenersToVideoRecommendationItem(videoRecommendationItem) {

    //
    var thumbNailMask = $(videoRecommendationItem).find(".video-thumbnail-masks");
    var thumbNail = $(videoRecommendationItem).find(".video-thumbnails");

    //
    $(thumbNailMask).mouseover(function () {
        $(thumbNail).css("box-shadow", "0 0 30px rgb(20, 20, 20)");
    });

    //
    $(thumbNailMask).mouseout(function () {
        $(thumbNail).css("box-shadow", "none");
    });
}