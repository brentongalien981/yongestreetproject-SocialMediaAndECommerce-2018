function get_comment_details_bar(post) {
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
    $(meta_date_el).addClass("meta-date");
    $(meta_date_el).html(p["date_posted"]);

    // Append
    $(meta_details_el).append($(meta_name_el));
    $(meta_details_el).append($(meta_date_el));

    //
    $(post_details_bar).append($(meta_details_el));




    /* */
    return post_details_bar;

}

function get_comment_main_content(post) {
    var p = post;

    //
    var main_content_container_el = document.createElement("div");
    $(main_content_container_el).addClass("b-post-main-content");


    //
    var main_content_el = document.createElement("p");
    $(main_content_el).addClass("timeline_post_p");
    $(main_content_el).html(p["message"]);

    //
    $(main_content_container_el).append($(main_content_el));

    //
    return main_content_container_el;
}

function get_comment_latest_date(post_id) {

    var comments = $("#post" + post_id).find(".replies");
    var length = comments.length;

    var latest_comment = comments[length - 1];
    var latest_date = $(latest_comment).find(".meta-date").html();

    if (latest_comment == null ||
        latest_date == null ||
        latest_date == "") {

        return "2010-09-11 10:54:45";
    }
    else {
        return latest_date;
    }
}

function scrollRepliesContainerToBottom(repliesContainer) {

    $(repliesContainer).scrollTop($(repliesContainer).prop("scrollHeight"));
}