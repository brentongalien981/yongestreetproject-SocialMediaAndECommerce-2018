// import ComponentController from "./ComponentController.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";
import ItemsTableRow from "../cn-components/ItemsTableRow.js";
import ItemsTableRowBroadcastSubscription from "../cn-subscription-schemes/ItemsTableRowBroadcastSubscription.js";
import ComponentController2 from "./ComponentController2.js";



export default class ItemsTableRowController extends ComponentController2 {

    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new ItemsTableRow();
        this.view.controller = this;
    }


    /** @override */
    regularHandleAjaxRequestResult(ajaxRequest, resultJSON) {

        switch (ajaxRequest.crudType) {
            case "delete":
                this.view.delete();
                // ItemsTableRowBroadcastSubscription.broadcast({ eventName: "onRowDeleteSuccess" });

                let updateItemPageController = this.view.parentComponent.parentComponent.parentComponent.controller;
                updateItemPageController.onRowDeleteSuccess({ dataSourceObj: this.dataSource.obj });
                break;
            default:
                super.regularHandleAjaxRequestResult(ajaxRequest, resultJSON);
                break;
        }
    }



    /** @override */
    regularDelete() {

        let ajaxRequestData = {
            controllerObj: this,
            controllerClassName: "Item",
            modelClassName: "Item",
            isUsingRecipeFramework: true,

            requestMethod: AjaxRequestConstants.REQUEST_METHOD_POST,
            crudType: AjaxRequestConstants.CRUD_TYPE_DELETE,
            requestObj: {
                item_id: this.dataSource.obj.id
            }
        };

        return ajaxRequestData;
    }



    /** @override */
    implementEventListeners() {
        super.implementEventListeners();

        // ItemsTableRowBroadcastSubscription.implement({
        //     broadcaster: this
        // });
    }
}