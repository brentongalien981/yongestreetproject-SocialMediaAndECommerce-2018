// import CnPart from './CnPart.js';
import CnPage from './CnPage.js';
import ItemXManagingSection from './ItemXManagingSection.js';
import CnPart from './CnPart.js';
import ItemXManagingSectionPseudoBtn from './ItemXManagingSectionPseudoBtn.js';


export default class StoreManagerPage extends CnPage {


    /** @override */
    initPageProperties() {
        super.initPageProperties({
            title: "Store Manager | ysp"
        });
    }


    /** @overrid */
    initParts() {
        super.initParts();

        const storeManagerComponent = new CnPart({ nodeSelector: "#store-manager-component" });

        this.parts = { 
            ...this.parts,
            storeManagerComponent: storeManagerComponent 
        };

    }


    /** @override */
    initChildComponents() {
        super.initChildComponents();

        // sections
        let salesPendingsStatusManagingSection = new ItemXManagingSection({
            sectionTitle: "Sales Pending Status"
        });


        // buttons
        let updateOrdersBtn = new ItemXManagingSectionPseudoBtn({
            itemName: "order",
            iconName: "update"
        });



        //
        salesPendingsStatusManagingSection.append(updateOrdersBtn);



        // Unhide.
        salesPendingsStatusManagingSection.show();
        updateOrdersBtn.show();

        

        //
        this.childComponents = {
            ...this.childComponents,
            salesPendingsStatusManagingSection: salesPendingsStatusManagingSection
        };

        this.parts.storeManagerComponent.append(salesPendingsStatusManagingSection);


    }


    /** @override */
    postInit() {
        super.postInit();

        // this.childComponents.updateVideoPageMainContent.appendTo(this.parts.cnCenterCol);
    
    }
}