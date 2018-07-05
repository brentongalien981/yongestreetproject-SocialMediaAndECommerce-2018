window.onload = function() {

    // for show-more-btn
    $("#video-user-playlists-plug-in").find(".show-more-btn").click(function (event) {

        // Re-show all the playlist-items.
        $("#video-user-playlists-plug-in").find(".playlist-items").css("display", "block");


        // Try to show the "show-less-btn".
        var playlistItems = $("#video-user-playlists-plug-in").find(".playlist-items");
        if (playlistItems.length > 7) {
            $("#video-user-playlists-plug-in").find(".show-less-btn").css("visibility", "visible");
        }
        else {
            $("#video-user-playlists-plug-in").find(".show-less-btn").css("visibility", "hidden");
        }


        //
        readVideoUserPlaylists();
    });


    // for show-less-btn
    $("#video-user-playlists-plug-in").find(".show-less-btn").click(function () {

        var playlistItems = $("#video-user-playlists-plug-in").find(".playlist-items");

        // Hide the 6th and beyond playlist-items.
        for (i = 5; i < playlistItems.length; i++) {
            $(playlistItems[i]).css("display", "none");
        }

        // Hide this "show-less-btn".
        $("#video-user-playlists-plug-in").find(".show-less-btn").css("visibility", "hidden");
    });
};