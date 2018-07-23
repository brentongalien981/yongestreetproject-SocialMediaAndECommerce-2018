import ThreeColumnedPage from './ThreeColumnedPage.js';
import CnPart from './CnPart.js';


class UpdateVideoPage extends ThreeColumnedPage {


    /** @override */
    initPageProperties() {
        super.initPageProperties({
            title: "Update Videos | ysp"
        });
    }


    /** @override */
    initParts() {
        super.initParts();

        const updateVideoPageMainContent = new CnPart({ nodeSelector: "#update-video-page-main" });

        this.parts = { 
            ...this.parts,
            updateVideoPageMainContent: updateVideoPageMainContent 
        };
    }


    /** @override */
    postInit() {
        super.postInit();

        this.childComponents.updateVideoPageMainContent.appendTo(this.parts.cnCenterCol);
        
    }
}


export { UpdateVideoPage as default }