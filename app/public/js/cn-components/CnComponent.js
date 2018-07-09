class CnComponent {

    constructor(props = { nodeSelector: null, nodeId: null }) {

        if (props !== null) {
            this.nodeSelector = (props.nodeSelector !== null) ? props.nodeSelector : null;
            this.nodeId = (props.nodeId !== null) ? props.nodeId : null;
        
            this.node = (this.nodeSelector !== null) ? $(this.nodeSelector): $("#" + this.nodeId);
            
        }


        this.init();
    }


    preInit() {

    }


    initPlugIns() { this.plugIns = null; }
    initChildComponents() { this.childComponents = null; }
    initContainers() { this.containers = null; }
    initParts() { this.parts = null; }


    regularInit() {
        this.initPlugIns();
        this.initChildComponents();
        this.initContainers();
        this.initParts();
    }


    /**
     * This is when and where we usually append the childComponents
     * and other extentional-views.
     */
    postInit() {

    }

    init() {
        this.preInit();
        this.regularInit();
        this.postInit();
    }


    /**
     * @throws Error
     * @param cnChildTemplate
     */
    append(cnChildTemplate) {

        if (this.node === null) {
            throw new Error("Appending Error: Parent-node is null.");

        }
        else if (cnChildTemplate === null) {
            throw new Error("Appending Error: Child-node to be appended is null.");
        }
        else {

            let nodeActualContainer = $(this.node).find(".cn-actual-container");
            if (nodeActualContainer != null) {

                // Append.
                $(nodeActualContainer).append($(cnChildTemplate.node));
            }
            else {
                // Append.
                $(this.node).append($(cnChildTemplate.node));
            }
        }
    }

    /**
     * @throws Error
     * @param {CnComponent} parentComponent 
     */
    appendTo(parentComponent) {
        if (parentComponent.node === null) {
            throw new Error("Appending Error: Parent-node is null.");

        }
        else if (this.node === null) {
            throw new Error("Appending Error: Child-node to be appended is null.");
        }
        else {

            const container = $(parentComponent.node).find(".cn-container")[0];
            // Append.
            $(container).append($(this.node));
        }
    }



    show() {
        // Remove the html-class-attribs that hides the nodes.
        $(this.node).removeClass("cn-template");
        $(this.node).removeClass("cn-undisplayed");
    }
}


export { CnComponent as default };
