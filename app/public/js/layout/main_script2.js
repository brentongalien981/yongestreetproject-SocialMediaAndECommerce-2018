function my_sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function maximize_main_content() {
    $("#right").css("display", "none");
    // $("#main_content").css("width", "1000px");

    $("#middle_content").css("width", "1110px");
    $("#middle_content").css("min-width", "1110px");

    $("#main_content").css("width", "100%");
    $("#main_content").css("min-width", "100%");
}

function minimize_main_content() {
    $("#right").css("display", "initial");
    // $("#main_content").css("width", "1000px");

    $("#middle_content").css("width", "initial");
    $("#middle_content").css("min-width", "initial");

    $("#main_content").css("width", "initial");
    $("#main_content").css("min-width", "initial");
}

function mcnLogObject(obj) {

    /**/
    console.log("###########################");
    console.log("IN METHOD mcnLogObject()");

    /**/
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) {
            var val = obj[key];

            // Display in the console.
            console.log(key + " => " + val);
        }
    }

    console.log("###########################");
}

function getClonedLoaderEl(newLoaderId, loaderMsg) {

    var clonedLoader = $("#mcn-loader-el").clone();
    $(clonedLoader).attr("id", "loader-for-" + newLoaderId);
    $(clonedLoader).removeClass("mcn-loader-el-template");
    $(clonedLoader).addClass("mcn-loader-el");

    var clonedLoaderComment = $(clonedLoader).find(".mcn-loader-comment")[0];
    $(clonedLoaderComment).attr("id", "loader-comment-for-" + newLoaderId);
    $(clonedLoaderComment).html(loaderMsg);

    return clonedLoader;
}

function getAnonymousClonedLoaderEl(loaderMsg) {

    var clonedLoader = $("#mcn-loader-el").clone();
    $(clonedLoader).removeAttr("id");
    $(clonedLoader).removeClass("mcn-loader-el-template");
    $(clonedLoader).addClass("mcn-loader-el");

    var clonedLoaderComment = $(clonedLoader).find(".mcn-loader-comment")[0];
    $(clonedLoaderComment).removeAttr("id");
    $(clonedLoaderComment).html(loaderMsg);

    return clonedLoader;
}

function appendClonedLoaderEl(containerEl, loaderEl) {
    $(containerEl).append($(loaderEl));
    $(loaderEl).css("display", "inherit");
}

function removeClonedLoaderEl(loaderEl) {
    $(loaderEl).remove();
}

function setLoaderEl(containerId, loadingComment) {

    //
    $("#" + containerId).append($("#mcn-loader-el"));
    $("#mcn-loader-el").find("#loading-comment").html(loadingComment);
    $("#mcn-loader-el").css("display", "block");
}

function unsetLoaderEl() {

    //
    $("#mcn-loader-el").css("display", "none");
}

function roundToTwo(num) {
    return +(Math.round(num + "e+2")  + "e-2");
}

function hide_element(el) {
    $(el).css("display", "none");
}

function show_element(el, display) {
    $(el).css("display", display);
}

function b_remove_animation(el, a) {
    el.classList.remove(a);
}

function b_add_animation(el, a) {
    el.classList.add(a);


}


function get_date_of_latest_el(class_name, order) {

    var els = $("." + class_name);
    var length = els.length;

    var latest_el = null;
    if (order == "ASC") { latest_el = els[length - 1]; }
    else { latest_el = els[0]; }

    var latest_date = $(latest_el).attr("created-at");

    if (latest_el == null ||
        latest_date == null ||
        latest_date == "") {

        return "2010-09-11 10:54:45";
    }
    else {
        return latest_date;
    }
}

function get_default_pic_url() {
    return "https://farm5.staticflickr.com/4505/37111709784_57d987a8bf_m.jpg";
}


function setPageTitle(title) {
    $("#title").html(title);
}

/**
 * @note This assumes that the way you displayed the elements with
 *       classname @elClassName in descending order (latest first).
 * @param limitType
 * @param elClassName
 * @return {string}
 */
