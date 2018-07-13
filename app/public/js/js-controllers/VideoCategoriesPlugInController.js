import ComponentController from "./ComponentController.js";
import VideoCategoriesPlugIn from "../cn-components/VideoCategoriesPlugIn.js";

class VideoCategoriesPlugInController extends ComponentController {

    /**
     * @override
     */
    regularInit() {
        super.regularInit();
        this.view = new VideoCategoriesPlugIn();
    }


    /** @override */
    regularRead() {


        let earliestElDate = getLimitDateOfDomElement("earliest", "video-categories-plug-in-item");
        let idsOfAlreadyBeenReadCategories = this.getIdsOfAlreadyBeenReadCategories();
        let stringifiedIdsOfAlreadyBeenReadCategories = cnStringify(idsOfAlreadyBeenReadCategories);


        let ajaxRequestData = {
            controllerObj: this,
            modelClassName: "Category",
            requestObj: {
                earliest_el_date: earliestElDate,
                stringified_ids_of_already_been_read_categories: stringifiedIdsOfAlreadyBeenReadCategories
            }
        };

        super.regularRead(ajaxRequestData);

    }



    getIdsOfAlreadyBeenReadCategories() {

        var ids = [];
    
        var alreadyBeenItems = $("#video-categories-plug-in").find(".video-categories-plug-in-item");
    
        for (let i = 0; i < alreadyBeenItems.length; i++) {
            var currentId = $(alreadyBeenItems[i]).attr("category-id");
    
            ids[i] = currentId;
    
        }
    
        return ids;
    }
}

export { VideoCategoriesPlugInController as default }