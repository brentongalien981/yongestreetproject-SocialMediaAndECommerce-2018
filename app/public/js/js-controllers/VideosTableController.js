import ComponentController from "./ComponentController.js";
import VideosTable from "../cn-components/VideosTable.js";
import VideosTableEventListeners from "../cn-event-listeners/VideosTableEventListeners.js";

class VideosTableController extends ComponentController {

    /** @override */
    implementEventListeners() {
        super.implementEventListeners();
        VideosTableEventListeners.handle(this);
    }


    /**
     * @override
     */
    regularInit() {
        super.regularInit();
        this.view = new VideosTable();
        this.view.controller = this;
    }


    /** @override */
    regularRead() {

        const earliestElDate = this.dataSource.getLimitDate("earliest");
        const alreadyReadObjIds = this.dataSource.getAlreadyReadObjIds();
        const stringifiedAlreadyReadObjIds = cnStringify(alreadyReadObjIds);


        let ajaxRequestData = {
            controllerObj: this,
            controllerClassName: "UserVideo",
            modelClassName: "Video",
            isUsingRecipeFramework: true,
            requestObj: {
                earliest_el_date: earliestElDate,
                stringified_already_read_obj_ids: stringifiedAlreadyReadObjIds
            }
        };

        super.regularRead(ajaxRequestData);

    }


    /** @implement */
    onVideosTableRowClick(data = {}) {

        if (data.videoObj == null) { return; }
        
        const selectedVideoObj = this.dataSource.getObj({ withId: data.videoObj.id });
        
        this.dataSource.obj = selectedVideoObj;

        const videoDetailsForm = this.view.parentComponent.childComponents.videoDetailsForm;
        
        videoDetailsForm.populateFields(selectedVideoObj);


    }
}

export { VideosTableController as default }