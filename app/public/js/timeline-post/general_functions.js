function get_timeline_post_latest_date() {

    // Just traverse the DOM for the date of the lates post.
    var latest_date_el = $(".message_post").find(".meta-date")[0];
    var latest_date = null;

    if (latest_date_el != null) {
        latest_date = $(".message_post").find(".meta-date")[0].innerHTML;
    }
    else {
        latest_date = "2010-09-11 10:54:45";
    }

    return latest_date;
}



function do_timeline_post_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            display_timeline_post(crud_type, json);

            break;
        case "create":

            // Clear the textarea.
            document.getElementById("message_post_textarea").value = "";

            //
            hide_create_post_form();
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            display_timeline_post(crud_type, json);
            break;
    }
}

function display_timeline_post(crud_type, json) {
    //
    var posts = json.objs;

    //
    for (i = 0; i < posts.length; i++) {
        var p = posts[i];

        /* post container */
        var post_container = document.createElement("div");
        post_container.setAttribute("class", "post_background");


        /* post_el */
        var post_el = document.createElement("div");
        // post_el.id = "post" + p["post_id"];
        post_el.id = "post" + p["id"];
        $(post_el).addClass("message_post");
        $(post_el).attr("created-at", p["date_posted"]);


        /* post_details_bar */
        var post_details_bar = get_post_details_bar(p);


        /* post's main content */
        var post_main_content = get_post_main_content(p);


        /* post's response bar */
        var post_response_bar = get_post_response_bar(p);


        /* This div is just to have a reference for appending the reply form. */
        var reference_div = document.createElement("div");
        $(reference_div).addClass("empty_div_shit");


        /**/
        var repliesContainer = document.createElement("div");
        $(repliesContainer).addClass("replies-container");


        /* Append */
        //
        $(post_el).append($(post_details_bar));
        $(post_el).append($(post_main_content));
        $(post_el).append($(post_response_bar));
        $(post_el).append($(reference_div));
        $(post_el).append($(repliesContainer));

        //
        $(post_container).append($(post_el));


        /* */
        dom_append_post(crud_type, post_container);


        /*ish*/
        appendLoaderElContainer(p["id"]);

        /* Append a view-more-comments-button. */
        append_view_more_comments_button(p["id"]);


        /* Add the post's reply-form */
        append_a_comment_form(p["id"]);



        /* Read the post's comments. */
        read_timeline_post_replies(p["id"]);



        /* Set the response bar. */
        if (crud_type == "fetch") {

            //
            create_rateable_item(p["id"]);

        }
        else if (crud_type == "read") {

            // This will always just read one rateable_item with one post_id.
            // var post_ids = [p["id"]];
            // read_rateable_item_ids(post_ids);
            var post_ids = [p["id"]];
            read_rateable_item_id(p["id"]);
        }
    }


    // Re-append the reference for loading more timeline posts.
    $("#main_content2").append($("#reference-for-loading-more-timeline-posts"));

}


function appendLoaderElContainer(postId) {

    var loaderElContainer = document.createElement("div");
    $(loaderElContainer).addClass("post-loader-el-container");
    $(loaderElContainer).css("display", "none");

    $("#post" + postId).append($(loaderElContainer));
}

/** @deprecated */
function set_main_content() {
    $('#main_content').css("background-color", "rgb(240, 240, 240)");
}

function doTimelinePostPreAfterEffects(class_name, crud_type, json, x_obj) {

    //
    switch (crud_type) {
        case "read":
            // unsetLoaderEl();
            var loaderEl = $("#loader-for-timeline-post-xxx");
            removeClonedLoaderEl(loaderEl);

            setIsTimelinePostReading(false);


            //
            if (!getHasTimelinePostFetched()) {
                set_timeline_posts_fetcher();
            }


            //
            if (!isCnAjaxResultOk(json)) {
                setNumOfFailedAjaxRead(parseInt(getNummOfFailedAjaxRead()) + 1);
            }
            break;
        case "create":
        case "update":
        case "delete":
            break;
        case "fetch":
            setIsTimelinePostFetching(false);
            break;
        case "patch":
            break;
    }
}

function enableViewMoreCommentsBtnForThisPost(postId) {

    var viewMoreCommentsBtn = $("#post" + postId).find(".my-view-more-comments-btn")[0];

    $(viewMoreCommentsBtn).removeAttr("disabled");
}

function disableViewMoreCommentsBtnForThisPost(postId) {

    var viewMoreCommentsBtn = $("#post" + postId).find(".my-view-more-comments-btn")[0];

    $(viewMoreCommentsBtn).attr("disabled", "yes");
}