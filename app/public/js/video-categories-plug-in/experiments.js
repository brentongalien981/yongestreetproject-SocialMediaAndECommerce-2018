function CN_EXP_getArrayOfCategoryObjs() {

    var objs = [
        {
            id: 1,
            name: "Sports"
        },
        {
            id: 2,
            name: "Music"
        },
        {
            id: 3,
            name: "Music Covers"
        },
        {
            id: 4,
            name: "Basketball"
        },
    ];


    //
    for (i = 5; i < 55; i++) {

        objs.push({id: i, name: "category" + i});
    }

    return objs;
}


function CN_EXP_doRegularDisplayCategory(arrayOfCategoryObjs) {

    for (i = 0; i < arrayOfCategoryObjs.length; i++) {

        // 1) Reference the ith obj.
        var currentObj = arrayOfCategoryObjs[i];

        // 2) Cn-clone the #video-categories-plug-in-item-template.
        var categyItem = cnCloneTemplate("#video-categories-plug-in-item-template");

        // 3) Add class: video-categories-plug-in-item to the the cloned template.
        $(categyItem).addClass("video-categories-plug-in-item");

        // 4) Fill-in the cloned template with details from the ith obj.
        $(categyItem).html(currentObj.name);
        $(categyItem).attr("title", currentObj.name);

        var categoryHref = get_local_url() + "video-categories/show.php?id=" + currentObj.id;
        $(categyItem).attr("href", categoryHref);

        // 5) Append.
        $("#video-categories-plug-in").append($(categyItem));
    }
}