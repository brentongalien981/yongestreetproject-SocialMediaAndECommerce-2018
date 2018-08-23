import ComponentController from "./ComponentController.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";
import ItemsTableRow from "../cn-components/ItemsTableRow.js";
import ItemsTableRowEventListeners from "../cn-event-listeners/ItemsTableRowEventListeners.js";


export default class ItemsTableRowController extends ComponentController {

    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new ItemsTableRow();
        this.view.controller = this;
    }
}