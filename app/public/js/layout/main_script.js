function show_flash_notification(x_obj, json) {

    //
    //
    if (should_class_log(x_obj) && should_crud_type_log(x_obj)) {}
    else { return; }


    // TODO:REMINDER: Make the notification more presentable in production.
    if (json == null || !json.is_result_ok) {
        // FAIL on [crud]ing [x]Notification.
        // window.alert("FAIL on " + x_obj.crud_type + "ing " + x_obj.class_name);
        console.log("FAIL on " + x_obj.crud_type + "ing " + x_obj.class_name);
    }
    else {
        // SUCCESS on [crud]ing [x]Notification.
        // window.alert("SUCCESS on " + x_obj.crud_type + "ing " + x_obj.class_name);
        console.log("SUCCESS on " + x_obj.crud_type + "ing " + x_obj.class_name);
    }
}


/**
 * Get the subfolder of the appropriate xAjaxHandler.php.
 * @param class_name
 * @return {string}
 */
function get_subfolder(class_name) {
    //
    var subfolder = "";

    switch (class_name) {
        case "FriendshipSuggestion":
            subfolder = "friends";
            break;
        case "FriendshipAcolyte":
            subfolder = "friends";
            break;
        case "FriendshipMuse":
            subfolder = "friends";
            break;
        case "Friendship":
            subfolder = "friends";
            break;
        case "NotificationFriendship":
        // subfolder = "notifications";
        // break;
        case "NotificationMyShopping":
        // subfolder = "notifications";
        // break;
        case "NotificationPost":
        // subfolder = "notifications";
        // break;
        case "NotificationTimelinePostReply":
        // subfolder = "notifications";
        // break;
        case "NotificationRateableItem":
            subfolder = "notifications";
            break;
        case "User":
            subfolder = "admin_tools/user_management";
            break;
        case "Photo":
            subfolder = "my_photos";
            break;
        case "RateableItem":
            subfolder = "rateable_items";
            break;
        case "RateableItemUser":
            subfolder = "rateable_items_users";
            break;
        case "ChatList":
            subfolder = "chat_list";
            break;
        case "ChatMessage":
            subfolder = "chat_message";
            break;
        case "AppSetting":
            subfolder = "app_settings";
            break;
        case "TimelinePost":
            subfolder = "timeline_posts";
            break;
        case "TimelinePostSubscription":
            subfolder = "timeline_post_subscriptions";
            break;
        case "TimelinePostReply":
            subfolder = "timeline_post_replies";
            break;
        case "Invoice":
            subfolder = "invoices";
            break;
        case "InvoiceItem":
            subfolder = "invoice_items";
            break;
        case "StoreItem":
            subfolder = "store_items";
            break;
        case "StoreCart":
            subfolder = "store_carts";
            break;
        case "Session":
            subfolder = "session";
            break;
        case "CartItem":
            subfolder = "cart_items";
            break;
        case "Shipping":
            subfolder = "shipping";
            break;
        case "ShippingOption":
            subfolder = "shipping_options";
            break;
        case "PaypalSellerAccountAuthentication":
            subfolder = "paypal_payment";
            break;
        case "MyVideo":
            subfolder = "videos";
            break;
        case "Profile":
            subfolder = "profile2";
            break;

    }


    return subfolder;
}


function show_x_container(container) {
    container.style.display = "block";
}

function show_x_container2(class_name) {
    $("#" + class_name + "Container").css("display", "block");
}


function hide_x_container(container) {
    container.style.display = "none";
}

function hide_x_container2(class_name) {
    // container.style.display = "none";
    $("#" + class_name + "Container").css("display", "none");
}

