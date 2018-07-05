function readComments(loaderContainer) {
    var isOkToProceed = doPreReadComments(loaderContainer);

    if (!isOkToProceed) { return; }

    doRegularReadComments();
    doPostReadComments();
}

function doPostReadComments() {

}

function doRegularReadComments() {

    // App dom-gets the id of the rateable-item (with type rateable-item-type: video)
    var rateableItemId = getIdOfRateableItem();

    //
    if (rateableItemId == null) { return; }

    var crud_type = "read";
    var request_type = "GET";
    var earliestElDate = getLimitDateOfDomElement("earliest", "comment-plug-in-item");

    var dataForGettingIdsOfAlreadyShownItems = {
        selector: "#comments-plug-in .comment-plug-in-item",
        attrNameOfUniqueId: "node-id"
    }
    var alreadyShownCommentIds = CnGeneral.getIdsOfAlreadyShownItems(dataForGettingIdsOfAlreadyShownItems);
    var stringifiedAlreadyShownCommentIds = cnStringify(alreadyShownCommentIds);


    var key_value_pairs = {
        read: "yes",
        rateable_item_id: rateableItemId,
        earliest_el_date: earliestElDate,
        stringified_already_shown_comment_ids: stringifiedAlreadyShownCommentIds
    };


    var obj = new Comment(crud_type, request_type, key_value_pairs);
    obj.read();

}

/**
 * App dom-gets the id of the rateable-item (with type rateable-item-type: video)
 * @returns {*}
 */
function getIdOfRateableItem() {
    var rateableItems = $(".rateable-item");
    var rateableItemId = null;

    for (i = 0; i < rateableItems.length; i++) {

        var rateableItem = rateableItems[i];

        rateableItemId = $(rateableItem).attr("rateable-item-id");

        if (rateableItemId != null || rateableItemId != "") {
            break;
        }
    }

    if (rateableItemId == "") {
        rateableItemId = null;
    }

    return rateableItemId;
}

/**
 * App checks if the rateable-item is already set
 * (if it has now the rateable-item-id attribute).
 * If it is not yet ready, then just keep looping (or sleeping)
 * until the rateable-item is set.
 */
function checkReadinessOfRateableItem() {

}

function doPreReadComments(loaderContainer) {

    //
    if (getIsCommentReading() || (getNumOfFailedCommentAjaxRead() >= 3)) { return false; }
    setIsCommentReading(true);


    // App shows the loaders element.
    // Set the loader element.
    var loaderMsg = "Loading comments...";
    var loaderId = "comment-plug-in";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    // var loaderContainer = $("#photo-main-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);

    return true;
}