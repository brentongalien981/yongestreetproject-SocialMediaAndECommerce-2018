import ComponentController2 from "./ComponentController2.js";
import SearchBarPlugIn from "../cn-components/SearchBarPlugIn.js";

export default class SearchBarPlugInController extends ComponentController2 {

    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new SearchBarPlugIn();
    }
}