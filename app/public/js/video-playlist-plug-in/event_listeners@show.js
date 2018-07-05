$(window).resize(function(){
    setPlaylistVideoThumbnailsDimensions();
});


$("#hide-playlist-items-btn").click(function () {

    //
    $("#video-playlist-plug-in").find(".video-recommendation-items-container").removeClass("fadeIn");
    $("#video-playlist-plug-in").find(".video-recommendation-items-container").addClass("fadeOut");

    //
    setTimeout(function () {

        $("#video-playlist-plug-in").find(".video-recommendation-items-container").css("display", "none");

        $("#show-more-playlist-videos-btn").css("display", "none");

    }, 300);

});

$("#show-playlist-items-btn").click(function () {

    //
    $("#video-playlist-plug-in").find(".video-recommendation-items-container").removeClass("fadeOut");
    $("#video-playlist-plug-in").find(".video-recommendation-items-container").addClass("fadeIn");

    $("#video-playlist-plug-in").find(".video-recommendation-items-container").css("display", "flex");
    $("#show-more-playlist-videos-btn").css("display", "initial");

    setPlaylistVideoThumbnailsDimensions();
});


$("#show-more-playlist-videos-btn").click(function () {
    showPlaylistVideoThumbnails();
});