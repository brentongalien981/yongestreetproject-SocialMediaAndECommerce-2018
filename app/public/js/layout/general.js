function get_csrf_input() {
    var input_csrf_token = document.createElement("input");
    input_csrf_token.id = "input_csrf_token";
    input_csrf_token.setAttribute("type", "hidden");
    input_csrf_token.setAttribute("value", get_csrf_token());
    
    return input_csrf_token;
}

function getUrlParamValue(url, paramKey) {
    var start_index = url.indexOf(paramKey);

    // If the attribute is not present. eg (hre, hef, ref, and not href).
    if (start_index == -1) { return false; }

    /*
     * For ex:
     *      $start_offset = "id" + "=";
     *                    = 4 + 1
     *                    = 5
     */
    start_index += paramKey.length + 1;

    var end_index = url.indexOf('&', start_index);

    // If the url doesn't separate vars with "&", then try the end index as
    // the length of the entire url.
    if (end_index == -1) {
        end_index = url.indexOf('#', start_index);
    }

    //
    if (end_index == -1) {
        end_index = url.length;
    }

    // If the attribute is not really present. eg (hre, hef, ref, and not href), or
    // the url is hacked, just return false.
    if (end_index == -1) { return false; }

    // var attribute_value_length = end_index - start_index;

    var attribute_value = url.substring(start_index, end_index);

    return attribute_value;
}

/**
 *
 * @param url
 * @param paramKey
 * @returns string value of paramKey OR bool false
 */
function extractValueFromUrl(url, paramKey) {

    // Make sure that the start_index is from an actual paramKey
    // and not an accidental one.
    // ie, if the url is ".../validation.php?id=7", the start_index should
    // be the one based on "id=7" and not val [id] ation...
    var start_index = url.indexOf("?" + paramKey);

    if (start_index == -1) {
        start_index = url.indexOf("&" + paramKey);
    }

    // If the attribute is not present. eg (hre, hef, ref, and not href).
    if (start_index == -1) { return false; }

    /*
     * For ex:
     *      $start_offset = "?id" + "="; OR "&id" + "="
     *                    = 1 + 4 + 1
     *                    = 6
     */
    start_index += paramKey.length + 2;

    var end_index = url.indexOf('&', start_index);

    // If the url doesn't separate vars with "&", then try the end index as
    // the length of the entire url.
    if (end_index == -1) {
        end_index = url.indexOf('#', start_index);
    }

    //
    if (end_index == -1) {
        end_index = url.length;
    }

    // If the attribute is not really present. eg (hre, hef, ref, and not href), or
    // the url is hacked, just return false.
    if (end_index == -1) { return false; }

    // var attribute_value_length = end_index - start_index;

    var attribute_value = url.substring(start_index, end_index);

    return attribute_value;
}


