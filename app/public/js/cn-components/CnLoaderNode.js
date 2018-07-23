class CnLoaderNode {

    constructor(data = { node: null }) {

        if (data.node !== null) {
            this.node = $(node);
        } else {
            this.node = $("#cn-loader-node-template").clone();
            $(this.node).attr("id", "");
        }

    }

}


export { CnLoaderNode as default };