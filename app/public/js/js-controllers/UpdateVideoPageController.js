import PageController from "./PageController.js";
import UpdateVideoPage from "../cn-components/UpdateVideoPage.js";
import VideoUserPlaylistsPlugInController from "./VideoUserPlaylistsPlugInController.js";
import ThreeColumnedPageEventListeners from "../cn-event-listeners/ThreeColumnedPageEventListeners.js";
import VideoCategoriesPlugInController from "./VideoCategoriesPlugInController.js";
import VideoDetailsFormController from "./VideoDetailsFormController.js";
import VideosTableController from "./VideosTableController.js";
import VideoDetailsFormEventListeners from "../cn-event-listeners/VideoDetailsFormEventListeners.js";

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

            videoDetailsFormController.view.controller = videoDetailsFormController;

            theController.view.addChildComponent({
                videoDetailsForm: videoDetailsFormController.view
            });

            videoDetailsFormController.view.editLabels({
                headerLabel: "Edit Video"
            });

            $(videoDetailsFormController.view.childComponents.updateBtn.node).css("display", "block");
            $(videoDetailsFormController.view.childComponents.publishBtn.node).css("display", "none");

            $(videoDetailsFormController.view.node).removeClass("col-10");
            $(videoDetailsFormController.view.node).addClass("col-12");
        

            videoDetailsFormController.index();

            VideoDetailsFormEventListeners.implement({
                event: "onVideoUpdate",
                eventSource: videoDetailsFormController,
                eventHandler: theController,
                preventBaseHandler: true
            });

        }, 200);



        setTimeout(function () {
            let videoCategoriesPlugInController = new VideoCategoriesPlugInController();
            videoCategoriesPlugInController.view.appendTo(theController.view.parts.cnRightCol);
            videoCategoriesPlugInController.read();
        }, 400);


        setTimeout(function () {
            let videosTableController = new VideosTableController();
            videosTableController.view.parentComponent = theController.view;
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


    /** @implement */
    onVideoUpdate() {
        alert("method: onVideoUpdate() from class: UpdateVideoPageController.");
    }

}


export { UpdateVideoPageController as default }


$(document).ready(function () {
    new UpdateVideoPageController();
});