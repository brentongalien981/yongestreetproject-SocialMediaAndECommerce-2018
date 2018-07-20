function get_csrf_input() {
    var input_csrf_token = document.createElement("input");
    input_csrf_token.id = "input_csrf_token";
    input_csrf_token.setAttribute("type", "hidden");
    input_csrf_token.setAttribute("value", get_csrf_token());

    return input_csrf_token;
}

function getCsrfInput() {
    return get_csrf_input();
}

function getCsrfToken() {
    return get_csrf_token();
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




function extractValueFromRecipeFrameworkUrl(url, paramKey) {

    // Get the index of token "public" from url ".../public/video/create/8/abcd".
    var tokenPublicIndex = url.indexOf("public");

    // Get the substring "/video/create/8/abc" from the url.
    var workableUrl = url.substr(tokenPublicIndex + 7);


    // Remove the leading and trailing "/".
    var leadingChar = workableUrl.substr(0, 1);

    if (leadingChar == "/") {
        workableUrl = workableUrl.substr(1);
    }

    var trailingChar = workableUrl.substr(workableUrl.length - 1);

    if (trailingChar == "/") {
        workableUrl = workableUrl.substr(0, workableUrl.length - 1);
    }



    // Tokenize from the workableUrl.
    var urlTokens = workableUrl.split("/", 10)



    // Return the wanted-extracted-value based on the paramKey.
    // Ex. paramKey = id is the third token.
    var paramKeyIndex = false;

    switch (paramKey) {
        case "domain":
            paramKeyIndex = 0;
            break;
        case "action":
            paramKeyIndex = 1;
            break;
        case "id":
            paramKeyIndex = 2;
            break;
        default:
            paramKeyIndex = "extra-info";
            break;
    }

    if (paramKeyIndex == "extra-info") {
        // If for ex. the urlTokens include "playlistId" from
        /**
         * urlTokens = [
         *      "video",
         *      "show",
         *      "8",
         *      "playlistId"
         *      "3"
         * ], then set paramKeyIndex to index of "playlistId" + 1.
         */
        if (urlTokens.includes(paramKey)) {
            paramKeyIndex = urlTokens.indexOf(paramKey) + 1;
        } else {
            paramKeyIndex = false;
        }
    }


    if (paramKeyIndex != false && paramKeyIndex < urlTokens.length) {
        return urlTokens[paramKeyIndex];
    } else {
        return null;
    }
}

