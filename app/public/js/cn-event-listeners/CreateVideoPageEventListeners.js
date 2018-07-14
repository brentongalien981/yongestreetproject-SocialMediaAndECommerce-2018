class CreateVideoPageEventListeners {

    static implement(handlerObj) {

        // $("#video-details-form #publish-video-btn").click(function (event) {

        //     event.preventDefault();
        //     handlerObj.onCreateObjectBtnClicked();

        // });

    }


    /**
     * Call this method instead of implement() if the 
     * calling class (delegator)
     * doesn't want to implement the event.
     * @param {ComponentController} delegator 
     */
    static handle(delegator) {

        // delegator.onCreateObjectBtnClicked = this.onCreateObjectBtnClicked;
        // this.implement(delegator);

    }

}

export { CreateVideoPageEventListeners as default }