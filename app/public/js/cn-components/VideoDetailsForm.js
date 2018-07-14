import CnForm from './CnForm.js';
import CnPart from './CnPart.js';
import CnComponent from './CnComponent.js';


class VideoDetailsForm extends CnForm {

    constructor() {
        super({ nodeSelector: "#video-details-form" });
    }

    /**
     * @override
     */
    initChildComponents() {
        super.initChildComponents();

        const publishBtn = new CnComponent({ nodeSelector: "#video-details-form #publish-video-btn" });

        this.childComponents = { publishBtn: publishBtn };

    }



    /**
     * TODO: Make this method accept parameters that make use
     * of the "model" of the MVC (not just a JSON).
     * @override
     * @param {*} json 
     */
    regularSetView(json) {

        var arrayOfCategoryObjs = json.objs;

        if (arrayOfCategoryObjs == null) { return; }

        for (let i = 0; i < arrayOfCategoryObjs.length; i++) {
    
            // 1) Reference the ith obj.
            var currentObj = arrayOfCategoryObjs[i];
    
    
            // 2) Cn-clone the #video-category-option-template.
            var categoryOption = cnCloneTemplate("#video-category-option-template");
            $(categoryOption).attr("value", currentObj.id);
    
    
            // 4) Fill-in the cloned template with details from the ith obj.
            $(categoryOption).html(currentObj.name);
    
            // 5) Append.
            $("#video-details-form select").append($(categoryOption));
        }

    }
}


export { VideoDetailsForm as default}