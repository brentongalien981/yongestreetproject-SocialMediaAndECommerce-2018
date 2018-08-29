import ComponentController2 from "./ComponentController2.js";
import PageNumberNavigator from "../cn-components/PageNumberNavigator.js";

export default class PageNumberNavigatorController extends ComponentController2 {

    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new PageNumberNavigator();
    }
}