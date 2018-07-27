import ComponentController from "./ComponentController.js";
import VideosTableRow from "../cn-components/VideosTableRow.js";
// import VideosTableEventListeners from "../cn-event-listeners/VideosTableEventListeners.js";

class VideosTableRowController extends ComponentController {    

    /**
     * @override
     */
    regularInit() {
        super.regularInit();
        this.view = new VideosTableRow();
        this.view.controller = this;
    }

}

export { VideosTableRowController as default }