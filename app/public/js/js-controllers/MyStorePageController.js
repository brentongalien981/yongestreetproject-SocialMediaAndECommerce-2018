import ThreeColumnedPageController from "./ThreeColumnedPageController.js";
import MyStorePage from "../cn-components/MyStorePage.js";
import ItemsHolderController from "./ItemsHolderController.js";
import SearchBarPlugInController from "./SearchBarPlugInController.js";
import PageNumberNavigatorController from "./PageNumberNavigatorController.js";

export default class MyStorePageController extends ThreeColumnedPageController {


    initPageNumberNavigatorController() {

        let pageNumberNavigatorController = new PageNumberNavigatorController();
        this.pageNumberNavigatorController = pageNumberNavigatorController;

        pageNumberNavigatorController.view.parentComponent = this.view;
    }

    initMyStoreItemsSearchBarPlugInController() {

        let searchBarPlugInController = new SearchBarPlugInController();
        this.searchBarPlugInController = searchBarPlugInController;

        searchBarPlugInController.view.parentComponent = this.view;
    }


    initItemsHolderController() {

        let itemsHolderController = new ItemsHolderController();
        this.itemsHolderController = itemsHolderController;

        itemsHolderController.view.parentComponent = this.view;


        this.view.childComponents = {
            ...this.view.childComponents,
            itemsHoldler: itemsHolderController.view
        };

        this.view.parts.cnCenterCol.append(itemsHolderController.view);

    }



    /** @override */
    initExtentionalControllers() {
        super.initExtentionalControllers();

        this.initItemsHolderController();
        this.initMyStoreItemsSearchBarPlugInController();
        this.initPageNumberNavigatorController();
    }



    /** @override */
    regularInit() {
        // Ditch calling the super, because we let the view: UpdateItemPage
        // call its super-view's method: regularInit..
        // super.regularInit();

        this.view = new MyStorePage();
        this.view.controller = this;
    }
}


$(document).ready(function () {
    new MyStorePageController();
});