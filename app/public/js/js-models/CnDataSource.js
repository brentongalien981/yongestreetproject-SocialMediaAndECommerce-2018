class CnDataSource {

    constructor() {
        this.objs = [];
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
}

export { CnDataSource as default }