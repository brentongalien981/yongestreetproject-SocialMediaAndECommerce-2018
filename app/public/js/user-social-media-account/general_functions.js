function doUserSocialMediaAccountPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            // Unset loader el.
            var loaderEl = $("#loader-for-profile-social-media-xxx");
            removeClonedLoaderEl(loaderEl);

            // readUserSocialMediaAccount();

            break;

        case "create":
        case "update":
        case "delete":
        case "fetch":
        case "patch":
            break;
    }
}

function doUserSocialMediaAccountAfterEffects(className, crudType, json, xObj) {
    switch (crudType) {
        case "read":

            displayUserSocialMediaAccounts(json);

            break;
        case "create":
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            break;
        case "patch":
            break;
    }
}


function displayUserSocialMediaAccounts(json) {

    var socialMediaAccounts = json.objs;

    //
    for (i = 0; i < socialMediaAccounts.length; i++) {
        var socialMediaAccount = socialMediaAccounts[i];

        var socialMediaUserName = socialMediaAccount["social_media_username"];
        var socialMediaCompanyName = socialMediaAccount["social_media_company_name"];

        //
        var contactDetailItem = cnCloneTemplate("#contact-detail-template");
        $(contactDetailItem).addClass("contact-detail-item-social-meida");

        var socialMediaLogoName = getSocialMediaLogoName(socialMediaAccount);

        $(contactDetailItem).find(".contact-detail-icon").addClass("fa fa-" + socialMediaLogoName);

        $(contactDetailItem).find(".contact-detail-label").html("@" + socialMediaUserName);

        $("#profile-social-media-section").append($(contactDetailItem));


        //

        addClickListenerToSocialMediaItem(contactDetailItem, socialMediaCompanyName, socialMediaUserName);
    }

}


function getSocialMediaLogoName(socialMediaAccount) {

    var socialMediaLogoName = socialMediaAccount["social_media_company_name"];

    switch (socialMediaAccount["social_media_company_name"]) {
        case "facebook":
            socialMediaLogoName = "facebook-square";
            break;
    }

    return socialMediaLogoName;
}