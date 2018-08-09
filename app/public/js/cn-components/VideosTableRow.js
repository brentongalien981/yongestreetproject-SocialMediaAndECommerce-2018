import CnComponent2 from './CnComponent2.js';
// import CnComponent from './CnComponent.js';

class VideosTableRow extends CnComponent2 {

    constructor() {

        const myNode = cnCloneTemplate("#videos-table #video-record-row-template");
        super({ node: myNode });

    }


    /** @override */
    regularSetView(data = {}) {

        if (data.obj == null) { return; }

        const video = data.obj;
        this.controller.dataSource.obj = video;
        

        $(this.node).attr("obj-id", video.id);
        $(this.node).find(".video-record-id").html(video.id);
        $(this.node).find(".video-record-title").html(video.title);
        $(this.node).find(".video-record-owner").html(video.owner_name);
        $(this.node).find(".video-record-created-at").html(video.created_at_human_date + " (" + video.created_at + ")");
        $(this.node).find(".video-record-updated-at").html(video.updated_at_human_date);

    }
}

export { VideosTableRow as default }