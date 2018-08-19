import CnComponent3 from './CnComponent3.js';
// import CnComponent from './CnComponent.js';
import VideosTableRowController from '../js-controllers/VideosTableRowController.js';
import VideosTableRowEventListeners from '../cn-event-listeners/VideosTableRowEventListeners.js';

class VideosTable extends CnComponent3 {

    constructor() {
        super({ nodeSelector: "#videos-table" });

    }


    /**
     * @override
     */
    initChildComponents() {
        super.initChildComponents();

        // const publishBtn = new CnComponent3({ nodeSelector: "#video-details-form #publish-video-btn" });

        const headerTitle = new CnComponent3({ nodeSelector: "#videos-table .header-title" });
        const videosTableBody = new CnComponent3({ nodeSelector: "#videos-table tbody" });
        const videoRecordRowTemplate = new CnComponent3({ nodeSelector: "#videos-table #video-record-row-template" });
        const refForLoadingMoreObjs = new CnComponent3({ nodeSelector: "#videos-table .reference-for-loading-more-objs" });

        this.childComponents = {
            ...this.childComponents,
            headerTitle: headerTitle,
            videosTableBody: videosTableBody,
            videoRecordRowTemplate: videoRecordRowTemplate,
            refForLoadingMoreObjs: refForLoadingMoreObjs,
            videosTableRows: []
        };
    }


    /** @override */
    regularSetView(data = { dataSource: null, json: null }) {

        let videos = data.dataSource.newlyAddedObjs;

        for (let i = 0; i < videos.length; i++) {

            let video = videos[i];

            let videosTableRowController = new VideosTableRowController();
            videosTableRowController.view.nodeId = videosTableRowController.view.constructor.name + video.id;
            videosTableRowController.view.regularSetView({ obj: video });

            this.childComponents.videosTableBody.append(videosTableRowController.view);
            this.childComponents.videosTableRows.push(videosTableRowController.view);

            VideosTableRowEventListeners.implement({
                eventNames: [
                    "onVideosTableRowClick",
                    "onVideosTableRowDelete"
                ],
                eventSource: videosTableRowController,
                eventHandler: this.controller
            });

        }
    }
}

export { VideosTable as default }