function decide_ajax_pre_after_effects(xObj, json) {
    var className = xObj.class_name;
    var crudType = xObj.crud_type;


    //
    switch (className) {
        case "Invoice":
            do_invoice_pre_after_effects(className, crudType, json);
            break;
        case "StoreItem":
            do_store_item_pre_after_effects(className, crudType, json);
            break;
        case "CartItem":
            do_cart_item_pre_after_effects(className, crudType, json);
            break;
        case "Shipping":
            do_shipping_pre_after_effects(className, crudType, json);
            break;
        case "ShippingOption":
            do_shipping_option_pre_after_effects(className, crudType, json);
            break;
        case "PaypalSellerAccountAuthentication":
            do_paypal_payment_pre_after_effects(className, crudType, json);
            break;
        case "MyVideo":
            // do_shipping_option_pre_after_effects(className, crudType, json);
            do_my_video_pre_after_effects(className, crudType, json, xObj);
            break;
        case "Video":
            doVideoPreAfterEffects(className, crudType, json, xObj);
            break;
        case "TimelinePost":
            doTimelinePostPreAfterEffects(className, crudType, json, xObj);
            break;
        case "TimelinePostReply":
            doTimelinePostReplyPreAfterEffects(className, crudType, json, xObj);
            break;
        case "NotificationRateableItem":
            doNotificationRateableItemsPreAfterEffects(className, crudType, json, xObj);
            break;
        case "NotificationTimelinePostReply":
            doNotificationTimelinePostRepliesPreAfterEffects(className, crudType, json, xObj);
            break;
        case "Photo":
            doPhotoPreAfterEffects(className, crudType, json, xObj);
            break;
        case "MyPhoto":
            doMyPhotoPreAfterEffects(className, crudType, json, xObj);
            break;
        case "Profile":
            doProfilePreAfterEffects(className, crudType, json, xObj);
            break;
        case "UserSocialMediaAccount":
            doUserSocialMediaAccountPreAfterEffects(className, crudType, json, xObj);
            break;
        case "UserTopActivity":
            doUserTopActivityPreAfterEffects(className, crudType, json, xObj);
            break;
        case "Work":
            doWorkPreAfterEffects(className, crudType, json, xObj);
            break;
        case "Friendship":
            doFriendshipPreAfterEffects(className, crudType, json, xObj);
            break;
        case "Friend":
            doFriendPreAfterEffects(className, crudType, json, xObj);
            break;
        case "Playlist":
            doPlaylistPreAfterEffects(className, crudType, json, xObj);
            break;
        case "Comment":
            doCommentPreAfterEffects(className, crudType, json, xObj);
            break;
        case "VideoRecommendationItem":
            doVideoRecommendationItemPreAfterEffects(className, crudType, json, xObj);
            break;
        case "UserPlaylist":
            doUserPlaylistPreAfterEffects(className, crudType, json, xObj);
            break;
        case "Category":
            doCategoryPreAfterEffects(className, crudType, json, xObj);
            break;
    }
}


