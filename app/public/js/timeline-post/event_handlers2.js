function tryShowActiveCnCol() {

    var screenWidth = $(this).width();

    if (screenWidth < 1200) {
        var activeToggleBtn = $(".col-toggle-btn.btn-success")[0];
        var toggleBtnId = $(activeToggleBtn).attr("id");
        activateCnCol(toggleBtnId);
    }
    else {
        $(".cn-col").css("display", "block");
    }


}