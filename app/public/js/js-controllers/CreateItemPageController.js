import ThreeColumnedPageController from "./ThreeColumnedPageController.js";
import CreateItemPage from "../cn-components/CreateItemPage.js";
import ItemDetailsFormController from "./ItemsDetailsFormController.js";

export default class CreateItemPageController extends ThreeColumnedPageController {

    /** @override */
    initExtentionalControllers() {
        super.initExtentionalControllers();
        
        this.initItemDetailsFormController();
    }


    initItemDetailsFormController() {
        // let theController = this;
        let itemDetailsFormController = new ItemDetailsFormController();
        this.view.parts.cnCenterCol.append(itemDetailsFormController.view);
        
    }


    /** @override */
    regularInit() {
        // super.regularInit();
        this.view = new CreateItemPage();
    }
}

$(document).ready(function () {
    new CreateItemPageController();
});