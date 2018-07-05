window.onload = function() {

    // for show-more-btn
    $("#video-categories-plug-in").find(".show-more-btn").click(function (event) {

        // Re-show all the category-items.
        var categoryItems = $("#video-categories-plug-in").find(".video-categories-plug-in-item");
        $(categoryItems).css("display", "block");


        // Try to show the "show-less-btn".
        if (categoryItems.length > 7) {
            $("#video-categories-plug-in").find(".show-less-btn").css("visibility", "visible");
        }
        else {
            $("#video-categories-plug-in").find(".show-less-btn").css("visibility", "hidden");
        }


        //
        readCategories();
    });


    // for show-less-btn
    $("#video-categories-plug-in").find(".show-less-btn").click(function () {

        var categoryItems = $("#video-categories-plug-in").find(".video-categories-plug-in-item");

        // Hide the 6th and beyond playlist-items.
        for (i = 5; i < categoryItems.length; i++) {
            $(categoryItems[i]).css("display", "none");
        }

        // Hide this "show-less-btn".
        $("#video-categories-plug-in").find(".show-less-btn").css("visibility", "hidden");
    });
};