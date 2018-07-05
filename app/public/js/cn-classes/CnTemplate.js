class CnTemplate {

    constructor(selector = null) {

        if (selector != null) {
            this.node = CnGeneral.cloneTemplateNode(selector);
        }

        // cnLog("###########################");
        // cnLog("inside method: constructor, class: CnTemplate.");
        // cnLog("###########################");


        //
        this.getShit = (x, y) => {
            return "shit shit shit";
        };


        /**
         * @throws Error.
         * @param itemxManagingSectionPseudoBtn: ItemxManagingSectionPseudoBtn
         */
        this.append = (cnChildTemplate) => {

            if (this.node == null) {
                throw new Error("CnError: Parent node is null.");

            }
            else if (cnChildTemplate == null) {
                throw new Error("CnError: Child nodeToBeAppended is null.");
            }
            else {

                var nodeActualContainer = $(this.node).find(".cn-actual-container");
                if (nodeActualContainer != null) {

                    // Append.
                    $(nodeActualContainer).append($(cnChildTemplate.node));
                }
                else {
                    // Append.
                    $(this.node).append($(cnChildTemplate.node));
                }
            }
        };

        this.show = () => {
            // Remove the html-class-attribs that hides the nodes.
            $(this.node).removeClass("cn-template");
            $(this.node).removeClass("cn-undisplayed");
        };

    }
}