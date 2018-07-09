import ThreeColumnedPage from './ThreeColumnedPage.js';
import CnPageProperties from "../cn-classes-v3/CnPageProperties.js";
import CnForm from "./CnForm.js";

class CreateVideoPage extends ThreeColumnedPage {

    constructor() {
        super();

        this.setPageProperties (new CnPageProperties({
            title: "Create Video Page"
        }));
    }

    /**
     * @override
     */
    postInit() {
        this.form = new CnForm( {nodeSelector: "#video-details-form"} );
        this.form.appendTo(this.parts.cnCenterCol);
    }

}


export { CreateVideoPage as default}