function initializeCommentsFetching() {
    setHasCommentInitializedFetching(true);

    // App sets interval for fetching comments.
    commentIntervalFetchHandler = setInterval(fetchComments, 5000);
}

function fetchComments() {

    var isOkToProceed = doPreFetchComments();

    if (!isOkToProceed) { return; }
    
    doRegularFetchComments();
}

function doRegularFetchComments() {

    // App dom-gets the id of the rateable-item (with type rateable-item-type: video)
    var rateableItemId = getIdOfRateableItem();

    //
    if (rateableItemId == null) { return; }

    var crud_type = "fetch";
    var request_type = "GET";
    var latestElDate = getLimitDateOfDomElement("latest", "comment-plug-in-item");


    var key_value_pairs = {
        fetch: "yes",
        rateable_item_id: rateableItemId,
        latest_el_date: latestElDate
    };


    var obj = new Comment(crud_type, request_type, key_value_pairs);
    obj.fetch();
}

function doPreFetchComments() {
    //
    if (getIsCommentFetching()) { return false; }
    setIsCommentFetching(true);

    return true;
}