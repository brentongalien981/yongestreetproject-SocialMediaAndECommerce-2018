$("#comments-plug-in").find(".post-comment-btn").click(function (event) {

    createComment();
});

$("#comments-plug-in").find(".show-more-comments-btn").click(function (event) {

    /* */
    var loaderContainer = $("#comments-plug-in").find(".loader-element-container");
    readComments(loaderContainer);
});