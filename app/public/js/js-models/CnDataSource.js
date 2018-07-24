import Video from "./Video.js";

class CnDataSource {

    constructor() {
        this.objs = [];
        this.newlyAddedObjs = [];
    }

    getLimitDate(limitType = "earliest") {

        let limitDate = "2010-09-11 10:54:45";
        // let limitDate = "0000-00-00 00:00:00";

        if (limitType == "earliest") {
            for (let i = 0; i < this.objs.length; i++) {
                const obj = objs[i];

                if (obj.created_at < limitDate) {
                    limitDate = obj.created_at;
                }
            }
        }
        else {
            for (let i = 0; i < this.objs.length; i++) {
                const obj = objs[i];

                if (obj.created_at > limitDate) {
                    limitDate = obj.created_at;
                }
            }
        }

        return limitDate;
    }

    appendNewObjs(data = { ajaxRequest: null, json: null, forceSetObjProps: false }) {

        if (data.ajaxRequest == null || data.json == null) { return; }
        if (!data.ajaxRequest.isUsingRecipeFramework) { return; }


        let modelClassName = data.ajaxRequest.modelClassName;
        let objs = data.json.objs;


        for (let i = 0; i < objs.length; i++) {

            let newModelObj = this.getModelObjForClassName(modelClassName);
            newModelObj.setProperties({ jsonObj: objs[i], forceSetObjProps: data.forceSetObjProps });
            this.objs.push(newModelObj);
            this.newlyAddedObjs.push(newModelObj);
        }
    }



    getModelObjForClassName(modelClassName) {

        let modelObj = null;

        switch (modelClassName) {
            case "Video":
                modelObj = new Video();
                break;
        }

        return modelObj;
    }
}

export { CnDataSource as default }