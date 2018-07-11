import AjaxRequestConstants from './AjaxRequestConstants.js';
import AjaxRequestResultLogger from './AjaxRequestResultLogger.js';


/* PRIVATE VARS */
let xhr = new XMLHttpRequest();

/* PRIVATE FUNCTIONS */
function privateFunc() {
    console.log("in method: privateFunc().");
}

class AjaxRequest {

    constructor(props = {}) {

        this.requestType = (props.requestType != null) ? props.requestType : AjaxRequestConstants.REQUEST_TYPE_AJAX;
        this.requestMethod = (props.requestMethod != null) ? props.requestMethod : AjaxRequestConstants.REQUEST_METHOD_GET;
        this.crudType = (props.crudType != null) ? props.crudType : AjaxRequestConstants.CRUD_TYPE_READ;

        this.requestObj = (props.requestObj != null) ? props.requestObj : null;
        this.requestUrl = getLocalAjaxHandlerUrl();
        this.controllerObj = (props.controllerObj != null) ? props.controllerObj : null; // The calling CnController obj.
        // this.controllerClassName = this.controllerObj.constructor.name;
        this.modelClassName = (props.modelClassName != null) ? props.modelClassName : null;

    }

    doSend() {
        // Temporary unset the this.controllerObj because it's not
        // needed for the ajax-request.
        let actualControllerObj = this.controllerObj;
        this.controllerObj = null;

        this.doPreSend();
        this.doRegularSend();

        this.controllerObj = actualControllerObj;
        this.doPostSend(this);
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
    doPostSend(ajaxRequest) {

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                //
                const response = xhr.responseText.trim();

                // // Re-reference the controllerObj.
                // this.controllerObj = controllerObj;

                // Log before JSON parsing.
                // do_browser_ajax_pre_log(x_obj, response, url)
                AjaxRequestResultLogger.preLog(ajaxRequest, response);

                // 
                let resultJSON = ajaxRequest.tryParsingAjaxJson(response);

                AjaxRequestResultLogger.postLog(ajaxRequest, resultJSON);

                // Show form errors.
                // TODO: showFormErrors2(crud_type, caller_class_name, json);


                ajaxRequest.controllerObj.handleAjaxRequestResult(ajaxRequest, resultJSON);
            }
        };
    }


    tryParsingAjaxJson(response) {

        var json = null;
    
        try {
            json = JSON.parse(response);
        } catch (e) {
            cnLog("\n**************************************");
            cnLog('ERROR: PARSING AJAX-JSON ==> ' + e);
            json = null;
        }
    
        return json;
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