import ComponentController from "./ComponentController.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";
import ItemsTableRow from "../cn-components/ItemsTableRow.js";

export default class ItemsTableRowController extends ComponentController {   

    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new ItemsTableRow();
        this.view.controller = this;
    }


    implementEventListenersDirectly() {
        // alert("TODO: method: implementEventListenersDirectly()");
    }
}