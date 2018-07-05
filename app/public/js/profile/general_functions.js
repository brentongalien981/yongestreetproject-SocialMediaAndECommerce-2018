function doProfilePreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            var sectionToDoPreAfterEffectsWith = xObj.key_value_pairs.for_section;

            if (sectionToDoPreAfterEffectsWith == "summary") {

                // Unset loader el.
                var loaderEl = $("#loader-for-profile-summary-xxx");
                removeClonedLoaderEl(loaderEl);

            }
            else if (sectionToDoPreAfterEffectsWith == "contactInformation") {

                // Unset loader el.
                var loaderEl = $("#loader-for-profile-contact-info-xxx");
                removeClonedLoaderEl(loaderEl);

                readUserSocialMediaAccount();

            }

            break;

        case "create":
        case "update":
        case "delete":
        case "fetch":
        case "patch":
            break;
    }
}

function doProfileAfterEffects(className, crudType, json, xObj) {
    switch (crudType) {
        case "read":

            var sectionToDoAfterEffectsWith = xObj.key_value_pairs.for_section;

            if (sectionToDoAfterEffectsWith == "summary") {
                displayProfileSummary(json);
            }
            else if (sectionToDoAfterEffectsWith == "contactInformation") {
                displayContactInformation(json);

                hideSideColumns();
            }

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

function displayProfileSummary(json) {

    var profiles = json.objs;

    //
    for (i = 0; i < profiles.length; i++) {
        var profile = profiles[i];

        // profile-summary (profile-description)
        if (profile["description"] == null ||
            profile["description"] == "") {
            profile["description"] = "Add your profile description..";
        }
        $("#profile-summary").html(profile["description"]);
    }
}

function hideSideColumns() {

    setTimeout(function () {

        $("#left-col-toggle-btn").trigger("click");
        $("#right-col-toggle-btn").trigger("click");
    }, 100); // TODO: Change the animation time in method hideSideColumns().
}