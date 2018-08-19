import CnLoaderNode from "./CnLoaderNode.js";
import CnLoaderContainer from "./CnLoaderContainer.js";


class CnComponent {

    constructor(props = { nodeSelector: null, nodeId: null, node: null }) {

        if (props !== null) {
            this.nodeSelector = (props.nodeSelector !== null) ? props.nodeSelector : null;
            this.nodeId = (props.nodeId !== null) ? props.nodeId : null;

            this.node = (this.nodeSelector !== null) ? $(this.nodeSelector) : $("#" + this.nodeId);

        }

        if (props.node != null) {
            this.node = $(props.node);
        }


        this.init();
        this.controller = null;
    }


    preInit() {

    }


    initPlugIns() { this.plugIns = null; }
    initChildComponents() { this.childComponents = null; }
    initContainers() { this.containers = null; }

    initParts() {
        const loaderContainer = new CnLoaderContainer({ nodeSelector: this.nodeSelector + " .loader-element-container" });

        loaderContainer.displayNone();

        const loaderNode = new CnLoaderNode();
        loaderContainer.append(loaderNode);

        this.loaderContainer = loaderContainer;
        this.parts = {
            loaderContainer: loaderContainer
        };



        // loaderContainer.removeExtraLoaders();
    }


    showLoaderNode(msg) {

        $(this.loaderContainer.node).removeClass("bounceOutDown");
        $(this.loaderContainer.node).addClass("bounceInUp");
        this.parts.loaderContainer.displayBlock();

        if (msg != null) {
            $(this.parts.loaderContainer.childComponents.loader.node).find(".cn-loader-comment").html(msg);

        }
    }

    hideLoaderNode() {

        this.loaderContainer.displayNone();

        $(this.loaderContainer.node).removeClass("bounceInUp");
        $(this.loaderContainer.node).addClass("bounceOutDown");
    }


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

        // this.initLoaderNode();

    }


    /**
     * This is when and where we usually append the childComponents
     * and other extentional-views.
     */
    postInit() {
        // this.loaderContainer.removeExtraLoaders();
    }

    init() {
        this.preInit();
        this.regularInit();
        this.postInit();
    }


    setView(data = { dataSource: null, json: null }) {
        this.preSetView();

        if (data.dataSource == null) {
            this.regularSetView(data.json);
        } else {
            this.regularSetView(data);
        }

        this.postSetView();
    }

    preSetView() { }

    /**
     * TODO: Make this method accept parameters that make use
     * of the "model" of the MVC (not just a JSON).
     */
    regularSetView(resultJSON) {

    }

    refreshView() {
        
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

        // const newChildComponentAlias = childComponent.nodeSelector + "--a" + childComponent.constructor.name + "Component";
        // this.childComponents = { newChildComponentAlias: childComponent };
        childComponent.parentComponent = parentComponent;
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

    displayNone() {
        $(this.node).css("display", "none");
    }

    displayBlock() {
        $(this.node).css("display", "block");
    }


    addChildComponent(component = null) {

        if (component == null) { return; }

        this.childComponents = {
            ...this.childComponents,
            ...component
        };
    }


    delete() {
        $(this.node).remove();
    }
}


export { CnComponent as default };
