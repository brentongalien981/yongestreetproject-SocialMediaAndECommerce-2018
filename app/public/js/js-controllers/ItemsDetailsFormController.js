import ItemDetailsForm from "../cn-components/ItemDetailsForm.js";
import CnFormController from "./CnFormController.js";

export default class ItemDetailsFormController extends CnFormController {

    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new ItemDetailsForm();
    }
}