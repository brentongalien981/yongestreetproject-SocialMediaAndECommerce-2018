function fetch_timeline_post_replies(post_id) {

    var crud_type = "fetch";
    var request_type = "GET";
    var offset = get_timeline_post_num_of_comments(post_id);
    var latest_comment_date = get_comment_latest_date(post_id);

    var key_value_pairs = {
        fetch : "yes",
        timeline_post_id: post_id,
        latest_comment_date: latest_comment_date,
        offset: offset

    };


    var obj = new TimelinePostReply(crud_type, request_type, key_value_pairs);
    obj.fetch();
}