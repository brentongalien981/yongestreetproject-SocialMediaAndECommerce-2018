class ItemxManagingSectionPseudoBtnTemplate extends CnTemplate {

    /**
     * @override
     * @returns {*}
     */
    constructor(data = {iconName: "add", itemName: "video"}) {

        var selector = "#itemx-managing-section-pseudo-btn-template";
        super(selector);

        this.href = get_local_url();

        this.setIcon(data.iconName);
        this.setItem(data.itemName);
        this.setHref(data);
    }

    setHref(data = null) {

        if ((data == null)) {
            this.href = "https://www.nba.com";
            return;
        }

        this.setHrefPage(data.itemName);
        this.setHrefCrud(data.iconName);
        this.setHrefHtmlAttrib();
    }

    setHrefPage(itemName) {

        if (itemName == "video") {
            this.href += "video/";
        }
        else if (itemName == "playlist") {
            this.href += "video-playlist/";
        }
    }

    setHrefCrud(iconName) {

        if (iconName == "add") {
            this.href += "create";
        }
        else if (iconName == "edit") {
            this.href += "update";
        }


        this.href += ".php";
    }

    setHrefHtmlAttrib() {
        $(this.node).attr("href", this.href);
    }

    setItem(itemName = "video") {

        var iconTag = $(this.node).find(".item-icon").children();

        if (itemName == "video") {
            $(iconTag).addClass("fa fa-file-video-o")
        }
        else if (itemName == "playlist") {
            $(iconTag).addClass("fa fa-list-alt")
        }
    }

    setIcon(iconName = "add") {

        var iconTag = $(this.node).find(".crud-icon").children();

        if (iconName == "add") {
            $(iconTag).addClass("fa fa-plus")
        }
        else if (iconName == "delete") {
            $(iconTag).addClass("fa fa-minus")
        }
        else if (iconName == "edit") {
            $(iconTag).addClass("fa fa-gear")
        }
    }
}