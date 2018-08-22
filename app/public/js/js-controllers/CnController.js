import CnDataSource from "../js-models/CnDataSource.js";

class CnController {

    constructor() {
        this.init();
    }

    /**
     * 
     */
    init() {
        this.preInit();
        this.regularInit();
        this.postInit();
    }

    /**
     * This is when and where we usuallly do some checkings and
     * housekeepings.
     */
    preInit() {

    }

    /**
     * This is when and where we usually initialize the views.
     */
    regularInit() {
        this.view = null;
        this.dataSource = new CnDataSource();
        this.instanceController = this;
    }

    /**
     * This is when and where we usually initialize the extentional-controllers
     * and append their views to respective containers.
     */
    postInit() {

    }


    /**
     * Note that you should use the CnComponent(3)'s method: hasAlmostReachedBottom() instead.
     * @deprecated
     * @param {*} data 
     * @returns {bool}
     */
    canReadMoreObjs(data = { refNodeSelector: "", heightGap: 1000 }) {
        
        // Boundaries of the sides of the reference.
        var referenceForLoadingMoreObjs = $(data.refNodeSelector).get(0).getBoundingClientRect();


        if (referenceForLoadingMoreObjs == null) { return false; }
        

        var triggerYPositionForAjaxReadingMoreObjs = data.heightGap;

        // // // lOG:
        // cnLog("ref POS: " + referenceForLoadingMoreObjs.top);

        if (referenceForLoadingMoreObjs.top <= triggerYPositionForAjaxReadingMoreObjs) {
            return true
        }


        return false;
    }
}

export { CnController as default }