import CnGeneral from './CnGeneral.js';


class CnTemplate {

    constructor(selector = null) {

        this.node = null;

        if (selector != null) {
            this.node = CnGeneral.cloneTemplateNode(selector);
        }
    }


    /**
     * @throws Error
     * @param cnChildTemplate
     */
    append(cnChildTemplate) {

        if (this.node == null) {
            throw new Error("CnError: Parent node is null.");

        }
        else if (cnChildTemplate == null) {
            throw new Error("CnError: Child nodeToBeAppended is null.");
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



    show() {
        // Remove the html-class-attribs that hides the nodes.
        $(this.node).removeClass("cn-template");
        $(this.node).removeClass("cn-undisplayed");
    }
}


export { CnTemplate as default}