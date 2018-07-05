function initCommentsPlugIn(commentsPlugInContainer) {

    var commentsPlugIn = $("#comments-plug-in");
    $(commentsPlugInContainer).append($(commentsPlugIn));
    // $("#cn-center-col").append($(commentsPlugInContainer));


    // // TODO: Delete this later: Append sample comment-items to DOM.
    // for (i=0; i<10; i++) {
    //     var commentItem = cnCloneTemplate("#comment-plug-in-item-template");
    //     $(commentItem).addClass("comment-plug-in-item");
    //     $(commentsPlugIn).find(".actual-comments-section").append($(commentItem));
    // }

}