function getLimitDateOfDomElement(limitType, elClassName) {

    var limitDate = "2010-09-11 10:54:45";
    var length = $("." + elClassName).length;


    if (length == 0) {
        if (limitType == "earliest") {
            limitDate = "0000-00-00 00:00:00";
        }

        return limitDate;
    }



    if (limitType == "earliest") {
        var earliestEl = $("." + elClassName)[length - 1];
        limitDate = $(earliestEl).attr("created-at");
    }
    else {
        var latestEl = $("." + elClassName)[0];
        limitDate = $(latestEl).attr("created-at");
    }

    return limitDate;
}

/**
 *
 * @param limitType
 * @param elClassName
 * @param order
 * @param node
 * @return {string}
 */
function getLimitDateOfDomElementWithinNode(limitType, elClassName, order, node) {

    var limitDate = "2010-09-11 10:54:45";
    var elementsOfInterest = $(node).find("." + elClassName);
    var length = elementsOfInterest.length;


    if (length == 0) {
        if (limitType == "earliest") {
            limitDate = "0000-00-00 00:00:00";
        }

        return limitDate;
    }



    if (limitType == "earliest") {

        var earliestEl = null;

        if (order == "DESC") {

            earliestEl = elementsOfInterest[length - 1];
            limitDate = $(earliestEl).attr("created-at");

        }
        else {

            earliestEl = elementsOfInterest[0];
            limitDate = $(earliestEl).attr("created-at");

        }

    }
    else {

        var latestEl = null;

        if (order == "DESC") {

            latestEl = elementsOfInterest[0];
            limitDate = $(latestEl).attr("created-at");

        }
        else {

            latestEl = elementsOfInterest[length - 1];
            limitDate = $(latestEl).attr("created-at");

        }
    }


    //
    return limitDate;
}

function cnLog(msg) {
    console.log(msg);
}

function isCnAjaxResultOk(json) {

    if (json === null || !json.is_result_ok) { return false; }
    else if (json.is_result_ok) { return true; }
    else { return false; }
}

/**
 * @credt stackoverflow.com
 * Returns a random integer between min (inclusive) and max (inclusive)
 * Using Math.round() will give you a non-uniform distribution!
 */
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function cnCloneTemplate(id) {
    var template = $(id).clone(true);
    $(template).removeClass("cn-template");
    $(template).removeAttr("id");

    $(template).addClass("contact-detail-item");
    return template;
}

function cnCloneTemplateEl(templateElId) {
    var template = $("#" + templateElId).clone(true);
    $(template).removeClass("cn-template");
    $(template).removeAttr("id");

    return template;
}

/**
 *
 * @param element
 * @returns {{top: number, left: number}}
 */
function cnGetAbsolutePosition(element) {
    var top = 0, left = 0;
    do {
        top += element.offsetTop  || 0;
        left += element.offsetLeft || 0;
        element = element.offsetParent;
    } while(element);

    return {
        top: top,
        left: left
    };
}


function cnStringify(items) {

    var stringifiedItems = "";

    for (i = 0; i < items.length; i++) {
        stringifiedItems += items[i] + ",";
    }

    // Remove the last comma if possible.
    if (stringifiedItems.length > 0) {
        stringifiedItems = stringifiedItems.substring(0, stringifiedItems.length - 1);
    }

    return stringifiedItems;
}

function cnGetBreakPointName() {

    var windowWidth = $(window).width();

    var lgBreakPointMin = 1200;
    var lgBreakPointMax = 1439;

    var mdBreakPointMin = 992;
    var mdBreakPointMax = 1199;

    var smBreakPointMin = 768;
    var smBreakPointMax = 991;

    var xsBreakPointMin = 480;
    var xsBreakPointMax = 767;

    if (windowWidth <= xsBreakPointMax) { return "xs"; }
    else if (windowWidth > xsBreakPointMax && windowWidth <= smBreakPointMax) { return "sm"; }
    else if (windowWidth > smBreakPointMax && windowWidth <= mdBreakPointMax) { return "md"; }
    else if (windowWidth > mdBreakPointMax && windowWidth <= lgBreakPointMax) { return "lg"; }
    else { return "xl"; }
}