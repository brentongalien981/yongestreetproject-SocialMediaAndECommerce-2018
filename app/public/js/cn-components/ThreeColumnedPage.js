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


    /** @override */
    postInit() {
        super.postInit();
        this.setSideColsHeight();
        
        this.initCnStickyBottom();
    }

    initCnStickyBottom() {
        $("#center-col-toggle-btn").remove();
    
        $("#left-col-toggle-btn").trigger("click");
        $("#right-col-toggle-btn").trigger("click");
    
        $("#cn-left-col").css("display", "block");
        $("#cn-right-col").css("display", "block");
    }

    setSideColsHeight() {
        $(this.parts.cnLeftCol.node).height($(window).outerHeight());
        $(this.parts.cnRightCol.node).height($(window).outerHeight());
    }

}


export { ThreeColumnedPage as default }