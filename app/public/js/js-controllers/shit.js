class x {
    regularRead(ajaxRequestData = {}) {
        const ajaxRequest = new AjaxRequest(ajaxRequestData);

        ajaxRequest.doSend();
    }


    regularCreate(ajaxRequestData = {}) {
        const ajaxRequest = new AjaxRequest(ajaxRequestData);

        ajaxRequest.doSend();

        return true;
    }

    regularDelete(ajaxRequestData = {}) {
        const ajaxRequest = new AjaxRequest(ajaxRequestData);


        ajaxRequest.doSend();

        return true;
    }

    regularUpdate(ajaxRequestData = {}) {
        const ajaxRequest = new AjaxRequest(ajaxRequestData);


        ajaxRequest.doSend();

        return true;
    }

    regularIndex(ajaxRequestData = {}) {
        const ajaxRequest = new AjaxRequest(ajaxRequestData);

        ajaxRequest.doSend();
    }
}