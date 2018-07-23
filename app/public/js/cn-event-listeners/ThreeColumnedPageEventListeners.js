// import CreateVideoPageController from "../js-controllers/CreateVideoPageController";

class ThreeColumnedPageEventListeners {

    static implement(handlerObj) {

        // if (handlerObj instanceof CreateVideoPageController) {
        //     $(window).resize(function () {
        //         handlerObj.setLeftColHeight();

        //         // setRightCol();
        //         // handlerObj.setRightColHeight();

        //         // handlerObj.setCenterCol();
        //     });
        // } else {
        //     cnLog("Argument: handlerObj is not an instance of class: CreateVideoPageController.");
        // }

        $(window).resize(function () {
            handlerObj.setLeftColHeight();
            handlerObj.setRightColHeight();

            // setRightCol();
            // handlerObj.setRightColHeight();

            // handlerObj.setCenterCol();
        });



    }


    /**
     * Call this method instead of implement() if the calling class
     * doesn't want to handle the event.
     * @param {CreateVideoPageController} delegator 
     */
    static handle(delegator) {

        delegator.setLeftColHeight = this.setLeftColHeight;
        delegator.setRightColHeight = this.setRightColHeight;
        this.implement(delegator);

    }


    static setLeftColHeight() {
        // $("#cn-left-col").height($(this).outerHeight());
        $(this.view.parts.cnLeftCol.node).height($(window).outerHeight());
    }

    static setRightColHeight() {
        $(this.view.parts.cnRightCol.node).height($(window).outerHeight());
    }

}

export { ThreeColumnedPageEventListeners as default }