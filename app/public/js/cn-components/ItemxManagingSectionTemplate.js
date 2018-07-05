class ItemxManagingSectionTemplate extends CnTemplate {

    /**
     * @override
     * @returns {*}
     */
    constructor(data = {itemName: "video"}) {

        var selector = "#itemx-managing-section-template";
        super(selector);

        //
        this.setDefaultAttribs(data);

        //
        this.setTitle(data.itemName);
        this.setNodeId(data.itemName);
    }

    setNodeId(itemName) {

        var nodeId = null

        switch (itemName) {
            case "video":
                nodeId = "video-managing-section";
                break;
            case "playlist":
                nodeId = "playlist-managing-section";
                break;
        }

        //
        $(this.node).attr("id", nodeId);
    }

    setTitle(itemName) {

        var actualTitle = this.title;

        switch (itemName) {
            case "video":
                break;
            case "playlist":
                actualTitle = "Manage Playlists";
                break;
        }


        $(this.node).find(".itemx-managing-section-title").html(actualTitle);
    }

    setDefaultAttribs(data) {
        this.title = "Manage Videos";
    }
}