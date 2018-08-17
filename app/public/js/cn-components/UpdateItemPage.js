import ThreeColumnedPage from "./ThreeColumnedPage.js";
import CnPart from "./CnPart.js";
import CnComponent2 from "./CnComponent2.js";

export default class UpdateItemPage extends ThreeColumnedPage {


    /** @override */
    initPageProperties() {
        super.initPageProperties({
            title: "Update Store Item | ysp"
        });
    }


    /** @override */
    initParts() {
        super.initParts();

        const updateItemComponent = new CnPart({ nodeSelector: "#update-item-component" });

        this.parts = {
            ...this.parts,
            updateItemComponent: updateItemComponent
        };


        //
        updateItemComponent.appendTo(this.parts.cnCenterCol);
    }


    /** @override */
    initCnStickyBottom() {
        $("#left-col-toggle-btn").attr("is-activated", "no");
        $("#left-col-toggle-btn").removeClass("btn-success");
        $("#left-col-toggle-btn").addClass("btn-secondary");
    }


    /** @override */
    initChildComponents() {
        super.initChildComponents();

        const storeManagerPlugIn = new CnComponent2({ nodeSelector: "#store-manager-plug-in" });

        this.parts.cnLeftCol.append(storeManagerPlugIn);
    }
}