import Video from "./Video.js";
import CnModel from "./CnModel.js";

class CnDataSource {

    constructor() {
        this.objs = [];
        this.newlyAddedObjs = [];
        this.obj = {};
    }

    /**
     * Delete the obj in this dataSource's objs property,
     * newlyAddedObjs property, and obj property.
     * @param {*} data 
     */
    deleteObj(data = { obj: null }) {

        if (data.obj == null) { return; }

        // Update the dataSource.objs.
        for (let i = 0; i < this.objs.length; i++) {
            if (this.objs[i].id == data.obj.id) {
                this.objs.splice(i, 1)
                break;
            }
        }

        // Update the dataSource.newlyAddedObjs.
        for (let i = 0; i < this.newlyAddedObjs.length; i++) {
            if (this.newlyAddedObjs[i].id == data.obj.id) {
                this.newlyAddedObjs.splice(i, 1)
                break;
            }
        }

        //
        if (this.obj != null && this.obj.id == data.obj.id) {
            this.obj = null;
        }
    }

    updateObjs(data = { updatedObj: null }) {
        // Update the dataSource.objs.
        for (let i = 0; i < this.objs.length; i++) {
            if (this.objs[i].id == data.updatedObj.id) {
                this.objs[i] = data.updatedObj;
                break;
            }
        }

        // Update the dataSource.newlyAddedObjs.
        for (let i = 0; i < this.newlyAddedObjs.length; i++) {
            if (this.newlyAddedObjs[i].id == data.updatedObj.id) {
                this.newlyAddedObjs[i] = data.updatedObj;
                break;
            }
        }
    }

    getAlreadyReadObjIds() {
        let ids = [];

        for (let i = 0; i < this.objs.length; i++) {
            const obj = this.objs[i];
            ids.push(obj.id);
        }

        return ids;
    }

    getLimitDate(limitType = "earliest") {

        // let limitDate = "2010-09-11 10:54:45";


        let limitDate = "0000-00-00 00:00:00";


        // Here in this if-block, limitDate means the date now..
        if (limitType == "earliest") {

            for (let i = 0; i < this.objs.length; i++) {
                const obj = this.objs[i];

                // If there's already at least one obj,
                // just reference that obj's create_at.
                if (limitDate == "0000-00-00 00:00:00") {
                    limitDate = obj.created_at;
                    continue;
                }

                if (obj.created_at < limitDate) {
                    limitDate = obj.created_at;
                }
            }
        }
        else {

            for (let i = 0; i < this.objs.length; i++) {
                const obj = this.objs[i];

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

        // Re-set.
        this.newlyAddedObjs = [];


        for (let i = 0; i < objs.length; i++) {

            let newModelObj = this.getModelObjForClassName(modelClassName);
            newModelObj.setProperties({ jsonObj: objs[i], forceSetObjProps: data.forceSetObjProps });

            this.appendNewObj({ actualObj: newModelObj });

        }
    }


    appendNewObj(data = {}) {

        let obj = null;

        if (data.jsonObj != null) {
            obj = data.jsonObj;
        } else {
            obj = data.actualObj;
        }

        this.objs.push(obj);
        this.newlyAddedObjs.push(obj);
    }



    getModelObjForClassName(modelClassName) {

        let modelObj = null;

        switch (modelClassName) {
            case "Video":
                modelObj = new Video();
                break;
            default:
                modelObj = new CnModel();
        }

        return modelObj;
    }


    getObj(data = { withId: 0 }) {
        let obj = null;

        for (let i = 0; i < this.objs.length; i++) {
            if (this.objs[i].id == data.withId) {
                obj = this.objs[i];
                break;
            }
        }

        return obj;
    }
}

export { CnDataSource as default }