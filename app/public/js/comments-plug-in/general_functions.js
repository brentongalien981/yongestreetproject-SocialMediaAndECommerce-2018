function doCommentPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            // Unset loader el.
            var loaderEl = $("#loader-for-comment-plug-in");
            removeClonedLoaderEl(loaderEl);


            //
            setIsCommentReading(false);

            //
            if (!isCnAjaxResultOk(json)) {
                setNumOfFailedCommentAjaxRead(parseInt(getNumOfFailedCommentAjaxRead()) + 1);
            }

            //
            if (!getHasCommentInitializedFetching()) {
                initializeCommentsFetching();
            }

            break;

        case "show":
            break;
        case "create":
        case "update":
        case "delete":
        case "fetch":

            // If there's no comments fetched, just carry on fetching.
            // Otherwise,  wait for the DOM to display the new comment
            // so that there will be no conflict on the latest of the
            // nextly-fetched-comments.
            // The method setIsCommentFetching(false) will be called then
            // once the newly fetched comments have been successfully INSERTED.
            if (!isCnAjaxResultOk(json)) {
                setIsCommentFetching(false);
            }

            break;
        case "patch":
            break;
    }
}

function doCommentAfterEffects(className, crudType, json, xObj) {

    switch (crudType) {
        case "read":
            displayComments(json, crudType);
            break;
        case "show":
            break;
        case "create":
            // On ajax after-effects, app clears the #comment-textarea.
            $("#comments-plug-in").find("#comment-textarea").val("");
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            displayComments(json, crudType);
            break;
        case "patch":
            break;
    }
}

function displayComments(json, crudType) {
    doPreDisplayComments();
    doRegularDisplayComments(json, crudType);
    doPostDisplayComments();
}

/**
 * App checks if there is at least one comment-item
 * displayed. If not, app shows the element
 * .no-comments-to-show-label.
 */
function doPostDisplayComments() {
    var commentItems = $(".comment-plug-in-item");

    if (commentItems.length == 0) {
        $("#comments-plug-in").find(".no-comments-to-show-label").css("display", "block");
    } else {
        $("#comments-plug-in").find(".no-comments-to-show-label").css("display", "none");
    }
}

function doRegularDisplayComments(json, crudType) {

    //
    var comments = json.objs;

    // App loops through the returned json-objs.
    for (var i = 0; i < comments.length; i++) {

        var comment = comments[i];

        // App clones the #comment-plug-in-item-template.
        var commentPlugInItem = cnCloneTemplateEl("comment-plug-in-item-template");

        // App fills-in the cloned template with details from the currently iterated json-obj.
        setCommentPlugInItem(commentPlugInItem, comment);

        //
        if (crudType == "read") {

            // App appends the cloned template to
            // #comments-plug-in / .actual-comments-section.

            var commentItemContainer = $("#comments-plug-in").find(".actual-comments-section");
            $(commentItemContainer).append($(commentPlugInItem));
        }
        else if (crudType == "fetch") {

            // If the crud-type is “fetch”, then app inserts
            // the cloned template to  #comments-plug-in-container.
            // Meaning, insert the commentPlugInItem after the
            // element .no-comments-to-show-label.
            var noCommentsToShowLabel = $("#comments-plug-in").find(".no-comments-to-show-label");
            $(commentPlugInItem).insertAfter(noCommentsToShowLabel);

        }

    }

    //
    if (crudType == "fetch") {
        setIsCommentFetching(false);
    }

}

/**
 * Fill-in the cloned template with details from the currently iterated json-obj.
 * @param commentPlugInItem is the cloned template.
 * @param comment is the json-obj.
 */
function setCommentPlugInItem(commentPlugInItem, comment) {

    // Initialize the commentPlugInItem (set the attributes).
    $(commentPlugInItem).addClass("comment-plug-in-item");


    // Set attr of unique id (unique node id).
    $(commentPlugInItem).attr("node-id", comment["id"]);


    // Set the poster-user-photo.
    var photoUrl = comment["posterUserProfile"]["pic_url"];
    if (photoUrl != null && photoUrl != "0") {
        $(commentPlugInItem).find(".comment-poster-user-photo").attr("src", photoUrl);
    }


    // Set the poster-user-name and her profile link.
    var userName = comment["commentPosterUser"]["user_name"];
    $(commentPlugInItem).find(".comment-poster-user-name").html(userName);
    var profileLink = get_local_url() + "profile/index.php?user_name=" + userName;
    $(commentPlugInItem).find(".comment-poster-user-name").attr("href", profileLink);


    // Set the comment-creation-date attribute (created_at).
    var creationDate = comment["created_at"];
    $(commentPlugInItem).attr("created-at", creationDate);


    // Set the human-readable-date when the comment was created.
    var readableCreationDate = comment["human_date"];
    $(commentPlugInItem).find(".comment-date").html(readableCreationDate);


    // Set the message of the comment.
    var message = comment["message"];
    $(commentPlugInItem).find(".comment-message").html(message);

}

function doPreDisplayComments() {
    
}