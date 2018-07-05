function addClickListenerToShowMoreVideosBtn(btn) {

    if ($(btn).attr("hasClickHandler") == "yes") { return; }
    else {
        $(btn).attr("hasClickHandler", "yes");
    }

    $(btn).click(function () {

        // var videoCategoryCntainer = $(this).closest(".video-category-containers");
        // var pageSection = $(videoCategoryCntainer).attr("pageSection");

        readVideos(this);
    });
}

function addClickListenersToMetaDetailsContainerBtns() {

    $("#show-more-description-btn").click(function() {

        $("#video-meta-details-container .description").removeClass("fadeOut");
        $("#video-meta-details-container .description").addClass("fadeIn");

        // $("#show-more-description-btn").removeClass("fadeIn");
        // $("#show-more-description-btn").addClass("fadeOut");
        //
        // $("#show-less-description-btn").removeClass("fadeOut");
        // $("#show-less-description-btn").addClass("fadeIn");

        setTimeout(function () {
            $("#video-meta-details-container .description").css("display", "block");

            $("#show-more-description-btn").css("display", "none");

            $("#show-less-description-btn").css("display", "inline-block");
        }, 300);
    });

    $("#show-less-description-btn").click(function() {

        $("#video-meta-details-container .description").removeClass("fadeIn");
        $("#video-meta-details-container .description").addClass("fadeOut");

        setTimeout(function () {
            $("#video-meta-details-container .description").css("display", "none");

            $("#show-more-description-btn").css("display", "inline-block");

            $("#show-less-description-btn").css("display", "none");
        }, 300);
    });
}