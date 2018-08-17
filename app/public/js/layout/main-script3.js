/**
 *
 * @param embed_code
 * @param attribute
 * @return {attribute value or bool false}
 */
function getAttributeValue(embed_code, attribute) {
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

    // Keep searching for the end-index.
    // If the attribute is not present. eg (hre, hef, ref, and not href).
    // First, searc for '?'.
    var end_index = embed_code.indexOf('?', start_index);

    // Second, search for '"'.
    if (end_index == -1) {
        end_index = embed_code.indexOf('"', start_index);
    }
    if (end_index == -1) { 
        return false; 
    }

    
    

    // var attribute_value_length = end_index - start_index;

    var attribute_value = embed_code.substring(start_index, end_index);

    return attribute_value;
}





/**
 * Loop through all the error fields (which is named
 * based on the db-model-field-name.)
 * For instance, with video-creation, errorFields
 * could be:
 * {
 *      "title": {
 *          "min": "has to be at least 1 character",
 *          "max": "has to be less than 128 characters"
 *      },
 *      "url": {
 *          "urlPrefix": "url is not valid.",
 *          "max": "url has to be less than 512 chars"
 *      },
 *      "owner_name": ...
 * }
 */
function showCnFormErrors(ajaxRequest, errorFields) {

    //
    let cnForm = ajaxRequest.controllerObj.view;
    resetCnFormErrorLabels(cnForm);


    for (var errorField in errorFields) {

        if (errorFields.hasOwnProperty(errorField)) {

            var errorCriteria = errorFields[errorField];
            var fieldErrorMsgs = getConcatenatedErrorMsgsForErrorField(errorField, errorCriteria);

            let errorLabelNode = cnForm.getFormErrorLabelNodeBasedOnModelFieldName(errorField);
            if (errorLabelNode != null) {
                $(errorLabelNode).html(fieldErrorMsgs);
            }

        }
    }
}



/**
 * Loop throught all the criteria of the current error field.
 * Ex. [min, max, csrf, ...]
 * @param {*} errorField 
 * @param {*} errorCriteria 
 */
function getConcatenatedErrorMsgsForErrorField(errorField, errorCriteria) {

    var concatenatedErrorMsgs = "";

    for (var errorCriterium in errorCriteria) {

        if (errorCriteria.hasOwnProperty(errorCriterium)) {

            var errorMsg = errorCriteria[errorCriterium];

            if (Array.isArray(errorMsg)) {
                for (let i = 0; i < errorMsg.length; i++) {
                    concatenatedErrorMsgs += "* " + errorMsg[i] + "<br>";
                }
            }
            else {
                concatenatedErrorMsgs += "* " + errorMsg + "<br>";
            }
            
        }

    }

    return concatenatedErrorMsgs;
}



function resetCnFormErrorLabels(cnForm) {
    $(cnForm.node).find(".cn-error-label").html("");
}