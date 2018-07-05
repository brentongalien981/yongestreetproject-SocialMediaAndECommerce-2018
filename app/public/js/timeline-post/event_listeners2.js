$(window).resize(function () {
    tryShowActiveCnCol();
});


$(window).scroll(function () {
    if (!getIsTimelinePostReading()) {

        /**/
        if (canIReadMoreTimelinePosts()) {
            readIimelinePosts();
        }
    }
});