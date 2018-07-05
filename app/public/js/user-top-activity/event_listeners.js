$(window).resize(function () {

    var numOfUserTopActivities = $(".user-top-activity-photo-holder-templates").length;
    setUserTopActivityPhotoHolderTemplateWidth(numOfUserTopActivities);
    setUserTopActivityPhotoHolderTemplateHeight();

    cnLog("oh yeah");
    cnLog("numOfUserTopActivities: " + numOfUserTopActivities);
});