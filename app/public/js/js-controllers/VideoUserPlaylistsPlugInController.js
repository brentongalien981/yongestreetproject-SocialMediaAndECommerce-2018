import ComponentController from "./ComponentController.js";
import VideoUserPlaylistsPlugIn from "../cn-components/VideoUserPlaylistsPlugIn.js";

class VideoUserPlaylistsPlugInController extends ComponentController {

    /**
     * @override
     */
    regularInit() {
        this.view = new VideoUserPlaylistsPlugIn();
    }


    /** @override */
    regularRead() {

        // TODO: 
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