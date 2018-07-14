class CnComponent {

    constructor(props = { nodeSelector: null, nodeId: null }) {

        if (props !== null) {
            this.nodeSelector = (props.nodeSelector !== null) ? props.nodeSelector : null;
            this.nodeId = (props.nodeId !== null) ? props.nodeId : null;

            this.node = (this.nodeSelector !== null) ? $(this.nodeSelector) : $("#" + this.nodeId);

        }


        this.init();
    }


    preInit() {

    }


    initPlugIns() { this.plugIns = null; }
    initChildComponents() { this.childComponents = null; }
    initContainers() { this.containers = null; }
    initParts() { this.parts = null; }


    /**
     * Note that the order of calls here is important.
     */
    regularInit() {
        this.initParts();
        this.initContainers();
        this.initChildComponents();
        // TODO: this.initForms();
        this.initPlugIns();

        // Combine all components to childComponents.
        this.childComponents = {
            ...this.parts,
            ...this.containers,
            ...this.childComponents,
            ...this.plugIns
        };
        
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


    setView(json) {
        this.preSetView();
        this.regularSetView(json);
        this.postSetView();
    }

    preSetView() { }

    /**
     * TODO: Make this method accept parameters that make use
     * of the "model" of the MVC (not just a JSON).
     */
    regularSetView(resultJSON) {

    }

    postSetView() { }


    /**
     * @deprecated
     * @throws Error
     * @param cnChildTemplate
     */
    appendOld(cnChildTemplate) {

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


    append(childComponent) {
        let parentComponent = this;
        this.appendAtLast(parentComponent, childComponent)
    }


    /**
     * @throws Error
     * @param {CnComponent} parentComponent 
     * @param {CnComponent} childComponent 
     */
    appendAtLast(parentComponent, childComponent) {

        if (parentComponent.node === null) {
            throw new Error("Appending Error: Parent-node is null.");

        }
        else if (childComponent.node === null) {
            throw new Error("Appending Error: Child-node to be appended is null.");
        }
        else {

            let cnContainer = $(parentComponent.node).find(".cn-container")[0];

            // Append to the actual-cn-container of the parent-node.
            // else if the parent-node doesn't have actual-cn-container,
            // then append directly to the parent-node.
            if (cnContainer != null) {
                $(cnContainer).append($(childComponent.node));
            } else {
                $(parentComponent.node).append($(childComponent.node));
            }
        }
    }


    appendTo(parentComponent) {
        let childComponent = this;
        this.appendAtLast(parentComponent, childComponent)
    }


    show() {
        // Remove the html-class-attribs that hides the nodes.
        $(this.node).removeClass("cn-template");
        $(this.node).removeClass("cn-undisplayed");
    }
}


export { CnComponent as default };