function decide_ajax_after_effects_class_handlers(xObj, json) {

    //
    if (!isCnAjaxResultOk(json)) { return; }

    //
    var className = xObj.class_name;
    var crudType = xObj.crud_type;

    //
    switch (className) {
        case "FriendshipSuggestion":
            do_friendship_suggestions_after_effects(className, crudType, json);
            break;
        case "FriendshipAcolyte":
            do_friendship_acolytes_after_effects(className, crudType, json);
            break;
        case "FriendshipMuse":
            do_friendship_muses_after_effects(className, crudType, json, xObj);
            break;
        case "NotificationFriendship":
            do_notification_friendships_after_effects(className, crudType, json, xObj);
            break;
        case "NotificationMyShopping":
            do_notification_my_shoppings_after_effects(className, crudType, json, xObj);
            break;
        case "NotificationPost":
            do_notification_posts_after_effects(className, crudType, json, xObj);
            break;
        case "NotificationRateableItem":
            doNotificationRateableItemsAfterEffects(className, crudType, json, xObj);
            break;
        case "NotificationTimelinePostReply":
            do_notification_timeline_post_replies_after_effects(className, crudType, json, xObj);
            break;
        case "User":
            do_users_after_effects(className, crudType, json, xObj);
            // window.alert("TODO:METHOD:do_notification_users_after_effects()");
            break;
        case "Photo":
            doPhotoAfterEffects(className, crudType, json, xObj);
            break;
        case "MyPhoto":
            doMyPhotoAfterEffects(className, crudType, json, xObj);
            break;
        case "RateableItem":
            do_rateable_item_after_effects(className, crudType, json, xObj);
            break;
        case "RateableItemUser":
            do_rateable_item_user_after_effects(className, crudType, json, xObj);
            break;
        case "ChatList":
            do_chat_list_after_effects(className, crudType, json, xObj);
            break;
        case "ChatMessage":
            do_chat_message_after_effects(className, crudType, json, xObj);
            break;
        case "AppSetting":
            do_app_setting_after_effects(className, crudType, json, xObj);
            break;
        case "TimelinePost":
            do_timeline_post_after_effects(className, crudType, json, xObj);
            break;
        case "TimelinePostSubscription":
            doTimelinePostSubscriptionAfterEffects(className, crudType, json, xObj);
            break;
        case "TimelinePostReply":
            do_timeline_post_reply_after_effects(className, crudType, json, xObj);
            break;
        case "Invoice":
            do_invoice_after_effects(className, crudType, json, xObj);
            break;
        case "InvoiceItem":
            do_invoice_item_after_effects(className, crudType, json, xObj);
            break;
        case "StoreItem":
            do_store_item_after_effects(className, crudType, json, xObj);
            break;
        case "StoreCart":
            do_store_cart_after_effects(className, crudType, json, xObj);
            break;
        case "Session":
            do_session_after_effects(className, crudType, json, xObj);
            break;
        case "CartItem":
            do_cart_item_after_effects(className, crudType, json, xObj);
            break;
        case "Shipping":
            do_shipping_after_effects(className, crudType, json, xObj);
            break;
        case "ShippingOption":
            do_shipping_option_after_effects(className, crudType, json, xObj);
            break;
        case "PaypalSellerAccountAuthentication":
            do_paypal_payment_after_effects(className, crudType, json, xObj);
            break;
        case "MyVideo":
            do_my_video_after_effects(className, crudType, json, xObj);
            break;
        case "Video":
            doVideoAfterEffects(className, crudType, json, xObj);
            break;
        case "Profile":
            doProfileAfterEffects(className, crudType, json, xObj);
            break;
        case "UserSocialMediaAccount":
            doUserSocialMediaAccountAfterEffects(className, crudType, json, xObj);
            break;
        case "UserTopActivity":
            doUserTopActivityAfterEffects(className, crudType, json, xObj);
            break;
        case "Work":
            doWorkAfterEffects(className, crudType, json, xObj);
            break;
        case "Friendship":
            doFriendshipAfterEffects(className, crudType, json, xObj);
            break;
        case "Friend":
            doFriendAfterEffects(className, crudType, json, xObj);
            break;
        case "Playlist":
            doPlaylistAfterEffects(className, crudType, json, xObj);
            break;
        case "Comment":
            doCommentAfterEffects(className, crudType, json, xObj);
            break;
        case "VideoRecommendationItem":
            doVideoRecommendationItemAfterEffects(className, crudType, json, xObj);
            break;
        case "UserPlaylist":
            doUserPlaylistAfterEffects(className, crudType, json, xObj);
            break;
        case "Category":
            doCategoryAfterEffects(className, crudType, json, xObj);
            break;
    }
}


function get_key_value_pairs(key_value_pairs, request_type) {
    var arranged_key_value_pairs = "";

    //
    if (request_type == "GET") {
        arranged_key_value_pairs += "?";
    }
    // Create a dynamic hidden csrf_token input.
    else if (request_type == "POST") {
        var input_csrf_token = get_csrf_input();

        // Dynamically append a hidden csrf input to the form "create_post_form".
        document.getElementById("the_body").appendChild(input_csrf_token);

        //
        arranged_key_value_pairs += "csrf_token=" + document.getElementById("input_csrf_token").value + "&";

        // Right away, remove the hidden csrf input from the form.
        document.getElementById("the_body").removeChild(input_csrf_token);
    }


    //
    for (var key in key_value_pairs) {
        arranged_key_value_pairs += key + "=" + key_value_pairs[key] + "&";
    }

    return arranged_key_value_pairs;
}

function get_key_value_pairs_for_ajax(caller_class_name, crud_type) {
    return "menu=" + caller_class_name + "&action=" + crud_type;
}


