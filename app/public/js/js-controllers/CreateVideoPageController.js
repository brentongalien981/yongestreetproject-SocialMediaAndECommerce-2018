import PageController from "./PageController.js";
import CreateVideoPage from "../cn-components/CreateVideoPage.js";
import VideoUserPlaylistsPlugInController from "./VideoUserPlaylistsPlugInController.js";
import ThreeColumnedPageEventListeners from "../cn-event-listeners/ThreeColumnedPageEventListeners.js";
import VideoCategoriesPlugInController from "./VideoCategoriesPlugInController.js";
// import CreateVideoPageEventListeners from "../cn-event-listeners/CreateVideoPageEventListeners.js";
import VideoDetailsFormController from "./VideoDetailsFormController.js";

class CreateVideoPageController extends PageController {

    /**
     * @override
     */
    regularInit() {
        super.regularInit();
        // this.view = new VideoUserPlaylistsPlugIn();
        this.view = new CreateVideoPage();
    }



    /** @override */
    implementEventListeners() {
        super.implementEventListeners();
        // this.eventListenerObj = new ThreeColumnedPageEventListeners();
        // ThreeColumnedPageEventListeners.handle(this);
        ThreeColumnedPageEventListeners.handle(this);
        // CreateVideoPageEventListeners.handle(this);
    }


    /**
     * @override
     */
    initExtentionalControllers() {

        this.videoUserPlaylistsPlugInController = new VideoUserPlaylistsPlugInController();
        this.videoUserPlaylistsPlugInController.view.appendTo(this.view.parts.cnLeftCol);
        this.videoUserPlaylistsPlugInController.read();

        let theController = this;


        setTimeout(function () {
            let videoDetailsFormController = new VideoDetailsFormController();
            videoDetailsFormController.view.appendTo(theController.view.parts.cnCenterCol);
            videoDetailsFormController.index();

            $(videoDetailsFormController.view.childComponents.publishBtn.node).css("display", "block");
            $(videoDetailsFormController.view.childComponents.updateBtn.node).css("display", "none");

            
        }, 200);


        setTimeout(function () {
            let videoCategoriesPlugInController = new VideoCategoriesPlugInController();
            videoCategoriesPlugInController.view.appendTo(theController.view.parts.cnRightCol);
            videoCategoriesPlugInController.read();
        }, 400);


    }
}

export { CreateVideoPageController as default }


$(document).ready(function () {
    new CreateVideoPageController();
});