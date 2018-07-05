function readUserTwoCentsOfRateableItem(rateableItemId) {

    var crud_type = "read";
    var request_type = "GET";


    var key_value_pairs = {
        read: "yes",
        rateable_item_id: rateableItemId,
        what_to_read: "rate_tags"
    };


    var obj = new RateableItemUser(crud_type, request_type, key_value_pairs);
    obj.read();
}

function readRatingSigmaOfRateableItem(rateableItemId) {

    var crud_type = "read";
    var request_type = "GET";


    var key_value_pairs = {
        read: "yes",
        rateable_item_id: rateableItemId,
        what_to_read: "rate_sigma"
    };


    var obj = new RateableItemUser(crud_type, request_type, key_value_pairs);
    obj.read();
}

function readAverageRatingOfRateableItem(rateableItemId) {

    var crud_type = "read";
    var request_type = "GET";


    var key_value_pairs = {
        read: "yes",
        rateable_item_id: rateableItemId,
        what_to_read: "rate_value_sigma"
    };


    var obj = new RateableItemUser(crud_type, request_type, key_value_pairs);
    obj.read();
}

function setTwoCentsItem(objs) {

    if (objs == null || objs == false) { return; }

    var rateableItemUser = objs[0];


    var rateableItemId = rateableItemUser["rateable_item_id"];
    var rateValue = rateableItemUser["rate_value"];

    //
    var rateStatusContainerId = "rate-status-container" + rateableItemId;
    var rateStatusContainer = $("#" + rateStatusContainerId);


    // Reference the two-cents-item.
    var twoCentsItem = $(rateStatusContainer).find("#two-cents-status-item-container");


    // Reference the <img> of the two-cents-item.
    var twoCentsItemImg = $(twoCentsItem).find("img");


    // Set the <img> of the two-cents-item.
    var rateImgSrc = get_local_url() + getRateImgSrcSuffix(rateValue);
    $(twoCentsItemImg).attr("src", rateImgSrc);
}

function getRateImgSrcSuffix(rateValue) {

    var imgSrcSuffix = null;

    switch (rateValue) {
        case "-5":
            
            imgSrcSuffix = "img/rate-icons/CryingMJ.png";
            break;
        case "-4":
            
            imgSrcSuffix = "img/rate-icons/Bomb.png";
            break;
        case "-3":
            
            imgSrcSuffix = "img/rate-icons/Shit.png";
            break;
        case "-2":
            
            imgSrcSuffix = "img/rate-icons/Nuts.png";
            break;
        case "-1":
            
            imgSrcSuffix = "img/rate-icons/Sucks.png";
            break;
        case "0":
            
            imgSrcSuffix = "img/rate-icons/SosoFace.png";
            break;
        case "1":
            
            imgSrcSuffix = "img/rate-icons/Swaggy.png";
            break;
        case "2":
            
            imgSrcSuffix = "img/rate-icons/Cookin.png";
            break;
        case "3":
            //
            
            imgSrcSuffix = "img/rate-icons/Ballin.png";
            break;
        case "4":
            
            imgSrcSuffix = "img/rate-icons/NDZone.png";
            break;
        case "5":
            
            imgSrcSuffix = "img/rate-icons/MJGoat.png";
            break;
    }

    return imgSrcSuffix;
}

function getElementByAttribute(attributeName, attributeValue) {

    var element = $("[" + attributeName + "='" + attributeValue + "']");
    return element;
}


function setAverageRating(objs) {

    if (objs == null || objs == false) { return; }

    var rateableItemUser = objs[0];


    var rateableItemId = rateableItemUser["rateable_item_id"];
    var ratingSigma = rateableItemUser["count"];
    var accumulatedSumOfRatings = rateableItemUser["rate_value_sum"];

    //
    var rateStatusContainerId = "rate-status-container" + rateableItemId;
    var rateStatusContainer = $("#" + rateStatusContainerId);


    // Reference the sum-status-item.
    var averageRatingItem = $(rateStatusContainer).find("#average-status-item-container");


    // Reference the item-img-element of the averageRatingItem.
    var averageRatingImgEl = $(averageRatingItem).find("img");


    /* Set the value of the itemValueEl. */
    var averageRating = parseFloat(accumulatedSumOfRatings) / parseFloat(ratingSigma);
    averageRating = roundToTwo(averageRating);

    // Get the cn-rounded rating to have a value for getting
    // the rating-icon-img.
    var cnRoundedAverageRating = getCnRoundedRating(averageRating);


    // Get the icon-img-src.
    var rateImgSrc = get_local_url() + getRateImgSrcSuffix(cnRoundedAverageRating.toString());


    // Set the icon-img of the item.
    $(averageRatingImgEl).attr("src", rateImgSrc);


    // Set the tooltip of the average-rating-item.
    $(averageRatingImgEl).attr("alt", "Average rating: " + averageRating + ".");
    $(averageRatingItem).attr("title", "Average rating: " + averageRating + ".");
}

function getCnRoundedRating(avg) {

    var pseudo_button_msg = "";
    var cnRoundedRating = null;

    if (avg < -4.5) {
        cnRoundedRating = -5;
        pseudo_button_msg += "MEME";
    }
    else if (avg < -3.5 && avg >= -4.5) {
        cnRoundedRating = -4;
        pseudo_button_msg += "BOMB";
    }
    else if (avg < -2.5 && avg >= -3.5) {
        cnRoundedRating = -3;
        pseudo_button_msg += "BUGGY";
    }
    else if (avg < -1.5 && avg >= -2.5) {
        cnRoundedRating = -2;
        pseudo_button_msg += "NUTS";
    }
    else if (avg < -0.5 && avg >= -1.5) {
        cnRoundedRating = -1;
        pseudo_button_msg += "SUCKS";
    }
    else if (avg < 0.5 && avg >= -0.5) {
        cnRoundedRating = 0;
        pseudo_button_msg += "POKERFACE";
    }
    else if (avg < 1.5 && avg >= 0.5) {
        cnRoundedRating = 1;
        pseudo_button_msg += "SWAGGY";
    }
    else if (avg < 2.5 && avg >= 1.5) {
        cnRoundedRating = 2;
        pseudo_button_msg += "COOKIN";
    }
    else if (avg < 3.5 && avg >= 2.5) {
        cnRoundedRating = 3;
        pseudo_button_msg += "BALLIN";
    }
    else if (avg < 4.5 && avg >= 3.5) {
        cnRoundedRating = 4;
        pseudo_button_msg += "nDzone";
    }
    else if (avg <= 5 && avg >= 4.5) {
        cnRoundedRating = 5;
        pseudo_button_msg += "GOAT";
    }

    return cnRoundedRating;
}

function setRatingSigma(objs) {

    if (objs == null || objs == false) { return; }

    var rateableItemUser = objs[0];


    var rateableItemId = rateableItemUser["rateable_item_id"];
    var ratingSigma = rateableItemUser["count"];

    //
    var rateStatusContainerId = "rate-status-container" + rateableItemId;
    var rateStatusContainer = $("#" + rateStatusContainerId);


    // Reference the sum-status-item.
    var ratingsSigmaItem = $(rateStatusContainer).find("#sum-status-item-container");


    // Reference the item-value-element of the ratingsSigmaItem.
    var itemValueEl = $(ratingsSigmaItem).find(".rate-status-item-value");


    // Set the value of the itemValueEl.
    $(itemValueEl).html(ratingSigma);
}