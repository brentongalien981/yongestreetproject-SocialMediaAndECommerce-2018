function resetColToggleBtns() {
    $(".col-toggle-btn").removeClass("btn-success");

    $(".col-toggle-btn").addClass("btn-primary");
}

function activateColToggleBtn(toggleBtnId) {
    $("#" + toggleBtnId).removeClass("btn-primary");

    $("#" + toggleBtnId).addClass("btn-success");
}

function toggleBtn(toggleBtnId) {

    var isBtnActivated = $("#" + toggleBtnId).attr("is-activated");

    if (isBtnActivated == "yes") {
        $("#" + toggleBtnId).attr("is-activated", "no");
        $("#" + toggleBtnId).removeClass("btn-success");
        $("#" + toggleBtnId).addClass("btn-secondary");
    }
    else {
        $("#" + toggleBtnId).attr("is-activated", "yes");
        $("#" + toggleBtnId).removeClass("btn-secondary");
        $("#" + toggleBtnId).addClass("btn-success");
    }

}

function activateCnCol(toggleBtnId) {

    // $(".cn-col").css("display", "none");


    var activeCnColId = null;

    switch (toggleBtnId) {
        case 'left-col-toggle-btn':
            activeCnColId = "cn-left-col";
            break;
        case 'center-col-toggle-btn':
            activeCnColId = "cn-center-col";
            break;
        case 'right-col-toggle-btn':
            activeCnColId = "cn-right-col";
            break;
    }


    showCnCol(activeCnColId);
}

function toggleCnCol(toggleBtnId) {

    var activeCnColId = null;


    //
    var isBtnActivated = $("#" + toggleBtnId).attr("is-activated");

    if (isBtnActivated == "no") {

        // Hide
        switch (toggleBtnId) {
            case 'left-col-toggle-btn':
                activeCnColId = "cn-left-col";

                $("#" + activeCnColId).removeClass("fadeInLeft");
                $("#" + activeCnColId).addClass("fadeOutLeft");

                // $("#" + activeCnColId).css("display", "none");

                break;
            case 'center-col-toggle-btn':
                activeCnColId = "cn-center-col";
                break;
            case 'right-col-toggle-btn':
                activeCnColId = "cn-right-col";

                $("#" + activeCnColId).removeClass("fadeInRight");
                $("#" + activeCnColId).addClass("fadeOutRight");

                // $("#" + activeCnColId).css("display", "none");
                break;
        }
    }
    else {

        // Show
        switch (toggleBtnId) {
            case 'left-col-toggle-btn':
                activeCnColId = "cn-left-col";

                // $("#" + activeCnColId).css("display", "block");
                $("#" + activeCnColId).removeClass("fadeOutLeft");
                $("#" + activeCnColId).addClass("fadeInLeft");

                break;
            case 'center-col-toggle-btn':
                activeCnColId = "cn-center-col";
                break;
            case 'right-col-toggle-btn':
                activeCnColId = "cn-right-col";

                // $("#" + activeCnColId).css("display", "block");
                $("#" + activeCnColId).removeClass("fadeOutRight");
                $("#" + activeCnColId).addClass("fadeInRight");
                break;
        }
    }
}

function showCnCol(activeCnColId) {
    console.log("activeCnColId: " + activeCnColId);
    $("#" + activeCnColId).css("display", "block");
    // $("#" + activeCnColId).addClass("fadeInLeft");
}