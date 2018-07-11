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


    /** @override */
    regularHandleAjaxRequestResult(ajaxRequest, resultJSON) {

        switch (ajaxRequest.crudType) {
            case "read":
                this.view.setView(resultJSON);
                break;
            case "show":
                break;
            case "create":
                break;
            case "update":
                break;
            case "delete":
                break;
            case "fetch":
                break;
            case "patch":
                break;
            case "show":
                break;
        }
    }
}

export { VideoUserPlaylistsPlugInController as default }