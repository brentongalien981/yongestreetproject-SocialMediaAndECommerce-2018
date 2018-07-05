function set_timeline_posts_fetcher() {
    setHasTimelinePostFetched(true);
    // Get an update every x second.
    timeline_posts_fetch_handler = setInterval(fetch_timeline_posts, 3000);
}


function fetch_timeline_posts() {

    if (getIsTimelinePostFetching()) { return; }
    setIsTimelinePostFetching(true);

    // var latest_timeline_post_date = get_timeline_post_latest_date();
    var latest_timeline_post_date = getLimitDateOfDomElement("latest", "message_post");

    var crud_type = "fetch";
    var request_type = "GET";
    var key_value_pairs = {
        fetch : "yes",
        latest_timeline_post_date: latest_timeline_post_date
    };


    var obj = new TimelinePost(crud_type, request_type, key_value_pairs);
    obj.fetch();
}