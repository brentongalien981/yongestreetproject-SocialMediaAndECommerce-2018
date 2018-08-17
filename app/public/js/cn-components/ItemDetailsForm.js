import CnForm from './CnForm.js';
import CnComponent3 from './CnComponent3.js';

export default class ItemDetailsForm extends CnForm {

    constructor() {
        super({ nodeSelector: "#item-details-form" });
    }


    /** @override */
    getFormErrorLabelNodeBasedOnModelFieldName(fieldName = "") {

        switch (fieldName) {
            case "name":
                return $("#cn-error-label-item-name");
            case "quantity":
                return $("#cn-error-label-item-quantity");
            case "price":
                return $("#cn-error-label-item-price");
            case "description":
                return $("#cn-error-label-item-description");

            case "length":
                return $("#cn-error-label-item-length");
            case "width":
                return $("#cn-error-label-item-width");
            case "height":
                return $("#cn-error-label-item-height");
            case "weight":
                return $("#cn-error-label-item-weight");
            case "photoUrls":
                return $("#cn-error-label-item-photo-urls");
            case "tags":
                return $("#cn-error-label-item-tags");
            default:
                return null;
        }
    }



    /** @override */
    initChildComponents() {
        super.initChildComponents();

        const publishBtn = new CnComponent3({ nodeSelector: "#item-details-form #publish-item-btn" });
        const updateBtn = new CnComponent3({ nodeSelector: "#item-details-form #update-item-btn" });

        const formHeaderLabel = new CnComponent3({ nodeSelector: "#item-details-form .header-label" });
        const itemName = new CnComponent3({ nodeSelector: "#item-details-form #item-name" });

        const itemQuantity = new CnComponent3({ nodeSelector: "#item-details-form #item-quantity" });
        const itemPrice = new CnComponent3({ nodeSelector: "#item-details-form #item-price" });
        const itemDescription = new CnComponent3({ nodeSelector: "#item-details-form #item-description" });
        const itemLength = new CnComponent3({ nodeSelector: "#item-details-form #item-length" });
        const itemWidth = new CnComponent3({ nodeSelector: "#item-details-form #item-width" });
        const itemHeight = new CnComponent3({ nodeSelector: "#item-details-form #item-height" });
        const itemWeight = new CnComponent3({ nodeSelector: "#item-details-form #item-weight" });
        const itemEmbedCode = new CnComponent3({ nodeSelector: "#item-details-form #item-photo-urls" });
        const itemTags = new CnComponent3({ nodeSelector: "#item-details-form #item-tags" });


        this.childComponents = {
            ...this.childComponents,
            publishBtn: publishBtn,
            updateBtn: updateBtn,
            formHeaderLabel: formHeaderLabel,
            itemName: itemName,
            itemQuantity: itemQuantity,
            itemPrice: itemPrice,
            itemDescription: itemDescription,
            itemLength: itemLength,
            itemWidth: itemWidth,
            itemHeight: itemHeight,
            itemWeight: itemWeight,
            itemEmbedCode: itemEmbedCode,
            itemTags: itemTags
        };
    }

}