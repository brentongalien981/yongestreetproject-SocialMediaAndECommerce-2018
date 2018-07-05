$('.rate-option').click(function () {

    //
    var rateStatusContainer = $(this).closest(".rate-status-container");
    var rateableItemId = $(rateStatusContainer).attr("rateable-item-id");
    var rateValue = $(this).attr("rate-value");

    //
    var pseudoRateableItemUserObj = {rateable_item_id: rateableItemId, rate_value: rateValue};
    var arrayOfObjs = [pseudoRateableItemUserObj];

    //
    setTwoCentsItem(arrayOfObjs);

    updateRateableItemUser(rateableItemId, rateValue);
});