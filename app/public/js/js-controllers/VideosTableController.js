import ComponentController from "./ComponentController.js";
import VideosTable from "../cn-components/VideosTable.js";

class VideosTableController extends ComponentController {

    /**
     * @override
     */
    regularInit() {
        super.regularInit();
        this.view = new VideosTable();
    }


    /** @override */
    regularRead() {

        const earliestElDate = this.dataSource.getLimitDate("earliest");

        let ajaxRequestData = {
            controllerObj: this,
            modelClassName: "Video",
            requestObj: {
                earliest_el_date: earliestElDate
            }
        };

        super.regularRead(ajaxRequestData);

    }
}

export { VideosTableController as default }