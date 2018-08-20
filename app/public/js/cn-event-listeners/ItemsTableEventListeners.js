export default class ItemsTableEventListeners {

    static implement(data = { eventNames: [], eventSource: null, eventHandler: null }) {

        data.eventNames.forEach(eventName => {

            switch (eventName) {
                case "onReadMore":

                    $(data.eventSource.view.node).find(".cn-table-container").scroll(function () {

                        if (data.eventSource.view.hasAlmostReachedBottom()) {
                            data.eventHandler.onReadMore();
                        }
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
