import CnComponent from "./CnComponent.js";

class CnComponent2 extends CnComponent {

    initParts() {
        const loaderContainer = new CnComponent({ nodeSelector: this.nodeSelector + " .loader-element-container" });

        loaderContainer.displayBlock();


        let clonedCnLoaderNode = CnComponent2.cnCloneTemplate({ id: "cn-loader-node-template" });
        // const loaderNode = new CnComponent({ nodeSelector: this.nodeSelector + " .cn-loader-node" });
        const loaderNode = new CnComponent({ node: clonedCnLoaderNode });

        loaderContainer.append(loaderNode);

        loaderNode.displayNone();

        this.loaderContainer = loaderContainer;
        this.loaderNode = loaderNode;

        this.parts = {
            loaderContainer: loaderContainer,
            loaderNode: loaderNode
        };

    }


    showLoaderNode(msg) {

        this.loaderNode.displayBlock();

        if (msg != null) {
            $(this.loaderNode.node).find(".cn-loader-comment").html(msg);

        }
    }

    hideLoaderNode() {

        this.loaderNode.displayNone();
    }

    static getComponent(data = { id: 0, nodeIdPrefix: "", fromComponents: [] }) {

        const completeNodeId = data.nodeIdPrefix + data.id;
        const components = data.fromComponents;
        for (let index = 0; index < components.length; index++) {

            if (completeNodeId == components[index].nodeId) {
                return components[index];
            }

        }

        return null;
    }


    static cnCloneTemplate(data = { id: null }) {

        if (data.id == null) { return null; }

        var template = $("#" + data.id).clone(true);
        $(template).removeClass("cn-template");
        $(template).removeAttr("id");
        return template;
    }


    show() {
        $(this.node).removeClass("cn-template");
        $(this.node).removeClass("cn-undisplayed");
    }

}


export { CnComponent2 as default };
