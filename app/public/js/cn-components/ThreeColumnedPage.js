import CnPage from './CnPage.js';
import CnPart from "./CnPart.js";
import CnContainer from "./CnContainer.js";


class ThreeColumnedPage extends CnPage {

    // constructor(props = null) {
    //     super(props);
    // }

    /**
     * @override
     */
    initParts() {
        super.initParts();

        const cnLeftCol = new CnPart({ nodeSelector: "#cn-left-col" });
        const cnRightCol = new CnPart({ nodeSelector: "#cn-right-col" });
        const cnCenterCol = new CnPart({ nodeSelector: "#cn-center-col" });

        const cnLeftColContainer1 = new CnContainer({ nodeSelector: cnLeftCol.nodeSelector + " .container1" });
        const cnLeftColContainer2 = new CnContainer({ nodeSelector: cnLeftCol.nodeSelector + " .container2" });
        cnLeftCol.containers = { container1: cnLeftColContainer1, container2: cnLeftColContainer2 };

        this.parts = { cnLeftCol: cnLeftCol, cnRightCol: cnRightCol, cnCenterCol: cnCenterCol };
    }

}


export { ThreeColumnedPage as default }