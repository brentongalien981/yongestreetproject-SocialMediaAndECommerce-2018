import CnRESTController from "./CnRESTController.js";
import AjaxRequest from "../cn-classes-v3/AjaxRequest.js";


class ComponentController extends CnRESTController {

    // constructor() {
    //     super();
    // }


    /**
     * @override
     */
    postInit() {
        this.initExtentionalControllers();
    }

    initExtentionalControllers() {
        
    }
}

export { ComponentController as default}