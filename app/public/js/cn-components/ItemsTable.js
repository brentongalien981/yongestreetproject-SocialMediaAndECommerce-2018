import CnComponent3 from "./CnComponent3.js";
import ItemsTableRowController from "../js-controllers/ItemsTableRowController.js";
import ItemsTableRowEventListeners from "../cn-event-listeners/ItemsTableRowEventListeners.js";

export default class ItemsTable extends CnComponent3 {

    constructor() {
        super({ nodeSelector: "#items-table" });

    }


    /** @override */
    initChildComponents() {
        super.initChildComponents();

        const headerTitle = new CnComponent3({ nodeSelector: "#items-table .header-title" });
        const itemsTableBody = new CnComponent3({ nodeSelector: "#items-table tbody" });
        const itemRecordRowTemplate = new CnComponent3({ nodeSelector: "#items-table #item-record-row-template" });
        const refForLoadingMoreObjs = new CnComponent3({ nodeSelector: "#items-table .reference-for-loading-more-objs" });
        const scrollableComponent = new CnComponent3({ nodeSelector: "#items-table .cn-table-container" });

        this.childComponents = {
            ...this.childComponents,
            headerTitle: headerTitle,
            itemsTableBody: itemsTableBody,
            itemRecordRowTemplate: itemRecordRowTemplate,
            scrollableComponent: scrollableComponent,
            refForLoadingMoreObjs: refForLoadingMoreObjs,
            itemsTableRows: []
        };

        this.refForLoadingMoreObjs = refForLoadingMoreObjs;
        this.scrollableComponent = scrollableComponent;
    }


    /** @override */
    regularSetView(data = { dataSource: null, json: null }) {

        let items = data.dataSource.newlyAddedObjs;

        for (let i = 0; i < items.length; i++) {

            let item = items[i];

            // 1) Set the ItemsTableRowController obj.
            let itemsTableRowController = new ItemsTableRowController();


            // 2) Set the ItemsTableRowController obj's dataSource..
            itemsTableRowController.dataSource.appendNewObj({ actualObj: item });
            itemsTableRowController.dataSource.obj = item;


            // 3) Set the ItemsTableRow (view) obj.
            itemsTableRowController.view.nodeId = itemsTableRowController.view.constructor.name + item.id;
            itemsTableRowController.view.refreshView();


            // 4) Append the ItemsTableRow (view) to the ItemsTable.
            this.childComponents.itemsTableBody.append(itemsTableRowController.view);


            // 5) Append the ItemsTableRow (view) to the ItemsTable's childComponents.
            this.childComponents.itemsTableRows.push(itemsTableRowController.view);

            
            // 6) Implement the event listeners for this table-row.
            let updateItemPageController = this.parentComponent.controller;

            ItemsTableRowEventListeners.implement({
                eventNames: ["onRowClick"],
                eventSource: itemsTableRowController,
                eventHandler: updateItemPageController
            });

        }
    }

}