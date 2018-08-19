import ThreeColumnedPageController from "./ThreeColumnedPageController.js";
// import CreateItemPage from "../cn-components/CreateItemPage.js";
import ItemDetailsFormController from "./ItemsDetailsFormController.js";
import UpdateItemPage from "../cn-components/UpdateItemPage.js";
import ItemsTableController from "./ItemsTableController.js";

export default class UpdateItemPageController extends ThreeColumnedPageController {

    /** @override */
    initItemsTableController() {
        
        let itemsTableController = new ItemsTableController();
        // itemsTableController.view.parentComponent = theController.view;
        // TODO: itemsTableController.read({ loaderMsg: "Reading..." });
        itemsTableController.read({ loaderMsg: "Reading..." });
        
    }


    /** @override */
    initExtentionalControllers() {
        super.initExtentionalControllers();
        
        this.initItemDetailsFormController();
        this.initItemsTableController();
    }


    initItemDetailsFormController() {
        // let theController = this;
        let itemDetailsFormController = new ItemDetailsFormController();
        let formHeaderLabel = itemDetailsFormController.view.childComponents.formHeaderLabel;
        $(formHeaderLabel.node).html("Edit Item");
        
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