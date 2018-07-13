import CnRESTController from "./CnRESTController.js";
// import AjaxRequest from "../cn-classes-v3/AjaxRequest.js";


class ComponentController extends CnRESTController {

    // constructor() {
    //     super();
    // }


    // /**
    //  * @override
    //  */
    // postInit() {
    //     this.initExtentionalControllers();
    // }

    // initExtentionalControllers() {

    // }


    /** @override */
    preInit() {
        super.preInit();

        this.isCreating = false;
        this.isReading = false;
        this.isUpdating = false;
        this.isDeleting = false;

        this.isPatching = false;
        this.isShowing = false;
        this.isIndexing = false;

        
        this.numOfFailedAjaxCreate = 0;
        this.numOfFailedAjaxRead = 0;
        this.numOfFailedAjaxUpdate = 0;
        this.numOfFailedAjaxDelete = 0;

        this.numOfFailedAjaxPatch = 0;
        this.numOfFailedAjaxShow = 0;
        this.numOfFailedAjaxIndex = 0;
    }
}

export { ComponentController as default }