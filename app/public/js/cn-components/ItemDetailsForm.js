import CnForm from './CnForm.js';
import CnComponent2 from './CnComponent2.js';

export default class ItemDetailsForm extends CnForm {

    constructor() {
        super({ nodeSelector: "#item-details-form" });
    }



    /** @override */
    initChildComponents() {
        super.initChildComponents();

        const publishBtn = new CnComponent2({ nodeSelector: "#item-details-form #publish-item-btn" });
        const updateBtn = new CnComponent2({ nodeSelector: "#item-details-form #update-item-btn" });

        const formHeaderLabel = new CnComponent2({ nodeSelector: "#item-details-form .header-label" });
        const itemName = new CnComponent2({ nodeSelector: "#item-details-form #item-name" });

        const itemQuantity = new CnComponent2({ nodeSelector: "#item-details-form #item-quantity" });
        const itemPrice = new CnComponent2({ nodeSelector: "#item-details-form #item-price" });
        const itemDescription = new CnComponent2({ nodeSelector: "#item-details-form #item-description" });
        const itemLength = new CnComponent2({ nodeSelector: "#item-details-form #item-length" });
        const itemWidth = new CnComponent2({ nodeSelector: "#item-details-form #item-width" });
        const itemHeight = new CnComponent2({ nodeSelector: "#item-details-form #item-height" });
        const itemWeight = new CnComponent2({ nodeSelector: "#item-details-form #item-weight" });
        const itemEmbedCode = new CnComponent2({ nodeSelector: "#item-details-form #item-photo-urls" });
        const itemTags = new CnComponent2({ nodeSelector: "#item-details-form #item-tags" });


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