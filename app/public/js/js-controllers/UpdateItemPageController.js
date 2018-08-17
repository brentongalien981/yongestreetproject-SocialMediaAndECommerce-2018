import ThreeColumnedPageController from "./ThreeColumnedPageController.js";
// import CreateItemPage from "../cn-components/CreateItemPage.js";
import ItemDetailsFormController from "./ItemsDetailsFormController.js";
import UpdateItemPage from "../cn-components/UpdateItemPage.js";

export default class UpdateItemPageController extends ThreeColumnedPageController {

    /** @override */
    initExtentionalControllers() {
        super.initExtentionalControllers();
        
        this.initItemDetailsFormController();
    }


    initItemDetailsFormController() {
        // let theController = this;
        let itemDetailsFormController = new ItemDetailsFormController();
        
    }


    /** @override */
    regularInit() {
        // super.regularInit();
        this.view = new UpdateItemPage();
    }
}

$(document).ready(function () {
    new UpdateItemPageController();
});