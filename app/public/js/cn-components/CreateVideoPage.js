import ThreeColumnedPage from './ThreeColumnedPage.js';
import CnForm from "./CnForm.js";

class CreateVideoPage extends ThreeColumnedPage {

    /** @override */
    initPageProperties() {
        super.initPageProperties({
            title: "Create Video Page MoFo | YSP"
        });
    }


    // /** @override */
    // initChildComponents() {
    //     super.initChildComponents();
    //     this.form = new CnForm( {nodeSelector: "#video-details-form"} );
    //     this.form.appendTo(this.parts.cnCenterCol);
    // }

}


export { CreateVideoPage as default}