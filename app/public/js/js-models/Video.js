import CnModel from "./CnModel.js";

class Video extends CnModel {

    constructor(data = { props: null, clonedObj: null }) {
        super();

        this.tags = [];
        this.categories = [];
        this.id = null;
        this.user_id = null;
    }
}

export { Video as default }