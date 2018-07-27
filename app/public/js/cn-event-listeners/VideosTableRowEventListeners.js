class VideosTableRowEventListeners {

    static implement(data = { eventSource: null, eventHandler: null }) {

        $(data.eventSource.view.node).click( function () {

            $(data.eventHandler.view.node).find("tr").css("box-shadow", "none");
            $(data.eventSource.view.node).css("box-shadow", "0 0 20px lightblue");
            data.eventHandler.onVideosTableRowClick( { videoObj: data.eventSource.dataSource.obj } );
        });

    }

}

export { VideosTableRowEventListeners as default }