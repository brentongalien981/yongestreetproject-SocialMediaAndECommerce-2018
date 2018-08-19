import ComponentController from "./ComponentController.js";
import ItemsTable from "../cn-components/ItemsTable.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";

export default class ItemsTableController extends ComponentController {

    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new ItemsTable();
        this.view.controller = this;
    }



    /** @override */
    regularRead(ajaxRequestData = {}) {

        const earliestElDate = this.dataSource.getLimitDate("earliest");
        const alreadyReadObjIds = this.dataSource.getAlreadyReadObjIds();
        const stringifiedAlreadyReadObjIds = cnStringify(alreadyReadObjIds);


        ajaxRequestData = {
            ...ajaxRequestData,
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

        super.regularRead(ajaxRequestData);
    }
}
