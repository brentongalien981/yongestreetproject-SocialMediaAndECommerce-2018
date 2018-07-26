class VideoDetailsFormEventListeners {

    static implement(handlerObj) {

        $(handlerObj.view.childComponents.publishBtn.node).click(function (event) {

            event.preventDefault();
            handlerObj.onCreateObjectBtnClicked();

        });


        $(handlerObj.view.childComponents.updateBtn.node).click(function (event) {

            event.preventDefault();
            handlerObj.onUpdateObjectBtnClicked();

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
        delegator.onUpdateObjectBtnClicked = this.onUpdateObjectBtnClicked;
        this.implement(delegator);

    }


    static onCreateObjectBtnClicked() {
        this.create();
    }

    static onUpdateObjectBtnClicked() {
        this.update({ loaderMsg: "update is fucking on" });
    }

}

export { VideoDetailsFormEventListeners as default }