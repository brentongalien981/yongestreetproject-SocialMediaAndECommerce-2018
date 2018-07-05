function readVideoRecommendationItems() {

    var isOkToProceed = doPreReadVideoRecommendationItems();

    if (!isOkToProceed) {
        return;
    }

    doRegularReadVideoRecommendationItems();
    doPostReadVideoRecommendationItems();
}


function doPostReadVideoRecommendationItems() {

}


function doRegularReadVideoRecommendationItems() {

    // App dom-gets the id of the rateable-item (with type rateable-item-type: video)
    var rateableItemId = getIdOfRateableItem();
    var videoId = getIdOfShownVideo();

    //
    if (rateableItemId == null || videoId == 0) {
        return;
    }


    /**/
    var videoIdsOfAlreadyRecommendededItems = getVideoIdsOfAlreadyRecommendededItems();
    var stringifiedVideoIdsOfAlreadyRecommendededItems = cnStringify(videoIdsOfAlreadyRecommendededItems);

    var crud_type = "read";
    var request_type = "GET";
    var earliestElDate = getLimitDateOfDomElement("earliest", "video-recommendation-item");


    var key_value_pairs = {
        read: "yes",
        rateable_item_id: rateableItemId,
        video_id: videoId,
        stringified_video_ids_of_already_recommendeded_items: stringifiedVideoIdsOfAlreadyRecommendededItems,
        earliest_el_date: earliestElDate
    };


    var obj = new VideoRecommendationItem(crud_type, request_type, key_value_pairs);
    obj.read();

}


function getVideoIdsOfAlreadyRecommendededItems() {

    var videoIdsOfAlreadyRecommendededItems = [];

    var alreadyRecommendedVideoItems = $("#video-recommendations-plug-in").find(".video-recommendation-item");

    for (i = 0; i < alreadyRecommendedVideoItems.length; i++) {
        var currentVideoId = $(alreadyRecommendedVideoItems[i]).attr("video-id");

        videoIdsOfAlreadyRecommendededItems[i] = currentVideoId;

    }

    return videoIdsOfAlreadyRecommendededItems;
}


function doPreReadVideoRecommendationItems() {

    //
    if (getIsVideoRecommendationItemReading() || (getNumOfFailedVideoRecommendationItemAjaxRead() >= 3)) {
        return false;
    }
    setIsVideoRecommendationItemReading(true);


    // App shows the loaders element.
    // Set the loader element.
    var loaderMsg = "Loading recommended videos...";
    var loaderId = "video-recommendation-plug-in";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#video-recommendations-plug-in").find(".loader-element-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);

    return true;
}