function readCategories() {
    var isOkToProceed = doPreReadCategories();

    if (!isOkToProceed) { return; }

    doRegularReadCategories();
    doPostReadCategories();
}


function doPostReadCategories() {
    
}


function doPreReadCategories() {

    //
    if (getIsCategoryReading() || (getNumOfFailedCategoryAjaxRead() >= 3)) { return false; }
    setIsCategoryReading(true);

    return true;
}


function doRegularReadCategories() {

    var crud_type = "read";
    var request_type = "GET";
    var earliestElDate = getLimitDateOfDomElement("earliest", "video-categories-plug-in-item");

    var idsOfAlreadyBeenReadCategories = getIdsOfAlreadyBeenReadCategories();
    var stringifiedIdsOfAlreadyBeenReadCategories = cnStringify(idsOfAlreadyBeenReadCategories);


    var key_value_pairs = {
        read: "yes",
        stringified_ids_of_already_been_read_categories: stringifiedIdsOfAlreadyBeenReadCategories,
        earliest_el_date: earliestElDate
    };


    var obj = new Category(crud_type, request_type, key_value_pairs);
    obj.read();

}


function getIdsOfAlreadyBeenReadCategories() {

    var ids = [];

    var alreadyBeenItems = $("#video-categories-plug-in").find(".video-categories-plug-in-item");

    for (i = 0; i < alreadyBeenItems.length; i++) {
        var currentId = $(alreadyBeenItems[i]).attr("category-id");

        ids[i] = currentId;

    }

    return ids;
}