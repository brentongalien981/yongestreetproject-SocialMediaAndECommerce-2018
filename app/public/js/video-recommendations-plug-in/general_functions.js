function initVideoRecommendationItemEl(el) {

    setVideoRecommendationItemWidth(el);
    setVideoRecommendationItemHeight(el);
    setVideoRecommendationItemThumbnailMasks(el);

    setVideoRecommendationItemElOrientation(el, "portrait");
}

function setVideoRecommendationItemElOrientation(el, orientation) {

    //
    $(el).removeClass("col-md-6");

    //
    if (orientation == "landscape") {
        $(el).addClass("row");

        //
        $(el).find(".video-thumbnail-containers").removeClass("col-6");
        $(el).find(".video-thumbnail-containers").addClass("col-lg-6 col-md-7 col-sm-12");

        //
        $(el).find(".video-thumbnail-details-containers").removeClass("col-4");
        $(el).find(".video-thumbnail-details-containers").addClass("col-lg-5 col-md-5 col-sm-12");

    }


}

function doVideoRecommendationItemPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            // Unset loader el.
            var loaderEl = $("#loader-for-video-recommendation-plug-in");
            removeClonedLoaderEl(loaderEl);


            //
            setIsVideoRecommendationItemReading(false);

            //
            if (!isCnAjaxResultOk(json)) {
                setNumOfFailedVideoRecommendationItemAjaxRead(parseInt(getNumOfFailedVideoRecommendationItemAjaxRead()) + 1);
            }

            // // TODO: Do this on CRUD: fetch.
            // if (!getHasCommentInitializedFetching()) {
            //     initializeCommentsFetching();
            // }

            break;

        case "show":
            break;
        case "create":
        case "update":
        case "delete":
        case "fetch":
            break;
        case "patch":
            break;
    }
}


function doVideoRecommendationItemAfterEffects(className, crudType, json, xObj) {

    switch (crudType) {
        case "read":
            displayVideoRecommendationItems(json, crudType);
            break;
        case "show":
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


function displayVideoRecommendationItems(json, crudType) {
    doPreDisplayVideoRecommendationItems();
    doRegularDisplayVideoRecommendationItems(json, crudType);
    doPostDisplayVideoRecommendationItems(crudType);
}

function doPostDisplayVideoRecommendationItems(crudType) {

    //
    if (crudType == "fetch") {
        // TODO: Delete this.
        return;

        setIsCommentFetching(false);
    }
}

function doRegularDisplayVideoRecommendationItems(json, crudType) {

    //
    var videoRecommendationItems = json.objs;

    // App loops through the returned json-objs.
    for (var i = 0; i < videoRecommendationItems.length; i++) {

        var videoRecommendationItem = videoRecommendationItems[i];

        // App clones the #video-recommendation-item-template.
        var videoRecommendationItemEl = cnCloneTemplateEl("video-recommendation-item-template");


        //
        initVideoRecommendationItemEl(videoRecommendationItemEl);


        // App fills-in the cloned template with details from the currently iterated json-obj.
        setVideoRecommendationItem(videoRecommendationItemEl, videoRecommendationItem);


        //
        addResizeListenerToVideoRecommendationItemEl(videoRecommendationItemEl);


        //
        if (crudType == "read") {

            // App appends the cloned template to
            // #comments-plug-in / .actual-comments-section.

            var itemsContainer = $("#video-recommendations-plug-in").find(".actual-items-container");
            $(itemsContainer).append($(videoRecommendationItemEl));
        }
        else if (crudType == "fetch") {

            // TODO: Delete this.
            return;

            // If the crud-type is “fetch”, then app inserts
            // the cloned template to  #comments-plug-in-container.
            // Meaning, insert the commentPlugInItem after the
            // element .no-comments-to-show-label.
            var noCommentsToShowLabel = $("#comments-plug-in").find(".no-comments-to-show-label");
            $(commentPlugInItem).insertAfter(noCommentsToShowLabel);

        }

    }

}

function doPreDisplayVideoRecommendationItems() {

}