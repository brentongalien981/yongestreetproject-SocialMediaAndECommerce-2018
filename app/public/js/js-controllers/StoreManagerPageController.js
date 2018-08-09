import StoreManagerPage from "../cn-components/StoreManagerPage.js";
import PageController from "./PageController.js";


export default class StoreManagerPageController extends PageController {

    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new StoreManagerPage({ nodeSelector: "#store-manager-component" });
        
    }

}


$(document).ready(function () {
    new StoreManagerPageController();
});