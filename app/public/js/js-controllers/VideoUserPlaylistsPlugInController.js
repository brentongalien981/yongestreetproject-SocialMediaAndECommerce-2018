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
    read() {

        super.read({ modelClassName: "UserPlaylist" });

    }
}

export { VideoUserPlaylistsPlugInController as default }