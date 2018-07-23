import CnLoaderNode from "./CnLoaderNode.js";

class CnLoaderContainer {

    constructor(props = { nodeSelector: null, nodeId: null }) {

        if (props !== null) {
            this.nodeSelector = (props.nodeSelector !== null) ? props.nodeSelector : null;
            this.nodeId = (props.nodeId !== null) ? props.nodeId : null;

            this.node = (this.nodeSelector !== null) ? $(this.nodeSelector) : $("#" + this.nodeId);

        }
    }


    removeExtraLoaders() {


        // Get a reference to the loader(s).
        const loaders = $(this.node).find(".cn-loader-node");

        for (let i = 1; i < loaders.length; i++) {
            $(loaders[i]).remove();
        }

        if (loaders.length > 0) {
            // const finalLoaderNode = new CnLoaderNode({ node: loaders[0] });

            // this.childComponents = { loader: finalLoaderNode };
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


        this.childComponents = { loader: childComponent };
        childComponent.parentComponent = parentComponent;
    }


    displayNone() {
        $(this.node).css("display", "none");
    }

    displayBlock() {
        $(this.node).css("display", "block");
    }

}


export { CnLoaderContainer as default };