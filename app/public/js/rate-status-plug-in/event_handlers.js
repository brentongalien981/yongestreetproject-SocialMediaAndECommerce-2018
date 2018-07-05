function addMouseOverListenerToRateOptionsPopUpTriggerElements() {

    $(".rate-options-pop-up-trigger-elelements").mouseover(function (event) {
        event.stopPropagation();

        clearTimeout(rateOptionsPopUpMouseoutHandler);
        $("#rate-options-pop-up").css("display", "none");


        //
        var triggerElement = this;
        attachPopUpToReference(triggerElement);


        //
        $("#rate-options-pop-up").css("display", "block");

    });
}

/**
 * If the hovered element is the #two-cents-status-item-container itself,
 * then just append the #rate-options-pop-up directly.
 * Else, if it's not, traverse up back the DOM until I find
 * the #two-cents-status-item-container. Then append #rate-options-pop-up.
 * @param triggerElement
 */
function attachPopUpToReference(triggerElement) {

    if ($(triggerElement).attr("id") == "two-cents-status-item-container") {

        $("#rate-options-pop-up").insertAfter($(triggerElement));
    }
    else {

        var twoCentsStatusItemContainer = $(triggerElement).closest(".rate-status-item-container");
        $("#rate-options-pop-up").insertAfter($(twoCentsStatusItemContainer));
    }

}

function addMouseOutListenerToRateOptionsPopUpTriggerElements() {

    $(".rate-options-pop-up-trigger-elelements").mouseout(function (event) {
        event.stopPropagation();

        //
        mouseoutHandler = setTimeout(function () {
            $("#rate-options-pop-up").css("display", "none");
        }, 1000);

        //
        setRateOptionsPopUpMouseoutHandler(mouseoutHandler);

    });
}