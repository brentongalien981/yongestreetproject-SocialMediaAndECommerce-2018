class VideoDetailsFormEventListeners {

    static implement(data = {}) {

        if (data.event == null || data.eventSource == null || data.eventHandler == null) { return; }

        switch (data.event) {
            case "onVideoCreate":
                $(data.eventSource.view.childComponents.publishBtn.node).click(function (event) {

                    event.preventDefault();
                    data.eventHandler.onVideoCreate();

                });
                break;

            case "onVideoUpdate":

                $(data.eventSource.view.childComponents.updateBtn.node).click(function (event) {

                    event.preventDefault();
                    data.eventHandler.onVideoUpdate();
                    
                });
                break;
        }
    }


    /**
     * Call this method instead of implement() if the 
     * calling class (delegator)
     * doesn't want to implement the event.
     * @param {ComponentController} delegator 
     */
    static handleEvents(data = { forDelegator: null }) {

        if (data.forDelegator == null) { return; }

        // Dynamically add the event-handler-funcs to the delegator.
        data.forDelegator.onVideoCreate = VideoDetailsFormEventListeners.onVideoCreate;
        // data.forDelegator.onVideoUpdate = VideoDetailsFormEventListeners.onVideoUpdate;

        // Now the delegator, becomes a handler.
        this.implement({
            event: "onVideoCreate",
            eventSource: data.forDelegator,
            eventHandler: data.forDelegator
        });

        // this.implement({
        //     event: "onVideoUpdate",
        //     eventSource: data.forDelegator,
        //     eventHandler: data.forDelegator
        // });

    }


    static onVideoCreate() {
        this.create();
    }

    // static onVideoUpdate() {
    //     // this.update({ loaderMsg: "Updating your video..." });
    //     alert("uh oh.. the default handler method is still being called.");
    // }

}

export { VideoDetailsFormEventListeners as default }