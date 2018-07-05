preInitPage();

initPage();

postInitPage();

function postInitPage() {
   postInitCenterCol();
}

function postInitCenterCol() {

    $("#cn-center-col").append($(videoManagingSection.node));
    $("#cn-center-col").append($(playlistManagingSection.node));
}

function initPage() {

    initPageProperties();
    initCnStickyBottom();
    initPageOptionsBtn();
    initCenterCol();
    initLeftCol();
    initRightCol();
}

function initRightCol() {
    setRightCol();
}

function setRightCol() {

    setRightColHeight();

    initPageOutlinePlugIn();

    var forPage = "video-manager@index";
    setPageOutlineItems(forPage);

    initVideoCategoriesPlugIn();

    readCategories();
}

function setRightColHeight() {

    $("#cn-right-col").height($(this).outerHeight());
}

function initLeftCol() {
    setLeftCol();
}


function setLeftCol() {
    setLeftColHeight();
    initUserVideoPlaylistsPlugIn();
    readVideoUserPlaylists();
}

function setLeftColHeight() {

    $("#cn-left-col").height($(this).outerHeight());
}

function initCenterCol() {

    /* */
    try {
        videoManagingSection = new ItemxManagingSectionTemplate();
        playlistManagingSection = new ItemxManagingSectionTemplate({itemName: "playlist"});

        videoManagingSectionPseudoAddBtn = new ItemxManagingSectionPseudoBtnTemplate();
        videoManagingSectionPseudoDeleteBtn = new ItemxManagingSectionPseudoBtnTemplate({iconName: "delete"});
        videoManagingSectionPseudoEditBtn = new ItemxManagingSectionPseudoBtnTemplate({iconName: "edit"});
        // videoManagingSectionPseudoBtn4 = new ItemxManagingSectionPseudoBtnTemplate();
        // videoManagingSectionPseudoBtn5 = new ItemxManagingSectionPseudoBtnTemplate();
        // videoManagingSectionPseudoBtn6 = new ItemxManagingSectionPseudoBtnTemplate();

        playlistManagingSectionPseudoAddBtn = new ItemxManagingSectionPseudoBtnTemplate({itemName: "playlist"});
        playlistManagingSectionPseudoEditBtn = new ItemxManagingSectionPseudoBtnTemplate({iconName: "edit", itemName: "playlist"});


        videoManagingSection.append(videoManagingSectionPseudoAddBtn);
        videoManagingSection.append(videoManagingSectionPseudoDeleteBtn);
        videoManagingSection.append(videoManagingSectionPseudoEditBtn);
        // videoManagingSection.append(videoManagingSectionPseudoBtn4);
        // videoManagingSection.append(videoManagingSectionPseudoBtn5);
        // videoManagingSection.append(videoManagingSectionPseudoBtn6);


        playlistManagingSection.append(playlistManagingSectionPseudoAddBtn);
        playlistManagingSection.append(playlistManagingSectionPseudoEditBtn);


        // show
        videoManagingSection.show();
        playlistManagingSection.show();


        videoManagingSectionPseudoAddBtn.show();
        videoManagingSectionPseudoDeleteBtn.show();
        videoManagingSectionPseudoEditBtn.show();
        // videoManagingSectionPseudoBtn4.show();
        // videoManagingSectionPseudoBtn5.show();
        // videoManagingSectionPseudoBtn6.show();

        playlistManagingSectionPseudoAddBtn.show();
        playlistManagingSectionPseudoEditBtn.show();

    }
    catch (error) {
        cnLog("#############################");
        cnLog("ERROR: " + error.message);
        cnLog("ERROR: in catch clause, method: initCenterCol().");
        cnLog("#############################");
    }
}

function initPageOptionsBtn() {
    
}

function initCnStickyBottom() {

    $("#center-col-toggle-btn").remove();

    $("#left-col-toggle-btn").trigger("click");
    $("#right-col-toggle-btn").trigger("click");

    $("#cn-left-col").css("display", "block");
    $("#cn-right-col").css("display", "block");
}

function initPageProperties() {
    setPageTitle("VideoManager | CuteNinjar");
}


function preInitPage() {

}