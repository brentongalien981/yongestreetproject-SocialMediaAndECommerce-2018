import CnController from "./CnController.js";
import AjaxRequest from "../cn-classes-v3/AjaxRequest.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";



export default class CnRESTController extends CnController {

    getCrudOperationFlagNames(operation) {

        // 1) Ex. transform "create" to "Create", "read" to "Read", etc.
        var operationFlagName = operation.charAt(0).toUpperCase() + operation.substr(1)


        //
        let counterNameForNumOfFailedAjaxCrud = "numOfFailedAjax" + operationFlagName;


        /**
         * 3) Ex. Further transform the operation: Create to Creating,
         * operation Read to Reading, etc. Then from Creating to isCreating,
         * from Reading to isReading. Then,
         * set the fields like "this.isReading" or "this.isCreating", ...
         * to false depending on the ajax-request crudType.
         */
        if (operationFlagName.charAt(operationFlagName.length - 1) === 'e') {
            operationFlagName = operationFlagName.substr(0, operationFlagName.length - 1);
        }
        operationFlagName = "is" + operationFlagName + "ing";

        return {
            operationFlagName: operationFlagName,
            counterNameForNumOfFailedAjaxCrud: counterNameForNumOfFailedAjaxCrud
        };
    }

    crud(data = { operation: "read", loaderMsg: null }) {

        let operationFlagNames = this.getCrudOperationFlagNames(data.operation);

        var preCrudResultMsg = this.preCrud(operationFlagNames);

        if (preCrudResultMsg == "isCruding") { return false; }

        if (preCrudResultMsg == "exceededNumOfAjaxCrudLimit") {
            this.view.hideLoaderNode();

            this[operationFlagNames.operationFlagName] = false;
            return false;
        }


        // If every preCrud check succeeds,
        // show loader node.
        this.view.showLoaderNode(data.loaderMsg);

        // Proceed to the cruding.
        this[operationFlagNames.operationFlagName] = true;

        this.regularCrud(data.operation);

        this.postCrud();

    }

    regularCrud(operation) {

        let ajaxRequestData = null;

        switch (operation) {
            case "create":
                ajaxRequestData = this.regularCreate();
                break;
            case "read":
                ajaxRequestData = this.regularRead();
                break;
            case "update":
                ajaxRequestData = this.regularUpdate();
                break;
            case "delete":
                ajaxRequestData = this.regularDelete();
                break;
        }

        let ajaxRequest = new AjaxRequest(ajaxRequestData);

        ajaxRequest.doSend();

        return true;
    }

    postCrud() {

    }


    preCrud(operationFlagNames) {
        var preCrudResultMsg = "";

        //
        if (this[operationFlagNames.operationFlagName]) { preCrudResultMsg = "isCruding"; }

        if (this[operationFlagNames.counterNameForNumOfFailedAjaxCrud] >= 20) {
            preCrudResultMsg = "exceededNumOfAjaxCrudLimit";
        }

        return preCrudResultMsg;
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

        //
        this.view.hideLoaderNode();


        let operationFlagNames = this.getCrudOperationFlagNames(ajaxRequest.crudType);

        /**
         * If the ajax-request fails, increment the fields like
         * "this.numOfFailedAjaxRead", etc. depending on the ajax-request
         * crudType.
         */
        if (!isCnAjaxResultOk(resultJSON)) {
            ++this[operationFlagNames.counterNameForNumOfFailedAjaxCrud];
        } else {
            this[operationFlagNames.counterNameForNumOfFailedAjaxCrud] = 0;
        }

        this[operationFlagNames.operationFlagName] = false;
    }
}