import AjaxRequestConstants from './AjaxRequestConstants.js';


/* PRIVATE VARS */
let xhr = new XMLHttpRequest();

/* PRIVATE FUNCTIONS */
function privateFunc() {
    console.log("in method: privateFunc().");
}

class AjaxRequest {

    constructor() {

        this.requestType = AjaxRequestConstants.REQUEST_TYPE_AJAX;
        this.requestMethod = AjaxRequestConstants.REQUEST_METHOD_GET;
        this.crudType = AjaxRequestConstants.CRUD_TYPE_READ;
        this.requestObj = null;
        this.requestUrl = getLocalAjaxHandlerUrl();
        this.controllerObj = null; // The calling CnController obj.
        this.modelClassName = null;

    }

    doSend() {
        this.doPreSend();
        this.doRegularSend();
        this.doPostSend(this.controllerObj);
    }

    doPreSend() {

        if (this.requestMethod === AjaxRequestConstants.REQUEST_METHOD_GET) {

            this.requestUrl += "?request_data=" + JSON.stringify(this);

            xhr.open(this.requestMethod, this.requestUrl, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        }
        else {
            xhr.open(this.requestMethod, this.requestUrl, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        }


    }

    doRegularSend() {

        if (this.requestMethod === AjaxRequestConstants.REQUEST_METHOD_GET) {
            xhr.send();
        }
        else {

            let requestData = "request_data=" + JSON.stringify(this);
            xhr.send(requestData);
        }
    }

    /**
     * Handle the result of the ajax-request.
     */
    doPostSend(controllerObj) {

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                //
                const response = xhr.responseText.trim();

                // TODO: 
                const resultJSON = "EMPTY RESULT JSON";

                //
                console.log("########################");
                console.log("response: " + response);
                console.log("########################");


                controllerObj.handleAjaxRequestResult(this, resultJSON);
            }
        };
    }





    /**
     * @deprecated
     * @returns {string}
     */
    cnToString() {

        var returnValue = "";

        returnValue = "{";
        returnValue += "'requestType':'" + this.requestType + "'";
        returnValue += ",\"requestMethod\":\"" + this.requestMethod + "\"";
        returnValue += "}";

        return returnValue;
    }
}


export { AjaxRequest as default }
// export * from './AjaxRequest.js';