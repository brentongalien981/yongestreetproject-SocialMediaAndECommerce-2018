import CnComponent2 from "./CnComponent2.js";

export default class CnComponent3 extends CnComponent2 {

    /** @override */
    initParts() {
        const loaderContainer = new CnComponent2({ nodeSelector: this.nodeSelector + "-loader-element-container" });

        loaderContainer.displayBlock();


        let clonedCnLoaderNode = CnComponent2.cnCloneTemplate({ id: "cn-loader-node-template" });
        // const loaderNode = new CnComponent({ nodeSelector: this.nodeSelector + " .cn-loader-node" });
        const loaderNode = new CnComponent2({ node: clonedCnLoaderNode });

        loaderContainer.append(loaderNode);

        loaderNode.displayNone();

        this.loaderContainer = loaderContainer;
        this.loaderNode = loaderNode;

        this.parts = {
            loaderContainer: loaderContainer,
            loaderNode: loaderNode
        };

    }
}