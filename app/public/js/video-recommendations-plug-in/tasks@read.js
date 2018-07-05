function initVideoRecommendationsPlugInContainer(videoRecommendationsPlugInContainer) {

    // Attach the plug-in to DOM.
    var videoRecommendationsPlugIn = $("#video-recommendations-plug-in");
    $(videoRecommendationsPlugInContainer).append($(videoRecommendationsPlugIn));



    // /* TODO: Delete this. */
    // Attach some sample video-recommendation-items to DOM.
    // for (i = 0; i < 3; i++) {
    //
    //     // Clone the #video-recommendation-item-template.
    //     var videoRecommendationItemEl = cnCloneTemplateEl("video-recommendation-item-template");
    //     initVideoRecommendationItemEl(videoRecommendationItemEl);
    //
    //     // Append to DOM.
    //     var actualItemsContainer = $("#video-recommendations-plug-in").find(".actual-items-container").append($(videoRecommendationItemEl));
    //
    //     // Add resize-listener.
    //     addResizeListenerToVideoRecommendationItemEl(videoRecommendationItemEl);
    // }
}