import CnComponent2 from './CnComponent2.js';

export default class ItemXManagingSectionPseudoBtn extends CnComponent2 {

    /**
     * @override
     * @returns {*}
     */
    constructor(data = {}) {

        data = {
            iconName: "create", 
            itemName: "video",
            toolTipMsg: "",
            ...data
        }

        const myNode = CnComponent2.cnCloneTemplate({ id: "itemx-managing-section-pseudo-btn-template" });
        super({ node: myNode });

        this.href = getLocalUrl();

        this.setIcon(data.iconName);
        this.setItem(data.itemName);
        this.setToolTipMsg(data.toolTipMsg);
        this.setHref(data);
    }

    setHref(data = null) {

        if (data.href != null) { 
            this.setHrefHtmlAttrib(); 
            return;
        }

        this.setHrefPage(data.itemName);
        this.setHrefCrud(data.iconName);
        this.setHrefHtmlAttrib();
    }

    setHrefPage(itemName) {

        switch (itemName) {
            case "video":
                this.href += "video/";
                break;
            case "order":
                this.href += "order/";
                break;  
            case "item":
                this.href += "item/";
                break;               
    
        }
    }

    setHrefCrud(iconName) {

        switch (iconName) {
            case "create":
                this.href += "create/";
                break;
            case "update":
                this.href += "update/";
                break;                
    
        }


        // this.href += ".php";
    }


    setToolTipMsg(toolTipMsg) {

        $(this.node).attr("title", toolTipMsg);
    }


    setHrefHtmlAttrib() {
        $(this.node).attr("href", this.href);
    }

    setItem(itemName = "video") {

        var iconTag = $(this.node).find(".item-icon").children();

        switch (itemName) {
            case "video":
                $(iconTag).addClass("fa fa-file-video-o")
                break;
            case "playlist":
                $(iconTag).addClass("fa fa-list-alt")
                break;
            case "order":
                $(iconTag).addClass("fa fa-credit-card-alt")
                break;
            case "item":
                $(iconTag).addClass("fa fa-archive")
                break;
            case "analytics":
                $(iconTag).addClass("fa fa-area-chart")
                break;
                
            default:
                $(iconTag).addClass("fa fa-list-alt")
                break;
        }

    }

    setIcon(iconName = "create") {

        var iconTag = $(this.node).find(".crud-icon").children();

        if (iconName == "create") {
            $(iconTag).addClass("fa fa-plus")
        }
        else if (iconName == "delete") {
            $(iconTag).addClass("fa fa-minus")
        }
        else if (iconName == "update") {
            $(iconTag).addClass("fa fa-gear")
        }
    }
}