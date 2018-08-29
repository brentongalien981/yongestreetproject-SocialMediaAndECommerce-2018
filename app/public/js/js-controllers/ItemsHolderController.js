import ItemsHolder from "../cn-components/ItemsHolder.js";
import ComponentController2 from "./ComponentController2.js";

export default class ItemsHolderController extends ComponentController2 {


    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new ItemsHolder();
    }
}