function my_ajax(x_obj) {
    var caller_class_name = x_obj.class_name;
    var crud_type = x_obj.crud_type;
    var request_type = x_obj.request_type;

    var key_value_pairs_arr = x_obj.key_value_pairs;
    var key_value_pairs_str = get_key_value_pairs(key_value_pairs_arr, request_type);
    key_value_pairs_str += get_key_value_pairs_for_ajax(caller_class_name, crud_type);


    //
    // var url = get_local_ajax_handler_url();
    var url = getLocalAjaxHandlerUrl();

    if (caller_class_name == "PaypalSellerAccountAuthentication") {
        // TODO: TODO:
        // url += get_local_ajax_handler_url() + caller_class_name + "AjaxHandler.php";
        // url += get_local_url() + "/public/__controller/" + get_subfolder(caller_class_name) + "/" + "PaypalPayment" + "AjaxHandler.php";
    }

    var xhr = new XMLHttpRequest();


    // Further set the url for "GET" request.
    if (request_type === "GET") {
        url += key_value_pairs_str;
    }


    //
    xhr.open(request_type, url, true);

    //
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {

            //
            var response = xhr.responseText.trim();

            // Log before JSON parsing.
            do_browser_ajax_pre_log(x_obj, response, url)

            //
            var json = tryParsingAjaxJson(response);


            //
            do_ajax_result_log(x_obj, json);

            /**/
            decide_ajax_pre_after_effects(x_obj, json);

            //
            decide_ajax_after_effects_class_handlers(x_obj, json);


            // Show a flash notification of the overall result.
            show_flash_notification(x_obj, json);


            // AJAX Formatted JSON log.
            do_browser_ajax_post_log(x_obj, json);

            // Show form errors.
            showFormErrors2(crud_type, caller_class_name, json);
        }
    };


    // Send.
    sendCnAjaxRequest(xhr, request_type, key_value_pairs_str);
}

function show_form_errors(key, val, json) {
    if (json.form_errors_showable) {
        var error_label = document.getElementById(key);
        if (error_label != null) {
            // Reset the error labels.
            error_label.innerHTML = "error";
            error_label.style.visibility = "hidden";


            // Display error labels.
            if (val != "") {
                error_label.innerHTML = val;
                error_label.style.visibility = "visible";
            }

        }
    }
}

function showFormErrors(json) {

    showFormErrors2(json);return;

    var errorFields = json.er;rors

    for (var key in json.errors) {
        if (json.errors.hasOwnProperty(key)) {
            var val = json.errors[key];

            // Display in the console.
            console.log(key + " => " + val);


            //
            var error_label = document.getElementById("error_" + key);

            // Reset the error messages first before displaying them.
            $(error_label).html("* no error");
            $(error_label).css("visibility", "hidden");


            if (error_label != null) {

                // Display error labels.
                if (val != "") {

                    for (var errorKey in val) {
                        if (val.hasOwnProperty(errorKey)) {
                            var errorMsg = val[errorKey];

                            cnLog(errorKey + " => " + errorMsg);

                            error_label.innerHTML = "* " + errorMsg;
                        }
                    }


                    error_label.style.visibility = "visible";
                }

            }
        }
    }
}

/**
 * Reset the error labels for every input in a specific form.
 * @param crud_type
 * @param caller_class_name
 * @return {boolean}
 */
function isFormResetSuccessful(crud_type, caller_class_name) {

    if (crud_type == "create" || crud_type == "update") {

        var formIdToBeReset = null;

        switch (caller_class_name) {
            case "MyPhoto":

                if (crud_type == "create") { formIdToBeReset = "my-photo-form"; }
                else if (crud_type == "update") { formIdToBeReset = "my-photo-update-form"; }
                break;
            default:
                return false;

        }

        // Reset the error messages first before displaying them.
        $("#" + formIdToBeReset).find(".error_msg").html("* no error");
        $("#" + formIdToBeReset).find(".error_msg").css("visibility", "hidden");

        return true;
    }
    else { return false; }
}

function showFormErrors2(crud_type, caller_class_name, json) {

    //
    if (!isFormResetSuccessful(crud_type, caller_class_name)) { return; }


    var errorFields = json.errors;


    // Loop through all the error fields.
    // Ex. [photo_title, href, src, ...]
    for (var errorField in errorFields) {

        if (errorFields.hasOwnProperty(errorField)) {

            var criteria = errorFields[errorField];
            showFormErrorCriteria(caller_class_name, errorField, criteria);
        }
    }
}

