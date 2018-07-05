function doWorkPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            // Unset loader el.
            var loaderEl = $("#loader-for-work-xxx");
            removeClonedLoaderEl(loaderEl);
            break;

        case "create":
        case "update":
        case "delete":
        case "fetch":
        case "patch":
            break;
    }
}

function doWorkAfterEffects(className, crudType, json, xObj) {
    switch (crudType) {
        case "read":

            displayWorks(json);

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

function displayWorks(json) {

    var works = json.objs;


    //
    for (var i = 0; i < works.length; i++) {
        var work = works[i];

        // Set work-item.
        var workItem = $("#work-item-template").clone(true);
        $(workItem).removeAttr("id");
        $(workItem).removeClass("cn-template");
        $(workItem).addClass("work-item");

        //
        $(workItem).find(".work-position-title").html(work["title"]);
        $(workItem).find(".work-employer").html(work["employer"]);

        var workFromMonth = getWorkMonth(work["from_date"]);
        var workFromYear = getWorkYear(work["from_date"]);
        var workToMonth = getWorkMonth(work["to_date"]);
        var workToYear = getWorkYear(work["to_date"]);
        var workCalendar = workFromMonth + " " + workFromYear + " to " + workToMonth + " " + workToYear;

        $(workItem).find(".work-calendar").html(workCalendar);


        //
        setWorkItemDescriptions(workItem, work["descriptions"]);


        //
        $("#work-container").find(".actual-content").append($(workItem));

    }

}

function setWorkItemDescriptions(workItem, descriptions) {

    //
    for (i = 0; i < descriptions.length; i++) {
        var description = descriptions[i];

        // Set work-item.
        var descriptionEl = $("#work-description-template").clone(true);
        $(descriptionEl).removeAttr("id");
        $(descriptionEl).removeClass("cn-template");

        $(descriptionEl).find(".work-description").html(description["description"]);


        //
        $(workItem).find(".work-descriptions").append($(descriptionEl));

    }
}

function getWorkMonth(datetime) {

    var month = datetime.substr(5, 2);

    switch (month) {
        case "01":
            return "January";
        case "02":
            return "Febuary";
        case "03":
            return "March";
        case "04":
            return "April";
        case "05":
            return "May";
        case "06":
            return "June";
        case "07":
            return "July";
        case "08":
            return "August";
        case "09":
            return "September";
        case "10":
            return "October";
        case "11":
            return "November";
        case "12":
            return "December";
    }
}

function getWorkYear(datetime) {

    return datetime.substr(0, 4);
}