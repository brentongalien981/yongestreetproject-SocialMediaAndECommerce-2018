import CnComponent2 from './CnComponent2.js';
import CnComponent from './CnComponent.js';

class VideosTable extends CnComponent2 {

    constructor() {
        super({ nodeSelector: "#videos-table" });
        
    }



    /**
     * @override
     */
    initChildComponents() {
        super.initChildComponents();

        // const publishBtn = new CnComponent({ nodeSelector: "#video-details-form #publish-video-btn" });

        const headerTitle = new CnComponent({ nodeSelector: "#videos-table .header-title" });
        const videosTableBody = new CnComponent({ nodeSelector: "#videos-table tbody" });
        const videoRecordRowTemplate = new CnComponent({ nodeSelector: "#videos-table #video-record-row-template" });

        this.childComponents = { 
            ...this.childComponents,
            headerTitle: headerTitle,
            videosTableBody: videosTableBody,
            videoRecordRowTemplate: videoRecordRowTemplate
        };
    }
}

export { VideosTable as default}