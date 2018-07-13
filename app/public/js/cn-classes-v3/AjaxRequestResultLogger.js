// import AjaxRequestConstants from './AjaxRequestConstants.js';


class AjaxRequestResultLogger {

    static preLog(ajaxRequest, response) {
        if (this.shouldClassLog(ajaxRequest.modelClassName) && this.shouldCrudTypeLog(ajaxRequest.crudType)) { }
        else { return; }

        //
        cnLog("\n*******************************");
        cnLog("AjaxRequest Details");
        cnLog("*******************************");
        cnLog("requestType: " + ajaxRequest.requestType);
        cnLog("crudType: " + ajaxRequest.crudType);
        cnLog("url: " + ajaxRequest.requestUrl);
        cnLog("controllerClassName: " + ajaxRequest.controllerObj.constructor.name);
        cnLog("modelClassName: " + ajaxRequest.modelClassName);

        //
        cnLog("\n*******************************");
        cnLog("*** AjaxRequest Response before JSON parsing ***");
        cnLog("*******************************");
        cnLog("response: " + response);
        cnLog("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@");
        cnLog("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@\n\n\n\n\n");
    }


    static postLog(ajaxRequest, resultJSON) {

        if (this.shouldClassLog(ajaxRequest.modelClassName) && this.shouldCrudTypeLog(ajaxRequest.crudType)) { }
        else { return; }

        cnLog("\n*******************************");
        cnLog("*** resultJSON ***");
        
        if (isCnAjaxResultOk(resultJSON)) { 
            for (var key in resultJSON) {
                if (resultJSON.hasOwnProperty(key)) {
                    var val = resultJSON[key];
        
                    // Display in the console.
                    cnLog(key + " => " + val);
                }
            }
        }

        cnLog("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@");
        cnLog("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@\n\n\n\n\n");

    }





    static shouldClassLog(modelClassName) {

        switch (modelClassName) {
            case "UserPlaylist":
                return true;
        }

        return false;
        // return true;
    }


    static shouldCrudTypeLog(crudType) {

        switch (crudType) {
            case "fetch":
                // return true;
                return false;
            default:
                return true;
        }
    }
}

export { AjaxRequestResultLogger as default }