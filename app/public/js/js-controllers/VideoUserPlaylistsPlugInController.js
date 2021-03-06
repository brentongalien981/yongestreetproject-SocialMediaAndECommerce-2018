import ComponentController from "./ComponentController.js";
import VideoUserPlaylistsPlugIn from "../cn-components/VideoUserPlaylistsPlugIn.js";
import VideoUserPlaylistsPlugInEventListeners from "../cn-event-listeners/VideoUserPlaylistsPlugInEventListeners.js";

class VideoUserPlaylistsPlugInController extends ComponentController {

    /** @override */
    implementEventListeners() {
        super.implementEventListeners();
        VideoUserPlaylistsPlugInEventListeners.handle(this);
    }


    /**
     * @override
     */
    regularInit() {
        super.regularInit();
        this.view = new VideoUserPlaylistsPlugIn();
    }


    /** @override */
    regularRead() {

        var earliestElDate = getLimitDateOfDomElement("earliest", "playlist-items");

        let ajaxRequestData = {
            controllerObj: this,
            modelClassName: "UserPlaylist",
            requestObj: {
                earliest_el_date: earliestElDate
            }
        };

        super.regularRead(ajaxRequestData);

    }

}

export { VideoUserPlaylistsPlugInController as default }