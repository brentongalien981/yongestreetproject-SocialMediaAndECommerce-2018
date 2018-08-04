import ComponentController from "./ComponentController.js";
import VideosTableRow from "../cn-components/VideosTableRow.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";
// import VideosTableEventListeners from "../cn-event-listeners/VideosTableEventListeners.js";

class VideosTableRowController extends ComponentController {    

    /**
     * @override
     */
    regularInit() {
        super.regularInit();
        this.view = new VideosTableRow();
        this.view.controller = this;
    }

    /** @override */
    regularDelete(ajaxRequestData = {}) {

        ajaxRequestData = {
            controllerObj: this,
            controllerClassName: "UserVideo",
            modelClassName: "Video",
            isUsingRecipeFramework: true,
            requestMethod: AjaxRequestConstants.REQUEST_METHOD_POST,
            crudType: AjaxRequestConstants.CRUD_TYPE_DELETE,
            requestObj: {
                video_id: this.dataSource.obj.id
            }
            
        };

        super.regularDelete(ajaxRequestData);

        return true;
    }

}

export { VideosTableRowController as default }