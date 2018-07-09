class CnGeneral {


    /**
     * @throws CnNullReferenceError
     * @param selector
     * @returns {*|jQuery}
     */
    static cloneTemplateNode(selector) {
        var node = $(selector).clone(true);

        if ($(node).attr("id") == null) {

            throw new CnNullReferenceError();
        }
        else {
            $(node).removeClass("cn-template");
            $(node).removeAttr("id");
            return node;
        }
    }


    /**
     *
     * @param data
     * @returns {Array}
     */
    static getIdsOfAlreadyShownItems(data = {selector: null, attrNameOfUniqueId: null}) {

        //
        if (data.selector == null) { return []; }


        //
        var idsOfAlreadyShownItems = [];

        var alreadyShownItems = $(data.selector);

        for (i = 0; i < alreadyShownItems.length; i++) {
            var currentItemId = $(alreadyShownItems[i]).attr(data.attrNameOfUniqueId);

            idsOfAlreadyShownItems[i] = currentItemId;

        }

        return idsOfAlreadyShownItems;
    }
}


export { CnGeneral as default}