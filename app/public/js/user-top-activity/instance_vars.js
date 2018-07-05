var userTopActivityContainerGapWidth = 7;

function getUserTopActivityContainerGapWidth() {
    return userTopActivityContainerGapWidth;
}

function setUserTopActivityPhotoHolderTemplateWidth(numOfUserTopActivities) {

    // my_sleep(3);
    // $("#user-top-activities-container").css("width", "100%");
    $('#user-top-activities-container').width($(this).width());

    //
    var containerSlotWidth = $('#user-top-activities-container').width();
    $('#user-top-activities-container-slot').width(containerSlotWidth);

    //
    var gapWidth = getUserTopActivityContainerGapWidth();
    var photoHolderWidth = (containerSlotWidth - ((gapWidth) * (numOfUserTopActivities - 1) ) ) / numOfUserTopActivities;
    $(".user-top-activity-photo-holder-templates").width(photoHolderWidth);
}

function setUserTopActivityPhotoHolderTemplateHeight() {

    var appHeight = $(this).height();

    $('#user-top-activities-container').height(appHeight * 0.70);

    $(".user-top-activity-photo-holder-templates").height(appHeight * 0.70);
}