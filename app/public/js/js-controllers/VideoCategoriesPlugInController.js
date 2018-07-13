import ComponentController from "./ComponentController.js";
import VideoCategoriesPlugIn from "../cn-components/VideoCategoriesPlugIn.js";
import VideoCategoriesPlugInEventListeners from "../cn-event-listeners/VideoCategoriesPlugInEventListeners.js";

class VideoCategoriesPlugInController extends ComponentController {

    /** @override */
    implementEventListeners() {
        super.implementEventListeners();
        VideoCategoriesPlugInEventListeners.implement(this);
    }


    /** @implement */
    onReadMoreObjectsBtnClicked() {

        // Re-show all the category-items.
        var categoryItems = $("#video-categories-plug-in").find(".video-categories-plug-in-item");
        $(categoryItems).css("display", "block");


        // Try to show the "show-less-btn".
        if (categoryItems.length > 7) {
            $("#video-categories-plug-in").find(".show-less-btn").css("visibility", "visible");
        }
        else {
            $("#video-categories-plug-in").find(".show-less-btn").css("visibility", "hidden");
        }

        //
        this.read();
    }

    /** @implement */
    onShowLessObjectsBtnClicked() {
        var categoryItems = $("#video-categories-plug-in").find(".video-categories-plug-in-item");

        // Hide the 6th and beyond playlist-items.
        for (let i = 5; i < categoryItems.length; i++) {
            $(categoryItems[i]).css("display", "none");
        }

        // Hide this "show-less-btn".
        $("#video-categories-plug-in").find(".show-less-btn").css("visibility", "hidden");
    }


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