function doUserTopActivityPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            // Unset loader el.
            var loaderEl = $("#loader-for-user-top-activity-xxx");
            removeClonedLoaderEl(loaderEl);


            //
            if (!isCnAjaxResultOk(json)) {
                displayDefaultUserTopActivities();
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

function doUserTopActivityAfterEffects(className, crudType, json, xObj) {
    switch (crudType) {
        case "read":

            displayUserTopActivities(json);

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

function displayUserTopActivities(json) {

    var userTopActivities = json.objs;
    var numOfUserTopActivities = userTopActivities.length;

    //
    if (numOfUserTopActivities == 0) {
        displayDefaultUserTopActivities();
        return;
    }


    //
    for (i = 0; i < numOfUserTopActivities; i++) {
        var userTopActivity = userTopActivities[i];

        //
        var userTopActivityHolder = $("#user-top-activity-photo-holder-template").clone(true);
        $(userTopActivityHolder).removeAttr("id");
        $(userTopActivityHolder).removeClass("cn-template");
        $(userTopActivityHolder).addClass("user-top-activity-photo-holder-templates");

        // Add margin to the holder.
        if (i > 0) {
            $(userTopActivityHolder).css("margin-left", getUserTopActivityContainerGapWidth() + "px");
        }

        var userTopActivityPhoto = $(userTopActivityHolder).find("img");
        $(userTopActivityPhoto).attr("src", userTopActivity["photo_link"]);

        $("#user-top-activities-container-slot").append($(userTopActivityHolder));


        //
        enableDragAndCropFeature(userTopActivityPhoto, userTopActivity["x_offset"]);
    }


    //
    setUserTopActivityPhotoHolderTemplateWidth(numOfUserTopActivities);
    setUserTopActivityPhotoHolderTemplateHeight();
}

function displayDefaultUserTopActivities() {

    var numOfUserTopActivities = 7;

    //
    for (i = 0; i < numOfUserTopActivities; i++) {

        //
        var userTopActivityHolder = $("#user-top-activity-photo-holder-template").clone(true);
        $(userTopActivityHolder).removeAttr("id");
        $(userTopActivityHolder).removeClass("cn-template");
        $(userTopActivityHolder).addClass("user-top-activity-photo-holder-templates");

        // Add margin to the holder.
        if (i > 0) {
            $(userTopActivityHolder).css("margin-left", getUserTopActivityContainerGapWidth() + "px");
        }

        var userTopActivityPhoto = $(userTopActivityHolder).find("img");

        // TODO
        var defaultPhotoLink = "https://farm5.staticflickr.com/4678/38426678350_5c4891997f_o.jpg";
        $(userTopActivityPhoto).attr("src", defaultPhotoLink);

        $("#user-top-activities-container-slot").append($(userTopActivityHolder));


        //
        var xOffset = 0.56;
        enableDragAndCropFeature(userTopActivityPhoto, xOffset);
    }


    //
    setUserTopActivityPhotoHolderTemplateWidth(numOfUserTopActivities);
    setUserTopActivityPhotoHolderTemplateHeight();
}

function enableDragAndCropFeature(userTopActivityPhoto, xOffset) {

    $(userTopActivityPhoto).dragncrop({
        overflow: true,
        overlay: true,
        position: {offset: [xOffset, 0]} // position image on the right
    });
}