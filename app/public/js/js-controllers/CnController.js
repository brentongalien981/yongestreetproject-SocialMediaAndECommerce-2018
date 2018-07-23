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
    }

    /**
     * This is when and where we usually initialize the extentional-controllers
     * and append their views to respective containers.
     */
    postInit() {
        
    }
    
}

export { CnController as default}