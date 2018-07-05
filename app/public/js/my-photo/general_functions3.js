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

/**
 *
 * @param embed_code
 * @param attribute
 * @return {attribute value or bool false}
 */
function get_attribute_value(embed_code, attribute) {
    var start_index = embed_code.indexOf(attribute);

    // If the attribute is not present. eg (hre, hef, ref, and not href).
    if (start_index == -1) { return false; }

    /*
     * For ex:
     *      $start_offset = "href" + "=\"";
     *                    = 4 + 2
     *                    = 6
     */
    start_index += attribute.length + 2;

    var end_index = embed_code.indexOf('"', start_index);

    // If the attribute is not present. eg (hre, hef, ref, and not href).
    if (end_index == -1) { return false; }

    // var attribute_value_length = end_index - start_index;

    var attribute_value = embed_code.substring(start_index, end_index);

    return attribute_value;
}