import CnFormController from "./CnFormController.js";
import VideoDetailsForm from "../cn-components/VideoDetailsForm.js";
import VideoDetailsFormEventListeners from "../cn-event-listeners/VideoDetailsFormEventListeners.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";

class VideoDetailsFormController extends CnFormController {


    /** @override */
    implementEventListeners() {
        super.implementEventListeners();
        VideoDetailsFormEventListeners.handle(this);
    }


    /** @override */
    regularIndex() {

        let ajaxRequestData = {
            crudType: AjaxRequestConstants.CRUD_TYPE_INDEX,
            controllerObj: this,
            modelClassName: "Category"
        };

        super.regularIndex(ajaxRequestData);

    }


    /**
     * @override
     */
    regularInit() {
        super.regularInit();
        this.view = new VideoDetailsForm();
    }
}

export { VideoDetailsFormController as default }