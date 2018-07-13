import CnComponent from "./CnComponent.js";

class VideoCategoriesPlugIn extends CnComponent {

    constructor() {
        super({ nodeSelector: "#video-categories-plug-in" });
    }


    /**
     * TODO: Make this method accept parameters that make use
     * of the "model" of the MVC (not just a JSON).
     * @override
     * @param {*} json 
     */
    regularSetView(json) {

        var arrayOfCategoryObjs = json.objs;

        if (arrayOfUserPlaylistObjs == null) { return; }

        for (let i = 0; i < arrayOfCategoryObjs.length; i++) {
    
            // 1) Reference the ith obj.
            var currentObj = arrayOfCategoryObjs[i];
    
    
            // 2) Cn-clone the #video-categories-plug-in-item-template.
            var categyItem = cnCloneTemplate("#video-categories-plug-in-item-template");
            $(categyItem).attr("category-id", currentObj.id);
    
    
            // 3) Add class: video-categories-plug-in-item to the the cloned template.
            $(categyItem).addClass("video-categories-plug-in-item");
    
    
            // 4) Fill-in the cloned template with details from the ith obj.
            $(categyItem).html(currentObj.name);
            $(categyItem).attr("title", currentObj.name);
            $(categyItem).attr("created-at", currentObj.created_at);
    
            var categoryHref = get_local_url() + "video-categories/show.php?id=" + currentObj.id;
            $(categyItem).attr("href", categoryHref);
    
            // 5) Append.
            $("#video-categories-plug-in").find(".actual-contents-section").append($(categyItem));
        }
    }

    /** @override */
    postSetView() {

    }

}


export { VideoCategoriesPlugIn as default }