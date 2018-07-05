function initPageOutlinePlugIn() {

    $("#page-outline-plug-in-container").append($("#page-outline-plug-in"));


    // /* TODO: Delete these later. */
    // var arrayOfUserPlaylistObjs = CN_EXP_getArrayOfUserPlaylistObjs();
    //
    // CN_EXP_doRegularDisplayVideoUserPlaylist(arrayOfUserPlaylistObjs);

}

function setPageOutlineItems(forPage) {

    // 1) Prepare the details for the page-outline-items.
    var pageOutlineItems = null;

    switch (forPage) {
        case "video@show":
            pageOutlineItems = [
                {
                    href: "shown-video-container",
                    outline_item_title: "The Video"
                },
                {
                    href: "video-meta-details-container",
                    outline_item_title: "Video Details"
                },
                {
                    href: "video-playlist-plug-in",
                    outline_item_title: "This video's playlist"
                },
                {
                    href: "comments-and-recommendations-container",
                    outline_item_title: "Comments and Recommendations"
                }

            ];
            break;
        case "video-manager@index":
            pageOutlineItems = [
                {
                    href: "video-managing-section",
                    outline_item_title: "Manage Videos"
                },
                {
                    href: "playlist-managing-section",
                    outline_item_title: "Manage Playlists"
                }

            ];
            break;
    }


    // 2) Remove the default page-outline-items.
    $(".page-outline-plug-in-item").remove();


    // 3) Set the page-outline-items.
    for (i = 0; i < pageOutlineItems.length; i++) {

        var pageOutlineItemEl = document.createElement("a");
        $(pageOutlineItemEl).addClass("page-outline-plug-in-item");

        var href = "#" + pageOutlineItems[i].href;
        $(pageOutlineItemEl).attr("href", href);

        var outlineTitle = pageOutlineItems[i].outline_item_title;
        $(pageOutlineItemEl).html(outlineTitle);


        $("#page-outline-plug-in").append($(pageOutlineItemEl));
    }
}

