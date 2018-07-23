import CnFormController from "./CnFormController.js";
import VideoDetailsForm from "../cn-components/VideoDetailsForm.js";
import VideoDetailsFormEventListeners from "../cn-event-listeners/VideoDetailsFormEventListeners.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";


class VideoDetailsFormController extends CnFormController {


    /** @override */
    preHandleAjaxRequestResult(ajaxRequest, resultJSON) {
        super.preHandleAjaxRequestResult(ajaxRequest, resultJSON);

        // Enable the publish button.
        $(this.view.childComponents.publishBtn.node).removeAttr("disabled");

        this.view.clearInputFields();
    }


    /** @override */
    regularHandleAjaxRequestResult(ajaxRequest, resultJSON) {
        // Override this.

        switch (ajaxRequest.crudType) {
            case "create":
                alert("oh yeah");
                break;
            default:
                super.regularHandleAjaxRequestResult(ajaxRequest, resultJSON);
        }
    }


    /** @override */
    regularCreate(ajaxRequestData = {}) {

        let videoTitle = $(this.view.childComponents.videoTitle.node).val();
        let videoOwnerUserName = $(this.view.childComponents.videoOwnerUserName.node).val();

        let videoEmbedCode = $(this.view.childComponents.videoEmbedCode.node).val();
        let videoDescription = $(this.view.childComponents.videoDescription.node).val();

        let videoTags = $(this.view.childComponents.videoTags.node).val();
        let videoCategories = $(this.view.childComponents.videoCategories.node).val();
        let videoPrivacy = $(this.view.childComponents.videoPrivacy.node).prop("checked");


        //
        let videoEmbedCodeAttribs = {
            src: getAttributeValue(videoEmbedCode, "src")
        };

        let stringifiedCategories = cnStringify(videoCategories);



        // 
        if (this.checkVideoEmbedCodeAttributes(videoEmbedCodeAttribs)) {

            let ajaxRequestObj = {
                title: videoTitle,
                description: videoDescription,
                url: videoEmbedCodeAttribs.src,
                owner_name: videoOwnerUserName,
                tags: videoTags,
                categories: stringifiedCategories,
                private: videoPrivacy
            }


            let ajaxRequestData = {
                controllerObj: this,
                modelClassName: "Video",
                requestMethod: AjaxRequestConstants.REQUEST_METHOD_POST,
                crudType: AjaxRequestConstants.CRUD_TYPE_CREATE,
                requestObj: ajaxRequestObj
            };

            super.regularCreate(ajaxRequestData);

            return true;

        } else {

            // Here means pre-creation fails so reset things.
            this.view.hideLoaderNode();

            // Disable the publish button.
            $(this.view.childComponents.publishBtn.node).removeAttr("disabled");

            return false;
        }

    }


    /** @override */
    preCreate() {

        // Show the cn-loader-node.
        this.view.showLoaderNode("We're just saving your video real quick...");

        // Disable the publish button.
        $(this.view.childComponents.publishBtn.node).attr("disabled", "true");

        //
        if (super.preCreate()) { return true; }

        return false;
    }


    checkVideoEmbedCodeAttributes(attribs = {}) {
        // If the attributes are type incorrectly or not at all (eg. hre/hef/ref and
        // not href), then show an error alert.
        if (attribs.src == null || attribs.src == false) {
            window.alert("Sorry, but the src attribute is not valid...");
            return false;
        }

        return true;
    }


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