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
        const updateBtn = new CnComponent({ nodeSelector: "#video-details-form #update-video-btn" });

        const videoTitle = new CnComponent({ nodeSelector: "#video-title" });

        const videoOwnerUserName = new CnComponent({ nodeSelector: "#video-owner-user-name" });
        const videoEmbedCode = new CnComponent({ nodeSelector: "#video-embed-code" });
        const videoDescription = new CnComponent({ nodeSelector: "#video-description" });
        const videoTags = new CnComponent({ nodeSelector: "#video-tags" });
        const videoCategories = new CnComponent({ nodeSelector: "#video-categories-select-control" });
        const videoPrivacy = new CnComponent({ nodeSelector: "#private-video-checkbox" });

        this.childComponents = { 
            publishBtn: publishBtn,
            updateBtn: updateBtn,
            videoTitle: videoTitle,
            videoOwnerUserName: videoOwnerUserName,
            videoEmbedCode: videoEmbedCode,
            videoDescription: videoDescription,
            videoTags: videoTags,
            videoCategories: videoCategories,
            videoPrivacy: videoPrivacy
        };
    }


    /** @override */
    getFormErrorLabelNodeBasedOnModelFieldName(fieldName = "") {

        switch (fieldName) {
            case "title": 
                return $("#cn-error-label-video-title");
            case "description": 
                return $("#cn-error-label-video-description");    
            case "url": 
                return $("#cn-error-label-video-embed-code");    
            case "owner_name": 
                return $("#cn-error-label-video-owner-user-name");    
            case "tags": 
                return $("#cn-error-label-video-tags"); 
            case "categories": 
                return $("#cn-error-label-video-categories-select-control");                    
            default:
                return null;
        }
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


    populateFields(selectedVideoObj) {

        $(this.childComponents.videoTitle.node).val(selectedVideoObj.title);
        $(this.childComponents.videoOwnerUserName.node).val(selectedVideoObj.owner_name);
        $(this.childComponents.videoEmbedCode.node).val(selectedVideoObj.url);
        $(this.childComponents.videoDescription.node).val(selectedVideoObj.description);

        this.setTagsField(selectedVideoObj.tags);
        this.setCategoriesField(selectedVideoObj.categories);
        this.setPrivacyField(selectedVideoObj.private);

    }

    setPrivacyField(privacy) {
        if (privacy == 0) {
            $(this.childComponents.videoPrivacy.node).prop("checked", false);
        } else {
            $(this.childComponents.videoPrivacy.node).prop("checked", true);
        }

    }



    setCategoriesField(categoryObjs) {

        let categoryOptionElements = $(this.childComponents.videoCategories.node).find("option");

        let categoryIds = [];

        for (let i = 0; i < categoryObjs.length; i++) {
            const categoryId = categoryObjs[i].id;
            categoryIds.push(categoryId);
        }

        for (let i = 0; i < categoryOptionElements.length; i++) {

            const categoryOptionEl = categoryOptionElements[i];

            const categoryOptionVal = $(categoryOptionEl).attr("value");

            if (categoryIds.includes(categoryOptionVal)) {
                $(categoryOptionEl).attr("selected", "");
            } else {
                $(categoryOptionEl).removeAttr("selected");
            }
            
        }
    }



    setTagsField(tagObjs) {

        let tagNames = [];

        for (let i = 0; i < tagObjs.length; i++) {
            const tagName = tagObjs[i].tag;
            tagNames.push(tagName);
        }

        const stringifiedTagNames = cnStringify(tagNames);

        $(this.childComponents.videoTags.node).val(stringifiedTagNames);
    }


    editLabels(data = {}) {
        if (data.headerLabel != null) {
            $(this.node).find(".header-label").html(data.headerLabel);
        }

        if (data.submitBtn != null) {
            $(this.childComponents.publishBtn.node).html(data.submitBtn);
        }
    }
}


export { VideoDetailsForm as default}