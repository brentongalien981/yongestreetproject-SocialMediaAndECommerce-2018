import PageController from "./PageController.js";
import CreateVideoPage from "../cn-components/CreateVideoPage.js";
import VideoUserPlaylistsPlugInController from "./VideoUserPlaylistsPlugInController.js";
import ThreeColumnedPageEventListeners from "../cn-event-listeners/ThreeColumnedPageEventListeners.js";
import VideoCategoriesPlugInController from "./VideoCategoriesPlugInController.js";

class CreateVideoPageController extends PageController {

    constructor() {
        super();

        this.view = new CreateVideoPage();

        this.implementEventListeners();

        this.videoUserPlaylistsPlugInController = null;
        this.initExtentionalControllers();

    }

    implementEventListeners() {
        // this.eventListenerObj = new ThreeColumnedPageEventListeners();
        // ThreeColumnedPageEventListeners.handle(this);
        ThreeColumnedPageEventListeners.handle(this);
    }


    /**
     * 
     */
    initExtentionalControllers() {

        this.videoUserPlaylistsPlugInController = new VideoUserPlaylistsPlugInController();
        this.videoUserPlaylistsPlugInController.view.appendTo(this.view.parts.cnLeftCol);
        this.videoUserPlaylistsPlugInController.read();

        let theController = this;
        
        setTimeout(function () {
            let videoCategoriesPlugInController = new VideoCategoriesPlugInController();
            videoCategoriesPlugInController.view.appendTo(theController.view.parts.cnRightCol);
            videoCategoriesPlugInController.read();
        }, 100);


    }
}

export { CreateVideoPageController as default }


$(document).ready(function () {
    new CreateVideoPageController();
});