function initPageProperties() {
    setPageTitle("Add Video | CuteNinjar");
}

class CreateVideoPage extends CnPage {

    constructor(selector = null) {

        super(selector);

        preInitPage();

        initPage();

        postInitPage();
    }

    postInitPage() {

    }

    initPage() {
        initPageProperties();
        initPagePlugIns();
        initPageForms();
        initPageComponents();
        initPageParts();
    }

    initPagePlugIns() {

    }

    initPageParts() {
        initLeftCol();
        initRightCol();
    }

    initRightCol() {
        setRightColHeight();
    }

    initLeftCol() {
        setLeftColHeight();
    }

    setRightCol() {

    }

    setRightColHeight() {

        $("#cn-right-col").height($(window).outerHeight());
    }

    setLeftCol() {

    }

    setLeftColHeight() {

        $("#cn-left-col").height($(window).outerHeight());
    }

    preInitPage() {

    }
}