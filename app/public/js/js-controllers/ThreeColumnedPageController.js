import PageController from "./PageController.js";
import ThreeColumnedPage from "../cn-components/ThreeColumnedPage.js";
import ThreeColumnedPageEventListeners from "../cn-event-listeners/ThreeColumnedPageEventListeners.js";

export default class ThreeColumnedPageController extends PageController {

    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new ThreeColumnedPage();
    }


    /** @override */
    implementEventListeners() {
        super.implementEventListeners();
        ThreeColumnedPageEventListeners.handle(this);
    }
}