function createComment() {

    var isOkToProceed = doPreCreateComment();

    if (!isOkToProceed) { return; }

    doRegularCreateComment();
    doPostCreateComment();
}

function doPostCreateComment() {
    
}

function doRegularCreateComment() {

    //
    var rateableItemId = getIdOfRateableItem();
    if (rateableItemId == null) { return; }

    var message = $("#comment-textarea").val();

    var crud_type = "create";
    var request_type = "POST";

    var key_value_pairs = {
        create: "yes",
        rateable_item_id: rateableItemId,
        message: message
    };



    var obj = new Comment(crud_type, request_type, key_value_pairs);
    obj.create();
}

function doPreCreateComment() {

    var isOkToProceed = false;

    if (!isNewCommentMessageEmpty()) {
        isOkToProceed = true;
    }

    return isOkToProceed;
}

/**
 * App checks if the new comment message is empty.
 * If it is, return true.
 * If it’s not, return false.
 * @returns {boolean}
 */
function isNewCommentMessageEmpty() {
    var newCommentMessage = $("#comment-textarea").val();

    if (newCommentMessage.trim().length == 0) {
        return true;
    }

    return false;
}