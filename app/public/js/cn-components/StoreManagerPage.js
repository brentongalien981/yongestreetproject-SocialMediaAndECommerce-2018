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
        let salesPendingsStatusManagingSection = new ItemXManagingSection({ sectionTitle: "Sales Pending Status" });
        let inventoryManagingSection = new ItemXManagingSection({ sectionTitle: "Inventory" });
        let storeReportManagingSection = new ItemXManagingSection({ sectionTitle: "Store Reports / Analytics" });


        // buttons
        let updateOrdersBtn = new ItemXManagingSectionPseudoBtn({
            itemName: "order",
            iconName: "update",
            toolTipMsg: "Update the status of your sold items."
        });
        
        let addStoreItemBtn = new ItemXManagingSectionPseudoBtn({
            itemName: "item",
            iconName: "create",
            toolTipMsg: "Add a new store item."
        });

        let updateStoreItemsBtn = new ItemXManagingSectionPseudoBtn({
            itemName: "item",
            iconName: "update",
            toolTipMsg: "Edit your store items."
        });

        let storeAnalyticsBtn = new ItemXManagingSectionPseudoBtn({
            itemName: "analytics",
            iconName: "update",
            toolTipMsg: "View store reports and analytics.",
            href: "#"
        });



        // Append the btns to the sections.
        salesPendingsStatusManagingSection.append(updateOrdersBtn);

        inventoryManagingSection.append(addStoreItemBtn);
        inventoryManagingSection.append(updateStoreItemsBtn);

        storeReportManagingSection.append(storeAnalyticsBtn);



        // Unhide the sections and the btns.
        salesPendingsStatusManagingSection.show();
        inventoryManagingSection.show();
        storeReportManagingSection.show();
        updateOrdersBtn.show();
        addStoreItemBtn.show();
        updateStoreItemsBtn.show();
        storeAnalyticsBtn.show();



        //
        this.childComponents = {
            ...this.childComponents,
            salesPendingsStatusManagingSection: salesPendingsStatusManagingSection,
            inventoryManagingSection: inventoryManagingSection,
            storeReportManagingSection: storeReportManagingSection
        };


        // Append the sections to main-content.
        this.parts.storeManagerComponent.append(salesPendingsStatusManagingSection);
        this.parts.storeManagerComponent.append(inventoryManagingSection);
        this.parts.storeManagerComponent.append(storeReportManagingSection);


    }


    /** @override */
    postInit() {
        super.postInit();

        // this.childComponents.updateVideoPageMainContent.appendTo(this.parts.cnCenterCol);

    }
}