import CnComponent3 from './CnComponent3.js';

export default class ItemsTableRow extends CnComponent3 {

    constructor() {

        const myNode = CnComponent3.cnCloneTemplate({ id: "items-table #item-record-row-template" });
        super({ node: myNode });

    }


    /** @override */
    regularSetView(data = {}) {

        if (data.obj == null) { return; }

        const item = data.obj;

        $(this.node).attr("obj-id", item.id);
        $(this.node).find(".item-record-id").html(item.id);
        $(this.node).find(".item-record-name").html(item.name);
        $(this.node).find(".item-record-quantity").html(item.quantity);
        $(this.node).find(".item-record-price").html(item.price);
        $(this.node).find(".item-record-created-at").html(item.created_at_human_date + " (" + item.created_at + ")");
        $(this.node).find(".item-record-updated-at").html(item.updated_at_human_date);

    }

    /** @override */
    refreshView() {
        this.regularSetView({ obj: this.controller.dataSource.obj });
    }
}