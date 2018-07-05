function doCategoryPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            //
            setIsCategoryReading(false);

            //
            if (!isCnAjaxResultOk(json)) {
                setNumOfFailedCategoryAjaxRead(parseInt(getNumOfFailedCategoryAjaxRead()) + 1);
            }

            break;

        case "show":
            break;
        case "create":
        case "update":
        case "delete":
        case "fetch":

            break;
        case "patch":
            break;
    }
}


function doCategoryAfterEffects(className, crudType, json, xObj) {

    switch (crudType) {
        case "read":
            displayCategory(json, crudType);
            break;
        case "show":
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


function displayCategory(json, crudType) {

    doPreDisplayCategory();
    doRegularDisplayCategory(json);
    doPostDisplayCategory();
}


function doPreDisplayCategory() {
    
}

function doPostDisplayCategory() {
    
}


function doRegularDisplayCategory(json) {

    var arrayOfCategoryObjs = json.objs;


    for (i = 0; i < arrayOfCategoryObjs.length; i++) {

        // 1) Reference the ith obj.
        var currentObj = arrayOfCategoryObjs[i];


        // 2) Cn-clone the #video-categories-plug-in-item-template.
        var categyItem = cnCloneTemplate("#video-categories-plug-in-item-template");
        $(categyItem).attr("category-id", currentObj.id);


        // 3) Add class: video-categories-plug-in-item to the the cloned template.
        $(categyItem).addClass("video-categories-plug-in-item");


        // 4) Fill-in the cloned template with details from the ith obj.
        $(categyItem).html(currentObj.name);
        $(categyItem).attr("title", currentObj.name);
        $(categyItem).attr("created-at", currentObj.created_at);

        var categoryHref = get_local_url() + "video-categories/show.php?id=" + currentObj.id;
        $(categyItem).attr("href", categoryHref);

        // 5) Append.
        $("#video-categories-plug-in").find(".actual-contents-section").append($(categyItem));
    }
}