function showFormErrorCriteria(caller_class_name, errorField, criteria) {

    //
    var error_label = document.getElementById("error_" + errorField);

    // These are the exceptions.
    if (caller_class_name == "MyPhoto") {

        if (errorField == "href" ||
            errorField == "src" ||
            errorField == "width" ||
            errorField == "height") {

            error_label = document.getElementById("error_photo_embed_code");
        }
        else if (errorField == "my_photo_update_href" ||
            errorField == "my_photo_update_src" ||
            errorField == "my_photo_update_width" ||
            errorField == "my_photo_update_height") {

            error_label = document.getElementById("error_my_photo_update_embed_code");
        }
        
    }


    // Loop throught all the criteria of the current error field.
    // Ex. [min, max, csrf, ...]
    for (var errorCriterium in criteria) {

        if (criteria.hasOwnProperty(errorCriterium)) {

            var errorMsg = criteria[errorCriterium];
            cnLog(errorField + " => " + errorCriterium + ": " + errorMsg);

            $(error_label).html("* " + errorMsg);
            $(error_label).css("visibility", "visible");

        }

    }
}

function sendCnAjaxRequest(xhr, requestType, keyValuePairsInStrForm) {

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    if (requestType === "GET") {
        xhr.send();
    }
    else {
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(keyValuePairsInStrForm);
    }
}

function tryParsingAjaxJson(response) {

    var json = null;

    try {
        json = JSON.parse(response);
    } catch (e) {
        cnLog("**************************************");
        cnLog('ERROR: PARSING AJAX-JSON');
        cnLog("**************************************");
        cnLog("ERROR e: " + e);
        cnLog("**************************************");
        json = null;
    }

    return json;
}

function do_ajax_result_log(x_obj, json) {

    //
    if (should_class_log(x_obj) && should_crud_type_log(x_obj)) {}
    else { return; }


    //
    cnLog("#########################################");
    cnLog("########### Raw JSON Result #############");
    cnLog("#########################################");

    if (isCnAjaxResultOk(json)) {cnLog("json SUCCESS"); }
    else {
        cnLog("json FAIL");
        cnLog(json);
    }

    //
    cnLog("******** +++ --- ++++ *** --- *** ++++ *****");

}

function should_class_log(x_obj) {

    //
    switch (x_obj.class_name) {
        // case "Video":
        // case "UserPlaylist":
        // case "Category":
        // case "RateableItemUser":
        // case "RateableItem":
        // case "Comment":
        // case "VideoRecommendationItem":
        // case "Playlist":
        // case "Notification":
        case "NotificationRateableItem":
        // case "NotificationTimelinePostReply":
            return true;
            break;
    }

    //
    return false;
    // return true;
}


function should_crud_type_log(x_obj) {


    //
    switch (x_obj.crud_type) {
        case "fetch":
            // return true;
            return false;
            break;
        default:
            return true;
            break;
    }
}

function do_browser_ajax_pre_log(x_obj, response, url) {

    //
    if (should_class_log(x_obj) && should_crud_type_log(x_obj)) {}
    else { return; }



    //
    var caller_class_name = x_obj.class_name;
    var crud_type = x_obj.crud_type;
    var request_type = x_obj.request_type;
    var key_value_pairs_arr = x_obj.key_value_pairs;
    var key_value_pairs_str = get_key_value_pairs(key_value_pairs_arr, request_type);



    //
    cnLog("REQUEST TYPE: " + request_type);
    cnLog("crud_type: " + crud_type);
    cnLog("url: " + url);
    cnLog("key_value_pairs_str: " + key_value_pairs_str);
    cnLog("caller_class_name: " + caller_class_name);



    //
    cnLog("*******************************");
    cnLog("*** AJAX invoked by class: " + caller_class_name);
    cnLog("*** CRUD Type: " + crud_type);

    cnLog("*** Log before JSON parsing ***");
    cnLog("response: " + response);
}

function do_browser_ajax_post_log(x_obj, json) {

    //
    if (should_class_log(x_obj) && should_crud_type_log(x_obj)) {}
    else { return; }

    //
    var caller_class_name = x_obj.class_name;
    var crud_type = x_obj.crud_type;
    // var request_type = x_obj.request_type;
    // var key_value_pairs_arr = x_obj.key_value_pairs;
    // var key_value_pairs_str = get_key_value_pairs(key_value_pairs_arr, request_type);



    //
    console.log("*******************************");
    console.log("*** Formatted JSON in class: " + caller_class_name);
    console.log("*** CRUD Type: " + crud_type);


    for (var key in json) {
        if (json.hasOwnProperty(key)) {
            var val = json[key];

            // Display in the console.
            console.log(key + " => " + val);


            //
            // show_form_errors(key, val, json);
        }
    }
}

