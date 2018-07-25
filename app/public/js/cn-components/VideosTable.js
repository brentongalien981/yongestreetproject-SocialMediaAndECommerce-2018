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
        const refForLoadingMoreObjs = new CnComponent({ nodeSelector: "#videos-table .reference-for-loading-more-objs" });

        this.childComponents = { 
            ...this.childComponents,
            headerTitle: headerTitle,
            videosTableBody: videosTableBody,
            videoRecordRowTemplate: videoRecordRowTemplate,
            refForLoadingMoreObjs: refForLoadingMoreObjs
        };
    }


    /** @override */
    regularSetView(data = { dataSource: null, json: null }) {

        let videos = data.dataSource.newlyAddedObjs;

        for (let i = 0; i < videos.length; i++) {

            let video = videos[i];

            const videoRecordRowEl = cnCloneTemplate("#videos-table #video-record-row-template");

            $(videoRecordRowEl).attr("obj-id", video.id);
            // $(videoRecordRowEl).find(".video-record-id").html(video.id);
            $(videoRecordRowEl).find(".video-record-title").html(video.title);
            $(videoRecordRowEl).find(".video-record-owner").html(video.owner_name);
            $(videoRecordRowEl).find(".video-record-created-at").html(video.created_at_human_date + " (" + video.created_at + ")");
            $(videoRecordRowEl).find(".video-record-updated-at").html(video.updated_at_human_date);

            $("#videos-table tbody").append($(videoRecordRowEl));
        }
    }
}

export { VideosTable as default}