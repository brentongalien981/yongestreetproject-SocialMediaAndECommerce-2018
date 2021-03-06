import CnController from "./CnController.js";
import AjaxRequest from "../cn-classes-v3/AjaxRequest.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";



class CnRESTController extends CnController {

    preDelete() {

        //
        if (this.isDeleting || (this.numOfFailedAjaxDelete >= 20)) { return false; }

        this.isDeleting = true;

        return true;
    }

    delete(data = { loaderMsg: null }) {

        this.preCrud(data);

        if (this.preDelete() && this.regularDelete()) {

        } else {
            // Hide this controller's view's loader el.
            this.view.hideLoaderNode();

            this.isDeleting = false;
        }

        this.postDelete();
    }


    postDelete() {
        this.view.delete();
    }


    regularDelete(ajaxRequestData = {}) {
        const ajaxRequest = new AjaxRequest(ajaxRequestData);


        ajaxRequest.doSend();

        return true;
    }



    update(data = { loaderMsg: null }) {

        this.preCrud(data);

        if (this.preUpdate() && this.regularUpdate()) {

        } else {
            // Hide this controller's view's loader el.
            this.view.hideLoaderNode();

            this.isUpdating = false;
        }

        this.postUpdate();
    }

    regularUpdate(ajaxRequestData = {}) {
        const ajaxRequest = new AjaxRequest(ajaxRequestData);


        ajaxRequest.doSend();

        return true;
    }


    postUpdate() { }



    preUpdate() {

        //
        if (this.isUpdating || (this.numOfFailedAjaxUpdate >= 20)) { return false; }

        this.isUpdating = true;

        return true;
    }



    create(data = { loaderMsg: null }) {
        // if (this.preCreate()) {
        //     if (!this.regularCreate()) { this.isCreating = false; }
        // }

        this.preCrud(data);

        if (this.preCreate() && this.regularCreate()) {

        } else {
            // Hide this controller's view's loader el.
            this.view.hideLoaderNode();

            this.isCreating = false;
        }

        this.postCreate();
    }

    postCreate() { }


    regularCreate(ajaxRequestData = {}) {
        const ajaxRequest = new AjaxRequest(ajaxRequestData);

        ajaxRequest.doSend();

        return true;
    }


    preCreate() {

        //
        if (this.isCreating || (this.numOfFailedAjaxCreate >= 20)) { return false; }

        this.isCreating = true;

        return true;
    }





    index() {
        if (this.preIndex()) {
            this.regularIndex();
        }

        this.postIndex();
    }


    postIndex() { }


    regularIndex(ajaxRequestData = {}) {
        const ajaxRequest = new AjaxRequest(ajaxRequestData);

        ajaxRequest.doSend();
    }


    preIndex() {

        //
        if (this.isIndexing || (this.numOfFailedAjaxIndex >= 3)) { return false; }

        this.isIndexing = true;

        return true;
    }


    read(data = { loaderMsg: null }) {

        this.preCrud(data);

        if (this.preRead()) {
            this.regularRead();
        } else {
            // Hide this controller's view's loader el.
            this.view.hideLoaderNode();

            this.isReading = false;
        }

        this.postRead();
    }

    preCrud(data = { loaderMsg: null }) {
        this.view.showLoaderNode(data.loaderMsg);
    }

    /**
     * Override this to do some checks before proceeding.
     */
    preRead() {

        //
        if (this.isReading || (this.numOfFailedAjaxRead >= 20)) { return false; }

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

        if (isCnAjaxResultOk(resultJSON)) {
            this.regularHandleAjaxRequestResult(ajaxRequest, resultJSON);
        }

        this.postHandleAjaxRequestResult(ajaxRequest, resultJSON);

    }


    /**
     * This is like the method: doPreAfterEffects() from the old
     * mini-framework after receiving the ajax-request-result.
     * @param {AjaxRequest} ajaxRequest
     * @param {JSON} resultJSON
     */
    preHandleAjaxRequestResult(ajaxRequest, resultJSON) {


    }

    regularHandleAjaxRequestResult(ajaxRequest, resultJSON) {
        // Override this.

        switch (ajaxRequest.crudType) {
            case "index":
            case "read":

                if (ajaxRequest.isUsingRecipeFramework) {

                    this.dataSource.appendNewObjs({ ajaxRequest: ajaxRequest, json: resultJSON, forceSetObjProps: true });

                    this.view.setView({
                        dataSource: this.dataSource,
                        json: resultJSON
                    });
                } else {
                    this.view.setView({ json: resultJSON });
                }

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

        this.view.hideLoaderNode();

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

}

export { CnRESTController as default }
