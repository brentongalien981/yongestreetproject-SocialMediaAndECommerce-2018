import PageController from "./PageController.js";
import UpdateVideoPage from "../cn-components/UpdateVideoPage.js";
import VideoUserPlaylistsPlugInController from "./VideoUserPlaylistsPlugInController.js";
import ThreeColumnedPageEventListeners from "../cn-event-listeners/ThreeColumnedPageEventListeners.js";
import VideoCategoriesPlugInController from "./VideoCategoriesPlugInController.js";
import VideoDetailsFormController from "./VideoDetailsFormController.js";
import VideosTableController from "./VideosTableController.js";

class UpdateVideoPageController extends PageController {

    /** @override */
    implementEventListeners() {
        super.implementEventListeners();
        ThreeColumnedPageEventListeners.handle(this);
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

            $(videoDetailsFormController.view.node).removeClass("col-10");
            $(videoDetailsFormController.view.node).addClass("col-12");
            
            // videoDetailsFormController.view.appendTo(theController.view.parts.cnCenterCol);
            videoDetailsFormController.index();

        }, 200);


        setTimeout(function () {
            let videoCategoriesPlugInController = new VideoCategoriesPlugInController();
            videoCategoriesPlugInController.view.appendTo(theController.view.parts.cnRightCol);
            videoCategoriesPlugInController.read();
        }, 400);

        setTimeout(function () {
            let videosTableController = new VideosTableController();
            videosTableController.read({loaderMsg: "Reading more videos real quick..."});
        }, 600);


    }



    /**
     * @override
     */
    regularInit() {
        super.regularInit();
        this.view = new UpdateVideoPage();
    }

}


export { UpdateVideoPageController as default }


$(document).ready(function () {
    new UpdateVideoPageController();
});