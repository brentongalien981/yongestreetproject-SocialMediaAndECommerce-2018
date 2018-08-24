import ThreeColumnedPageController from "./ThreeColumnedPageController.js";
// import CreateItemPage from "../cn-components/CreateItemPage.js";
import ItemDetailsFormController from "./ItemsDetailsFormController.js";
import UpdateItemPage from "../cn-components/UpdateItemPage.js";
import ItemsTableController from "./ItemsTableController.js";
import ItemsTableRowBroadcastSubscription from "../cn-subscription-schemes/ItemsTableRowBroadcastSubscription.js";

export default class UpdateItemPageController extends ThreeColumnedPageController {

    /** @override */
    implementEventListeners() {
        super.implementEventListeners();

        // ItemsTableRowBroadcastSubscription.subscribe({
        //     subscriber: this,
        //     eventNames: [
        //         "onRowDeleteSuccess"
        //     ]
        // });
    }


    onRowDeleteSuccess(data) {

        // 1) Clear the form.
        let currentObjOfForm = this.itemDetailsFormController.dataSource.obj;
        let deletedObj = data.dataSourceObj;
        if (deletedObj.id == currentObjOfForm.id) {
            this.itemDetailsFormController.view.clearInputFields();
        }
        


        // 2) Delete the XDetailsForm's dataSource's obj equal to the deleted obj.
        this.itemDetailsFormController.dataSource.deleteObj({ obj: deletedObj });


        // 3) Delete the XTable's dataSource's obj equal to the deleted obj.
        this.itemsTableController.dataSource.deleteObj({ obj: deletedObj });

        // 4) 
        if (this.itemsTableController.view.hasAlmostReachedBottom()) {
            this.itemsTableController.crud({ operation: "read", loaderMsg: "Reading..." });
        }
    }


    /** @implements */
    onRowClick(data = { selectedItemObj: null }) {

        //
        this.itemsTableController.dataSource.obj = data.selectedItemObj;
        //
        this.itemDetailsFormController.dataSource.obj = data.selectedItemObj;

        this.itemDetailsFormController.view.populateFields(data.selectedItemObj);

    }

    /** @override */
    initItemsTableController() {

        let itemsTableController = new ItemsTableController();
        this.itemsTableController = itemsTableController;
        this.view.append(itemsTableController.view);

        itemsTableController.crud({ operation: "read", loaderMsg: "Reading..." });

    }


    /** @override */
    initExtentionalControllers() {
        super.initExtentionalControllers();

        this.initItemDetailsFormController();
        this.initItemsTableController();
    }


    initItemDetailsFormController() {

        let itemDetailsFormController = new ItemDetailsFormController();
        this.itemDetailsFormController = itemDetailsFormController;
        this.view.append(itemDetailsFormController.view);

        let formHeaderLabel = itemDetailsFormController.view.childComponents.formHeaderLabel;
        $(formHeaderLabel.node).html("Edit Item");

    }


    /** @override */
    regularInit() {
        // super.regularInit();
        this.view = new UpdateItemPage();
        this.view.controller = this;
    }
}

$(document).ready(function () {
    new UpdateItemPageController();
});