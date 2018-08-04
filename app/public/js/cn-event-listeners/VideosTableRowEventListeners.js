class VideosTableRowEventListeners {

    static implement(data = { eventNames: [], eventSource: null, eventHandler: null }) {

        data.eventNames.forEach(eventName => {

            switch (eventName) {
                case "onVideosTableRowClick":

                    $(data.eventSource.view.node).click(function () {

                        $(data.eventHandler.view.node).find("tr").css("box-shadow", "none");
                        $(data.eventSource.view.node).css("box-shadow", "0 0 20px lightblue");

                        data.eventHandler.onVideosTableRowClick({ videoObj: data.eventSource.dataSource.obj });
                    });

                    break;


                case "onVideosTableRowDelete":

                    $(data.eventSource.view.node).find(".video-record-delete-btn").click(function () {

                        event.stopPropagation();
                        
                        if (!confirm("Are you sure you wanna delete your video?")) { return; }

                        data.eventSource.delete({ loaderMsg: "We're deleting your video real quick..." });
                        data.eventHandler.onVideosTableRowDelete({ videosTableRowController: data.eventSource });
                    });

                    break;
            }

        });
    }

}

export { VideosTableRowEventListeners as default }