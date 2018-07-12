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
    }

    /**
     * This is when and where we usually initialize the extentional-controllers
     * and append their views to respective containers.
     */
    postInit() {
        // this.implementEventListeners();
    }

    /**
     * After setting up all the childComponents (initiating, appending),
     * add the event listeners.
     */
    // implementEventListeners() {

    // }

    
}

export { CnController as default}