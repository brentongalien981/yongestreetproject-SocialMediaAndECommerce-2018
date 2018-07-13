import CnController from "./CnController.js";
import AjaxRequest from "../cn-classes-v3/AjaxRequest.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";



class CnRESTController extends CnController {

    read() {
        if (this.preRead()) {
            this.regularRead();
        }

        this.postRead();
    }

    /**
     * Override this to do some checks before proceeding.
     */
    preRead() {

        //
        if (this.isReading || (this.numOfFailedAjaxRead >= 3)) { return false; }

        this.isReading = true;

        return true;
    }

    regularRead(ajaxRequestData = {}) {
        const ajaxRequest = new AjaxRequest(ajaxRequestData);

        ajaxRequest.doSend();
    }

    postRead() {

    }

    handleAjaxRequestResult(ajaxRequest, resultJSON) {
        this.preHandleAjaxRequestResult(ajaxRequest, resultJSON);
        this.regularHandleAjaxRequestResult(ajaxRequest, resultJSON);
        this.postHandleAjaxRequestResult(ajaxRequest, resultJSON);
    }


    /**
     * This is like the method: doPreAfterEffects() from the old
     * mini-framework after receiving the ajax-request-result.
     * @param {AjaxRequest} ajaxRequest 
     * @param {JSON} resultJSON 
     */
    preHandleAjaxRequestResult(ajaxRequest, resultJSON) {

        /**
         * TODO: Unset the loader-element for this view.
         */



        // 1) Ex. transform "create" to "Create", "read" to "Read", etc.
        let operation = ajaxRequest.crudType.charAt(0).toUpperCase() + ajaxRequest.crudType.substr(1)

        /**
         * 2) If the ajax-request fails, increment the fields like
         * "this.numOfFailedAjaxRead", etc. depending on the ajax-request
         * crudType.
         */
        let propertyNameForNumOfFailedAjaxCrud = "numOfFailedAjax" + operation;

        if (!isCnAjaxResultOk(resultJSON)) {
            ++this[propertyNameForNumOfFailedAjaxCrud];
        } else {
            this[propertyNameForNumOfFailedAjaxCrud] = 0;
        }


        /**
         * 3) Ex. Further transform the operation: Create to Creating,
         * operation Read to Reading, etc. Then from Creating to isCreating,
         * from Reading to isReading. Then,
         * set the fields like "this.isReading" or "this.isCreating", ...
         * to false depending on the ajax-request crudType.
         */
        if (operation.charAt(operation.length - 1) === 'e') {
            operation = operation.substr(0, operation.length - 1);
        }
        operation = "is" + operation + "ing";
        this[operation] = false;


    }

    regularHandleAjaxRequestResult(ajaxRequest, resultJSON) {
        // Override this.

        switch (ajaxRequest.crudType) {
            case "read":
                this.view.setView(resultJSON);
                break;
            case "show":
                break;
            case "create":
                break;
            case "update":
                break;
            case "delete":
                break;
            case "fetch":
                break;
            case "patch":
                break;
            case "show":
                break;
        }
    }

    postHandleAjaxRequestResult(ajaxRequest, resultJSON) {
        // Override this.
        console.log("Invoked method: postHandleAjaxRequestResult() of class: " + this.constructor.name);
    }

}

export { CnRESTController as default }