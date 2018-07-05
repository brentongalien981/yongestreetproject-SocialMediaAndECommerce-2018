function is_textarea_empty(textarea) {
    if (textarea.value.trim() == 0) {
        return true;

    } else {
        return false;
    }
}


function dom_append_post(crud_type, post_container) {
    if (crud_type == "read") {
        // $("#main_content2").append($(post_container));
        $("#cn-center-col").append($(post_container));
    }
    else if (crud_type == "fetch") {
        //
        var first_post_el = $(".post_background")[0];

        //
        $(post_container).insertBefore(first_post_el);
    }

}


function get_post_main_content(post) {
    var p = post;

    //
    var main_content_container_el = document.createElement("div");
    $(main_content_container_el).addClass("b-post-main-content b-post-parent-content");


    //
    var main_content_el = document.createElement("p");
    $(main_content_el).addClass("timeline_post_p");
    $(main_content_el).html(p["message"]);

    //
    $(main_content_container_el).append($(main_content_el));

    //
    return main_content_container_el;
}


function get_post_response_bar(post) {
    var p = post;

    /* response-bar-container */
    var response_bar_container_el = document.createElement("div");
    $(response_bar_container_el).addClass("b-post-response-bar");



    /* rate-pseudo-button */
    var rate_pseudo_button = document.createElement("div");
    $(rate_pseudo_button).addClass("response-icon-container rate-pseudo-button rate-bar-hover-trigger");

    //
    var rate_pseudo_button_img = document.createElement("img");
    $(rate_pseudo_button_img).addClass("response-bar-icons rate-bar-hover-trigger");
    $(rate_pseudo_button_img).attr("title", "Your Reaction");
    $(rate_pseudo_button_img).attr("src", get_local_url() + "img/heart.png");

    //
    var rate_pseudo_button_label = document.createElement("h6");
    $(rate_pseudo_button_label).addClass("response-icon-label rate-bar-hover-trigger");
    $(rate_pseudo_button_label).html("How do you rate this?");

    //
    $(rate_pseudo_button).append($(rate_pseudo_button_img));
    $(rate_pseudo_button).append($(rate_pseudo_button_label));





    /* rate-sigma-pseudo-button */
    var rate_sigma_pseudo_button = document.createElement("div");
    $(rate_sigma_pseudo_button).addClass("response-icon-container rate-sigma-pseudo-button");

    //
    var rate_sigma_pseudo_button_img = document.createElement("img");
    $(rate_sigma_pseudo_button_img).addClass("response-bar-icons");
    $(rate_sigma_pseudo_button_img).attr("title", "Number of Reactions");
    $(rate_sigma_pseudo_button_img).attr("src", get_local_url() + "img/sum.png");

    //
    var rate_sigma_pseudo_button_label = document.createElement("h6");
    $(rate_sigma_pseudo_button_label).addClass("response-icon-label");
    $(rate_sigma_pseudo_button_label).html("No rate tag");

    //
    $(rate_sigma_pseudo_button).append($(rate_sigma_pseudo_button_img));
    $(rate_sigma_pseudo_button).append($(rate_sigma_pseudo_button_label));





    /* rate-average-pseudo-button */
    var rate_average_pseudo_button = document.createElement("div");
    $(rate_average_pseudo_button).addClass("response-icon-container rate-average-pseudo-button");

    //
    var rate_average_pseudo_button_img = document.createElement("img");
    $(rate_average_pseudo_button_img).addClass("response-bar-icons");
    $(rate_average_pseudo_button_img).attr("title", "Average Reaction");
    $(rate_average_pseudo_button_img).attr("src", get_local_url() + "img/average.png");

    //
    var rate_average_pseudo_button_label = document.createElement("h6");
    $(rate_average_pseudo_button_label).addClass("response-icon-label");
    $(rate_average_pseudo_button_label).html("Average rating");

    //
    $(rate_average_pseudo_button).append($(rate_average_pseudo_button_img));
    $(rate_average_pseudo_button).append($(rate_average_pseudo_button_label));





    /* Append */
    $(response_bar_container_el).append($(rate_pseudo_button));
    $(response_bar_container_el).append($(rate_sigma_pseudo_button));
    $(response_bar_container_el).append($(rate_average_pseudo_button));



    /* Return */
    return response_bar_container_el;
}

