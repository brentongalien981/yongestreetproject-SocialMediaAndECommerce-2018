function do_timeline_post_reply_after_effects(class_name, crud_type, json, x_obj) {

    switch (crud_type) {
        case "read":
            display_timeline_post_replies(crud_type, json, x_obj);
            break;
        case "create":

            //
            var timeline_post_id = x_obj.key_value_pairs.parent_post_id;
            var timelinePostReplyId = json.timelinePostReplyId;

            // Clear the textarea.
            $("#replyForm" + timeline_post_id).find("textarea").val("");



            // window.alert("Your comment was SUCCESSFULLY posted." + "#replyForm" + timeline_post_id);

            // creates timeline-post-reply-notification records
            create_timeline_post_reply_notifications(timeline_post_id, timelinePostReplyId);
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            display_timeline_post_replies(crud_type, json, x_obj);
            break;
        case "patch":
            break;
    }
}

function display_timeline_post_replies(crud_type, json, x_obj) {
    // Because I'm just basically re-using this method from the menu timeline-posts,
    // I'm sticking to the var posts instead of timeline_post_replies and
    // p instead of tpr...
    var posts = json.objs;

    //
    for (i = 0; i < posts.length; i++) {

        var p = posts[i];

        /* post_el */
        var post_el = document.createElement("div");
        post_el.id = "comment" + p["id"];
        $(post_el).addClass("replies");
        $(post_el).attr("created-at", p["date_posted"]);


        /* post_details_bar */
        var post_details_bar = get_comment_details_bar(p);


        /* post's main content */
        var post_main_content = get_comment_main_content(p);


        /* Append */
        //
        $(post_el).append($(post_details_bar));
        $(post_el).append($(post_main_content));


        // @deprecated: THIS CHUNK IS DEPRECATED.
        // /* Append the comment/post_el to the parent-timeline-post. */
        // // parent_timeline_post_id
        // // ish
        // // var the_post_id = json.timeline_post_id;
        // var the_post_id = x_obj.key_value_pairs.timeline_post_id;
        // var parent_timeline_post_el = $("#post" + the_post_id).get(0);
        //
        // // var the_reply_form_el = $(parent_timeline_post_el).find(".replyForm").get(0);
        //
        // var the_view_more_comments_button_el = $(parent_timeline_post_el).find(".my-view-more-comments-btn").get(0);
        //
        // // $(post_container).append($(post_el));
        // $(post_el).insertBefore(the_view_more_comments_button_el);



        /* Append the reply to the replies-container. */
        var the_post_id = x_obj.key_value_pairs.timeline_post_id;
        var theRepliesContainer = $("#post" + the_post_id).find(".replies-container")[0];
        $(theRepliesContainer).append($(post_el));
    }

}

function get_timeline_post_num_of_comments(timeline_post_id) {
    return $("#post" + timeline_post_id).find(".replies").length;
}

function doTimelinePostReplyPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            var parentPostId = xObj.key_value_pairs.timeline_post_id;
            enableViewMoreCommentsBtnForThisPost(parentPostId);

            var loaderEl = $("#post" + parentPostId).find(".mcn-loader-el");
            removeClonedLoaderEl(loaderEl);
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