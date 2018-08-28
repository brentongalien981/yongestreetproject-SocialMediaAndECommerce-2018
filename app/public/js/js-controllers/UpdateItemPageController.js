import ThreeColumnedPageController from "./ThreeColumnedPageController.js";
// import CreateItemPage from "../cn-components/CreateItemPage.js";
import ItemDetailsFormController from "./ItemsDetailsFormController.js";
import UpdateItemPage from "../cn-components/UpdateItemPage.js";
import ItemsTableController from "./ItemsTableController.js";
import CnComponent3 from "../cn-components/CnComponent3.js";
import ItemsDetailsFormBroadcastSubscription from "../cn-subscription-schemes/ItemsDetailsFormBroadcastSubscription.js";


export default class UpdateItemPageController extends ThreeColumnedPageController {

    /** @override */
    implementEventListeners() {
        super.implementEventListeners();

        ItemsDetailsFormBroadcastSubscription.subscribe({
            subscriber: this,
            eventNames: [
                "onItemUpdateSuccess"
            ]
        });
    }

    /** @implements */
    onItemUpdateSuccess(data) {

        // 1) Update the ItemsTable's dataSource.
        this.itemsTableController.dataSource.updateObjs({ updatedObj: data.updatedObj });

        // 2) Update the ItemsTableRow's dataSource and view.
        let updatedRowComponent = CnComponent3.getComponent({
            id: data.updatedObj.id,
            nodeIdPrefix: "ItemsTableRow",
            fromComponents: this.itemsTableController.view.childComponents.itemsTableRows
        });

    
        updatedRowComponent.controller.dataSource.updateObjs({
            updatedObj: data.updatedObj
        });

        updatedRowComponent.refreshView();
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

        $(itemDetailsFormController.view.node).removeClass("col-10");
        $(itemDetailsFormController.view.node).addClass("col-12");

    }


    /** @override */
    regularInit() {

        // Ditch calling the super, because we let the view: UpdateItemPage
        // call its super-view's method: regularInit..
        // super.regularInit();

        this.view = new UpdateItemPage();
        this.view.controller = this;
    }
}

$(document).ready(function () {
    new UpdateItemPageController();
});