function get_post_details_bar(post) {
    var p = post;

    //
    var post_details_bar = document.createElement("div");
    $(post_details_bar).addClass("b-post-details-bar");

    /* Profile pic */
    var profile_pic_el = document.createElement("div");

    //
    var profile_pic_img_el = document.createElement("img");
    $(profile_pic_img_el).addClass("b-profile-pic");

    // This is a default profile pic in case the user doesn't have one.
    if (p["pic_url"] == "0") {
        p["pic_url"] = "https://farm5.staticflickr.com/4505/37111709784_57d987a8bf_m.jpg";
    }

    $(profile_pic_img_el).attr("src", p["pic_url"]);


    // Append the img_el
    $(profile_pic_el).append($(profile_pic_img_el));

    //
    $(post_details_bar).append($(profile_pic_el));





    /* meta-details */
    var meta_details_el = document.createElement("div");
    $(meta_details_el).addClass("meta-details");

    //
    var meta_name_el = document.createElement("h4");
    $(meta_name_el).addClass("meta-name");
    $(meta_name_el).html(p["user_name"]);

    //
    var meta_date_el = document.createElement("h5");
    $(meta_date_el).addClass("meta-date created-at");
    $(meta_date_el).html(p["date_posted"]);

    // Append
    $(meta_details_el).append($(meta_name_el));
    $(meta_details_el).append($(meta_date_el));

    //
    $(post_details_bar).append($(meta_details_el));





    /* settings-icon */
    var settings_icon_container_el = document.createElement("div");
    $(settings_icon_container_el).addClass("settings-icon-container");

    var settings_icon_el = document.createElement("i");
    $(settings_icon_el).addClass("fa fa-sliders settings-icon");


    // Append
    $(settings_icon_container_el).append($(settings_icon_el));

    //
    $(post_details_bar).append($(settings_icon_container_el));

    // Add event-listeners to the trigger elements of the post-settings-pop-up.
    add_post_popup_trigger_el_listeners(settings_icon_container_el);
    // add_post_popup_trigger_el_listeners(settings_icon_el);



    /* */
    return post_details_bar;

}

function append_a_comment_form(parent_post_id) {

    // // Disable the reply button when the form shows up.
    // document.getElementById("replyButton" + parentPostId).setAttribute("disabled", "disabled");


    var replyForm = document.createElement("form");
    var replyTextAre = document.createElement("textarea");
    var replyButton = document.createElement("input");
    // var cancelButton = document.createElement("input");


    replyForm.id = "replyForm" + parent_post_id;
    replyForm.setAttribute("class", "replyForm");

    replyTextAre.setAttribute("placeholder", "Comment here...");
    replyTextAre.setAttribute("rows", "4");
    replyTextAre.setAttribute("cols", "70");


    replyButton.setAttribute("type", "button");
    replyButton.setAttribute("value", "submit");
    // replyButton.setAttribute("class", "form_buttons");
    $(replyButton).addClass("btn");
    $(replyButton).addClass("btn-warning");
    $(replyButton).addClass("btn-sm");

    replyButton.onclick = function () {
        create_timeline_post_reply(parent_post_id);
    };



    replyForm.appendChild(replyTextAre);
    replyForm.appendChild(document.createElement("br"));
    replyForm.appendChild(replyButton);
    // replyForm.appendChild(cancelButton);

    // document.getElementById(parentPostId).insertBefore(replyForm, document.getElementById(parentPostId).childNodes[3]);
    var post = document.getElementById("post" + parent_post_id);
    post.appendChild(replyForm);
}

function append_view_more_comments_button(post_id) {

    /* */
    var view_more_comments_button = document.createElement("button");

    $(view_more_comments_button).addClass("my-view-more-btn");
    $(view_more_comments_button).addClass("btn");
    $(view_more_comments_button).addClass("btn-info");
    $(view_more_comments_button).addClass("btn-sm");
    $(view_more_comments_button).addClass("my-view-more-comments-btn");
    $(view_more_comments_button).html("view more comments");

    $("#post" + post_id).append($(view_more_comments_button));

    /* Add event-listener. */
    $(view_more_comments_button).click(function () {
        read_timeline_post_replies(post_id);
    });
}