class VideoDetailsFormEventListeners {

    static implement(handlerObj) {

        $(handlerObj.view.childComponents.publishBtn.node).click(function (event) {

            event.preventDefault();
            handlerObj.onCreateObjectBtnClicked();

        });

    }


    /**
     * Call this method instead of implement() if the 
     * calling class (delegator)
     * doesn't want to implement the event.
     * @param {ComponentController} delegator 
     */
    static handle(delegator) {

        delegator.onCreateObjectBtnClicked = this.onCreateObjectBtnClicked;
        this.implement(delegator);

    }


    static onCreateObjectBtnClicked() {
        this.create();
    }

}

export { VideoDetailsFormEventListeners as default }