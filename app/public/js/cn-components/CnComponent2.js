import CnComponent from "./CnComponent.js";

class CnComponent2 extends CnComponent{

    initParts() { 
        const loaderContainer = new CnComponent({ nodeSelector: this.nodeSelector + " .loader-element-container" });

        loaderContainer.displayBlock();

        const loaderNode = new CnComponent( { nodeSelector: this.nodeSelector + " .cn-loader-node" } );
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

}


export { CnComponent2 as default };
