$(document).ready(function(){

    addMouseOverListenerToRateOptionsPopUpTriggerElements();
    addMouseOutListenerToRateOptionsPopUpTriggerElements();
    // addMouseOverListenerToRateOptionsPopUp();
    // addMouseOutListenerToRateOptionsPopUp();

    // addClickListenerToRateOptions();
});

function setIdentityOfRateStatusContainer(rateStatusContainer, rateableItemId) {

    // Set the id of the rate-status-container based on the
    // [item's] rateable-item-id.

    var rateStatusContainerId = "rate-status-container" + rateableItemId;
    $(rateStatusContainer).attr("id", rateStatusContainerId);

    // Also set the rate-status-container's attribute "rateable-item-id".
    $(rateStatusContainer).attr("rateable-item-id", rateableItemId);
}