import PageController from "./PageController.js";
import CreateVideoPage from "../cn-components/CreateVideoPage.js";
import VideoUserPlaylistsPlugInController from "./VideoUserPlaylistsPlugInController.js";

class CreateVideoPageController extends PageController {

    constructor() {
        super();

        this.view = new CreateVideoPage();

        this.videoUserPlaylistsController.view.appendTo(this.view.parts.cnLeftCol);
        this.videoUserPlaylistsController.read();
    }

    /**
     * @override
     */
    initExtentionalControllers() {
        this.videoUserPlaylistsController = new VideoUserPlaylistsPlugInController();
        
    }
}

export { CreateVideoPageController as default}


$(document).ready(function () {
    new CreateVideoPageController();
});