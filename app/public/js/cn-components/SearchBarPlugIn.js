import CnComponent3 from "./CnComponent3.js";

export default class SearchBarPlugIn extends CnComponent3 {

    constructor() {

        const myNode = CnComponent3.cnCloneTemplate({ id: "search-bar-plug-in-template" });
        super({ node: myNode, nodeSelector: "#my-store-items-holder .search-bar-plug-in" });
    }


    /** @override */
    initChildComponents() {
        super.initChildComponents();

        const btn = new CnComponent3({ nodeSelector: this.nodeSelector + " button" });

        this.childComponents = {
            ...this.childComponents,
            btn: btn
        };
    }
}