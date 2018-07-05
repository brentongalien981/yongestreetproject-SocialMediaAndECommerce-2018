function hasScreenChangedBreakPoint() {

    var currentScreenWidth = $("#the_body").width();
    var currentPhotoContainerWidth = getPhotoContainerWidth();
    var photoWidthPercentage = 0.6;

    var supposedPhotoContainerWidth = currentScreenWidth * photoWidthPercentage;

    if (getBreakPointName(currentPhotoContainerWidth, photoWidthPercentage) != getBreakPointName(supposedPhotoContainerWidth, photoWidthPercentage)) {
        cnLog("change from " + getBreakPointName(currentPhotoContainerWidth, photoWidthPercentage) + " to " + getBreakPointName(supposedPhotoContainerWidth, photoWidthPercentage));
        return true;
    }

    return false;

    // If the photoContainerWidth

}

function getBreakPointName(photoContainerWidth, widthMultiplier) {
    var lgBreakPointMin = 1200 * widthMultiplier;
    var lgBreakPointMax = 1439 * widthMultiplier;

    var mdBreakPointMin = 992 * widthMultiplier;
    var mdBreakPointMax = 1199 * widthMultiplier;

    var smBreakPointMin = 768 * widthMultiplier;
    var smBreakPointMax = 991 * widthMultiplier;

    var xsBreakPointMin = 480 * widthMultiplier;
    var xsBreakPointMax = 767 * widthMultiplier;

    if (photoContainerWidth <= xsBreakPointMax) { return "xs"; }
    else if (photoContainerWidth > xsBreakPointMax && photoContainerWidth <= smBreakPointMax) { return "sm"; }
    else if (photoContainerWidth > smBreakPointMax && photoContainerWidth <= mdBreakPointMax) { return "md"; }
    else if (photoContainerWidth > mdBreakPointMax && photoContainerWidth <= lgBreakPointMax) { return "lg"; }
    else { return "xl"; }
}