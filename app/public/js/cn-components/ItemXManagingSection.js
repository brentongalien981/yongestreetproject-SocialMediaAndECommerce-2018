import CnComponent2 from './CnComponent2.js';

export default class ItemXManagingSection extends CnComponent2 {

    constructor(data = {}) {

        data = {
            sectionTitle: "TODO: SECTION_TITLE",
            description: "",
            ...data
        }

        const myNode = CnComponent2.cnCloneTemplate({ id: "itemx-managing-section-template" });
        super({ node: myNode });

        //
        this.setSectionTitle(data.sectionTitle);
        // this.setNodeId(data.itemName);
    }


    setSectionTitle(sectionTitle) {

        $(this.node).find(".itemx-managing-section-title").html(sectionTitle);
    }
}