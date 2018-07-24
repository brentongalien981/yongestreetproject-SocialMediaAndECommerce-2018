class CnModel {

    setProperties(data = { jsonObj: null, forceSetObjProps: false }) {

        let jsonObj = data.jsonObj;

        for (let jsonProp in jsonObj) {


            if (data.forceSetObjProps) {
                this[jsonProp] = jsonObj[jsonProp];

            } else if (jsonObj.hasOwnProperty(jsonProp)) {
                this[jsonProp] = jsonObj[jsonProp];
            }
        }
    }

}


export { CnModel as default }