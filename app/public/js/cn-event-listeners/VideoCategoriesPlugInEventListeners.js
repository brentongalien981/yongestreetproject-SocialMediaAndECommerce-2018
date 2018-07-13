class VideoCategoriesPlugInEventListeners {

    static implement(handlerObj) {

        // for show-more-btn
        $("#video-categories-plug-in").find(".show-more-btn").click(function (event) {

            handlerObj.onReadMoreObjectsBtnClicked();

        });


        // for show-less-btn
        $("#video-categories-plug-in").find(".show-less-btn").click(function () {

            handlerObj.onShowLessObjectsBtnClicked();
        });

    }


    /**
     * Call this method instead of implement() if the calling class
     * doesn't want to handle the event.
     * @param {CreateVideoPageController} delegator 
     */
    static handle(delegator) {

        // delegator.onReadMoreObjectsBtnClicked = this.onReadMoreObjectsBtnClicked;
        // this.implement(delegator);

    }


    static onReadMoreObjectsBtnClicked() {
        // // Re-show all the playlist-items.
        // $("#video-user-playlists-plug-in").find(".playlist-items").css("display", "block");

        // // Try to show the "show-less-btn".
        // var playlistItems = $("#video-user-playlists-plug-in").find(".playlist-items");
        // if (playlistItems.length > 7) {
        //     $("#video-user-playlists-plug-in").find(".show-less-btn").css("visibility", "visible");
        // }
        // else {
        //     $("#video-user-playlists-plug-in").find(".show-less-btn").css("visibility", "hidden");
        // }

        // //
        // this.read();
    }

}

export { VideoCategoriesPlugInEventListeners as default }