import ThreeColumnedPage from "./ThreeColumnedPage.js";
import CnPart from "./CnPart.js";
import CnComponent2 from "./CnComponent2.js";

export default class CreateItemPage extends ThreeColumnedPage {


    /** @override */
    initPageProperties() {
        super.initPageProperties({
            title: "Create Store Item | ysp"
        });
    }


    /** @override */
    initParts() {
        super.initParts();

        const createItemComponent = new CnPart({ nodeSelector: "#create-item-component" });

        this.parts = {
            ...this.parts,
            createItemComponent: createItemComponent
        };


        //
        createItemComponent.appendTo(this.parts.cnCenterCol);
    }


    /** @override */
    initCnStickyBottom() {
        // $("#left-col-toggle-btn").trigger("click");
        // $("#cn-left-col").css("display", "none");
    
        setTimeout(() => {
            // $("#cn-left-col").css("display", "block");
            
        }, 500);

        $("#left-col-toggle-btn").attr("is-activated", "no");
        $("#left-col-toggle-btn").removeClass("btn-success");
        $("#left-col-toggle-btn").addClass("btn-secondary");

        // $("#cn-left-col").css("display", "block");

    }


    /** @override */
    initChildComponents() {
        super.initChildComponents();

        const storeManagerPlugIn = new CnComponent2({ nodeSelector: "#store-manager-plug-in" });

        this.parts.cnLeftCol.append(storeManagerPlugIn);
    }
}