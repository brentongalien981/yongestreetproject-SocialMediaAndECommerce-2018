import ThreeColumnedPage from "./ThreeColumnedPage.js";
import CnPart from "./CnPart.js";
import CnComponent3 from "./CnComponent3.js";

export default class MyStorePage extends ThreeColumnedPage {


    /** @override */
    initPageProperties() {
        super.initPageProperties({
            title: "MyStore | ysp"
        });
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

        const storeManagerPlugIn = new CnComponent3({ nodeSelector: "#store-manager-plug-in" });

        this.parts.cnLeftCol.append(storeManagerPlugIn);
    }
}