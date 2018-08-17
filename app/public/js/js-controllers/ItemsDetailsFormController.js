import ItemDetailsForm from "../cn-components/ItemDetailsForm.js";
import CnFormController from "./CnFormController.js";
import ItemDetailsFormEventListeners from "../cn-event-listeners/ItemDetailsFormEventListeners.js";
import AjaxRequestConstants from "../cn-classes-v3/AjaxRequestConstants.js";
import CnNoticeComponent from "../cn-components/CnNoticeComponent.js";

export default class ItemDetailsFormController extends CnFormController {


    /** @override */
    preHandleAjaxRequestResult(ajaxRequest, resultJSON) {
        super.preHandleAjaxRequestResult(ajaxRequest, resultJSON);

        if (isCnAjaxResultOk(resultJSON)) {
            this.view.clearInputFields();
        }
    }


    /** @override */
    regularHandleAjaxRequestResult(ajaxRequest, resultJSON) {

        switch (ajaxRequest.crudType) {
            case "create":
                this.onCreateSuccess(resultJSON);
                break;
            case "update":
                // this.dataSource.obj = resultJSON.objs[0];
                // VideoDetailsFormBroadcastSubscription.broadcast({ eventName: "onVideoUpdateSuccess" });
                break;
            default:
                super.regularHandleAjaxRequestResult(ajaxRequest, resultJSON);
                break;
        }
    }


    onCreateSuccess(json) {

        let noticeComponent = new CnNoticeComponent({ message: "You successfully created your item..." });

        let newItemPageLinkNode = document.createElement("a");

        const newItemObj = json.objs[0];

        let newItemPageLink = getLocalUrl() + "item/show/" + newItemObj.id + "/";

        $(newItemPageLinkNode).attr("href", newItemPageLink);
        $(newItemPageLinkNode).html("You can click here to view it..");

        $(noticeComponent.extraMessageNode).append(newItemPageLinkNode);

        this.view.append(noticeComponent);
    }


    /**
     * 
     * @param {string} itemEmbedCode Comma-separated-strings of
     * html-embed-codes and/or urls.
     * @returns {array} photoUrls.
     */
    extractPhotoUrls(itemEmbedCode) {

        // Convert itemEmbedCode to array.
        let maxNumOfPhotoUrls = 5;
        let embedCodes = itemEmbedCode.split(",", maxNumOfPhotoUrls);

        let photoUrls = [];

        if (embedCodes[0] == "") { return photoUrls; }

        // Loop through each embed-code / url.
        for (let i = 0; i < embedCodes.length; i++) {

            const embedCode = embedCodes[i];
            const extractedUrl = getAttributeValue(embedCode, "src");
            let actualUrl = null;

            // If the item is an embed-code, 
            if (extractedUrl) {
                actualUrl = extractedUrl;
            }
            else {
                // It might be already an actual url.
                actualUrl = embedCode;
            }

            photoUrls.push(actualUrl);
        }

        return photoUrls;
    }



    /** @override */
    regularCreate(ajaxRequestData = {}) {

        let itemName = $(this.view.childComponents.itemName.node).val();
        let itemQuantity = $(this.view.childComponents.itemQuantity.node).val();
        let itemPrice = $(this.view.childComponents.itemPrice.node).val();

        let itemDescription = $(this.view.childComponents.itemDescription.node).val();

        let itemLength = $(this.view.childComponents.itemLength.node).val();
        let itemWidth = $(this.view.childComponents.itemWidth.node).val();
        let itemHeight = $(this.view.childComponents.itemHeight.node).val();
        let itemWeight = $(this.view.childComponents.itemWeight.node).val();

        let itemEmbedCode = $(this.view.childComponents.itemEmbedCode.node).val();

        let itemTags = $(this.view.childComponents.itemTags.node).val();


        // Get the item's photo-urls.
        var photoUrls = this.extractPhotoUrls(itemEmbedCode);

        // if (!photoUrls) { return false; }

        //
        let ajaxRequestObj = {
            name: itemName,
            quantity: itemQuantity,
            price: itemPrice,
            description: itemDescription,
            length: itemLength,
            width: itemWidth,
            height: itemHeight,
            weight: itemWeight,
            photoUrls: photoUrls,
            tags: itemTags
        }


        ajaxRequestData = {
            ...ajaxRequestData,
            controllerObj: this,
            controllerClassName: "Item",
            modelClassName: "Item",
            isUsingRecipeFramework: true,
            requestMethod: AjaxRequestConstants.REQUEST_METHOD_POST,
            crudType: AjaxRequestConstants.CRUD_TYPE_CREATE,
            requestObj: ajaxRequestObj
        };


        return super.regularCreate(ajaxRequestData);
    }



    /** @implements */
    onItemCreate() {
        // this.videoDetailsFormController.dataSource.obj = this.videosTableController.dataSource.obj;
        this.create({ loaderMsg: "Creating..." });
    }



    /** @override */
    regularInit() {
        super.regularInit();
        this.view = new ItemDetailsForm();
    }


    /** @override */
    implementEventListeners() {
        super.implementEventListeners();

        ItemDetailsFormEventListeners.implement({
            eventNames: [
                "onItemCreate"
            ],
            eventSource: this.view,
            eventHandler: this
        });
    }

}