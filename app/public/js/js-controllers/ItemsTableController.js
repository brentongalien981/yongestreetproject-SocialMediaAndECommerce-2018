import ComponentController2 from "./ComponentController2.js";
import ItemsTable from "../cn-components/ItemsTable.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";
import ItemsTableEventListeners from "../cn-event-listeners/ItemsTableEventListeners.js";

export default class ItemsTableController extends ComponentController2 {

    implementEventListenersDirectly() {
        ItemsTableEventListeners.implement({
            eventNames: ["onReadMore"],
            eventSource: this,
            eventHandler: this
        });
    }


    /** @override */
    onReadMore() {
        // cnLog("onReadMore");
        this.crud({ operation: "read",loaderMsg: "Reading more..." });
    }


    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new ItemsTable();
        this.view.controller = this;
    }



    /** @override */
    regularRead() {

        const earliestElDate = this.dataSource.getLimitDate("earliest");
        const alreadyReadObjIds = this.dataSource.getAlreadyReadObjIds();
        const stringifiedAlreadyReadObjIds = cnStringify(alreadyReadObjIds);


        let ajaxRequestData = {
            controllerObj: this,
            controllerClassName: "Item",
            modelClassName: "Item",
            isUsingRecipeFramework: true,
            
            requestMethod: AjaxRequestConstants.REQUEST_METHOD_GET,
            crudType: AjaxRequestConstants.CRUD_TYPE_READ,
            requestObj: {
                earliest_el_date: earliestElDate,
                stringified_already_read_obj_ids: stringifiedAlreadyReadObjIds
            }
        };

        return ajaxRequestData;
    }

}
