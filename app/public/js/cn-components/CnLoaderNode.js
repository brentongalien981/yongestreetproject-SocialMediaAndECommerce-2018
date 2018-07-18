class CnLoaderNode {

    constructor() {
        this.node = $("#cn-loader-node-template").clone();
        $(this.node).attr("id", "");

    }

}


export { CnLoaderNode as default };