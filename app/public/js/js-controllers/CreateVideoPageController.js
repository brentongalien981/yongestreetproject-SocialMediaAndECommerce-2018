import PageController from "./PageController.js";
import CreateVideoPage from "../cn-components/CreateVideoPage.js";
import VideoUserPlaylistsPlugInController from "./VideoUserPlaylistsPlugInController.js";
import ThreeColumnedPageEventListeners from "../cn-event-listeners/ThreeColumnedPageEventListeners.js";

class CreateVideoPageController extends PageController {

    constructor() {
        super();

        this.view = new CreateVideoPage();

        this.implementEventListeners();
        
        this.videoUserPlaylistsController.view.appendTo(this.view.parts.cnLeftCol);
        this.videoUserPlaylistsController.read();

    }

    implementEventListeners() {
        // this.eventListenerObj = new ThreeColumnedPageEventListeners();
        // ThreeColumnedPageEventListeners.handle(this);
        ThreeColumnedPageEventListeners.implement(this);
    }


    /**
     * @override
     */
    initExtentionalControllers() {
        this.videoUserPlaylistsController = new VideoUserPlaylistsPlugInController();

    }
}

export { CreateVideoPageController as default }


$(document).ready(function () {
    new CreateVideoPageController();
});