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
        // Override this.
    }

    regularHandleAjaxRequestResult(ajaxRequest, resultJSON) {
        // Override this.
    }

    postHandleAjaxRequestResult(ajaxRequest, resultJSON) {
        // Override this.
        console.log("Invoked method: postHandleAjaxRequestResult() of class: " + this.constructor.name);
    }

}

export { CnRESTController as default }