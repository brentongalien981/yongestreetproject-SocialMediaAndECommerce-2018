import ComponentController from "./ComponentController.js";
import VideosTable from "../cn-components/VideosTable.js";
import VideosTableEventListeners from "../cn-event-listeners/VideosTableEventListeners.js";
import VideoDetailsFormBroadcastSubscription from "../cn-subscription-schemes/VideoDetailsFormBroadcastSubscription.js";
import CnComponent2 from "../cn-components/CnComponent2.js";

class VideosTableController extends ComponentController {


    /** @override */
    postInit() {
        super.postInit();

        VideoDetailsFormBroadcastSubscription.subscribe({
            subscriber: this,
            eventNames: [
                "onVideoUpdateSuccess"
            ]
        });
    }


    /** @implements */
    onVideoUpdateSuccess(data = { updatedObj: null }) {

        if (data.updatedObj == null) { return; }

        const selectedVideosTableRow = CnComponent2.getComponent({
            id: this.dataSource.obj.id,
            nodeIdPrefix: "VideosTableRow",
            fromComponents: this.view.childComponents.videosTableRows
        });

        // Update the dataSource.objs and dataSource.newlyAddedObjs.
        this.dataSource.updateObjs({
            updatedObj: data.updatedObj
        });


        // Update the component.
        selectedVideosTableRow.regularSetView({ obj: data.updatedObj });
    }


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


    /** @implements */
    onVideosTableRowClick(data = {}) {

        if (data.videoObj == null) { return; }

        const selectedVideoObj = this.dataSource.getObj({ withId: data.videoObj.id });

        this.dataSource.obj = selectedVideoObj;

        const videoDetailsForm = this.view.parentComponent.childComponents.videoDetailsForm;

        videoDetailsForm.populateFields(selectedVideoObj);


    }


    /** @implements */
    onVideosTableRowDelete(data = { videosTableRowController: null }) {

        const objToBeDeleted = data.videosTableRowController.dataSource.obj;

        // Delete the dataSource obj VideosTableRow Data / Model.
        this.dataSource.deleteObj({ obj: objToBeDeleted });

        // // Delete the VideosTableRowController or delete
        // // the VideosTableRowController's view.
        // data.videosTableRowController.delete();

        data.videosTableRowController = null;

        // Clear the form.
        this.view.parentComponent.childComponents.videoDetailsForm.clearInputFields();

    }
}

export { VideosTableController as default }