function getIsTimelinePostReplyReading(post_id) {

    var viewMoreCommentsBtn = $("#post" + post_id).find(".my-view-more-comments-btn")[0];

    var isReading = $(viewMoreCommentsBtn).attr("disabled");

    if (isReading != null && isReading == "yes") { return true; }

    return false;
}