async function init_read_response_bar_details() {
    // Before reading the rate_tags and all response bar details,
    // each response bars' rateable_item_ids should be read and ready.
    while (!are_rateable_item_ids_set) {
        await
        my_sleep(1000);
    }

    read_rate_tags();
    read_rate_sigma();
    read_rate_value_sigma();
}


function read_rate_value_sigma(rateable_item_id) {

    var crud_type = "read";
    var request_type = "GET";


    var key_value_pairs = {
        read: "yes",
        rateable_item_id: rateable_item_id,
        what_to_read: "rate_value_sigma"
    };


    var obj = new RateableItemUser(crud_type, request_type, key_value_pairs);
    obj.read();

}


function read_rate_sigma(rateable_item_id) {
    var crud_type = "read";
    var request_type = "GET";


    var key_value_pairs = {
        read: "yes",
        rateable_item_id: rateable_item_id,
        what_to_read: "rate_sigma"
    };


    var obj = new RateableItemUser(crud_type, request_type, key_value_pairs);
    obj.read();

}

function read_rate_tags() {

    var response_bars = $(".b-post-response-bar");
    var rateable_item_ids = get_rateable_item_ids(response_bars);

    var crud_type = "read";
    var request_type = "GET";


    var key_value_pairs = {
        read: "yes",
        rateable_item_ids: rateable_item_ids,
        to_read: "rate_tags"
    };


    var obj = new RateableItemUser(crud_type, request_type, key_value_pairs);
    obj.read();

}

function read_rate_tag(rateable_item_id) {
    var crud_type = "read";
    var request_type = "GET";


    var key_value_pairs = {
        read: "yes",
        rateable_item_id: rateable_item_id,
        what_to_read: "rate_tags"
    };


    var obj = new RateableItemUser(crud_type, request_type, key_value_pairs);
    obj.read();

}

function get_rateable_item_ids(response_bars) {
    var rateable_item_ids = [];

    for (i = 0; i < response_bars.length; i++) {
        rateable_item_ids[i] = $(response_bars[i]).attr("rateable-item-id");
        // rateable_item_ids[i] = response_bars[i].id;
    }

    return rateable_item_ids;
}

function set_rate_pseudo_button(rateable_item_id, rate_value) {
    // Reference the response-bar based on attribute.
    var response_bar = $("[rateable-item-id='" + rateable_item_id + "']");

    // Reference the rate-pseudo-button based in that response-bar.
    var rate_pseudo_button = $(response_bar).find(".rate-pseudo-button").get(0);

    if (rate_pseudo_button == null) { return; }

    // TODO: Set the img for this rate-tag.
    var the_img_el = rate_pseudo_button.childNodes[0];
    var img_src = "";
    var img_src_suffix = null;



    // Set the msg for this rate-tag.
    var reaction_tag_msg = "You rated this \"";

    switch (rate_value) {
        case "-5":
            reaction_tag_msg += "MEME";
            img_src_suffix = "img/rate-icons/CryingMJ.png";
            break;
        case "-4":
            reaction_tag_msg += "BOMB";
            img_src_suffix = "img/rate-icons/Bomb.png";
            break;
        case "-3":
            reaction_tag_msg += "BUGGY";
            img_src_suffix = "img/rate-icons/Shit.png";
            break;
        case "-2":
            reaction_tag_msg += "NUTS";
            img_src_suffix = "img/rate-icons/Nuts.png";
            break;
        case "-1":
            reaction_tag_msg += "SUCKS";
            img_src_suffix = "img/rate-icons/Sucks.png";
            break;
        case "0":
            reaction_tag_msg += "POKERFACE";
            img_src_suffix = "img/rate-icons/SosoFace.png";
            break;
        case "1":
            reaction_tag_msg += "SWAGGY";
            img_src_suffix = "img/rate-icons/Swaggy.png";
            break;
        case "2":
            reaction_tag_msg += "COOKIN";
            img_src_suffix = "img/rate-icons/Cookin.png";
            break;
        case "3":
            //
            reaction_tag_msg += "BALLIN";
            img_src_suffix = "img/rate-icons/Ballin.png";
            break;
        case "4":
            reaction_tag_msg += "nDzone";
            img_src_suffix = "img/rate-icons/NDZone.png";
            break;
        case "5":
            reaction_tag_msg += "GOAT";
            img_src_suffix = "img/rate-icons/MJGoat.png";
            break;
    }

    reaction_tag_msg += "\"";


    $(the_img_el).attr("src", get_local_url() + img_src_suffix);
    // Set the msg.
    rate_pseudo_button.childNodes[1].innerHTML = reaction_tag_msg;
}

function set_rate_pseudo_buttons(objs) {
    var length = objs.length;

    for (i = 0; i < length; i++) {
        var rateable_item_id = objs[i]["rateable_item_id"];
        var rate_value = objs[i]["rate_value"];

        set_rate_pseudo_button(rateable_item_id, rate_value);
    }
}

function set_rate_sigmas(objs) {
    var length = objs.length;

    for (i = 0; i < length; i++) {
        var rateable_item_id = objs[i]["rateable_item_id"];
        var count = objs[i]["count"];

        set_rate_sigma(rateable_item_id, count);
    }
}

function set_rate_averages(objs) {
    var length = objs.length;

    for (i = 0; i < length; i++) {
        var rateable_item_id = objs[i]["rateable_item_id"];
        var count = objs[i]["count"];
        var rate_value_sum = objs[i]["rate_value_sum"];

        set_rate_average(rateable_item_id, count, rate_value_sum);
    }
}

function set_rate_sigma(rateable_item_id, count) {
    // Reference the response-bar based on attribute.
    var response_bar = $("[rateable-item-id='" + rateable_item_id + "']");

    // Reference the rate-sigma-pseudo-button based in that response-bar.
    var rate_sigma_pseudo_button = $(response_bar).find(".rate-sigma-pseudo-button").get(0);

    if (rate_sigma_pseudo_button == null) { return; }

    // TODO: Set the img for this rate-tag.


    // Set the msg for this rate-tag.
    var pseudo_button_msg = "";

    if (count == 1) {
        pseudo_button_msg += count + " rate tag";
    }
    else {
        pseudo_button_msg += count + " rate tags";
    }


    // Set the msg.
    rate_sigma_pseudo_button.childNodes[1].innerHTML = pseudo_button_msg;
}

function set_rate_average(rateable_item_id, count, rate_value_sum) {
    // Reference the response-bar based on attribute.
    var response_bar = $("[rateable-item-id='" + rateable_item_id + "']");

    // Reference the rate-average-pseudo-button based in that response-bar.
    var rate_average_pseudo_button = $(response_bar).find(".rate-average-pseudo-button").get(0);

    if (rate_average_pseudo_button == null) { return; }
    // TODO: Set the img for this rate-tag.


    // Set the msg for this rate-tag.
    var pseudo_button_msg = "";
    var avg = parseFloat(rate_value_sum) / parseFloat(count);


    if (avg > 0) {
        pseudo_button_msg += "(Average Rating: +" + roundToTwo(avg) + ") ";
    }
    else {
        pseudo_button_msg += "(Average Rating: " + roundToTwo(avg) + ") ";
    }

    if (avg < -4.5) {
        pseudo_button_msg += "MEME";
    }
    else if (avg < -3.5 && avg >= -4.5) {
        pseudo_button_msg += "BOMB";
    }
    else if (avg < -2.5 && avg >= -3.5) {
        pseudo_button_msg += "BUGGY";
    }
    else if (avg < -1.5 && avg >= -2.5) {
        pseudo_button_msg += "NUTS";
    }
    else if (avg < -0.5 && avg >= -1.5) {
        pseudo_button_msg += "SUCKS";
    }
    else if (avg < 0.5 && avg >= -0.5) {
        pseudo_button_msg += "POKERFACE";
    }
    else if (avg < 1.5 && avg >= 0.5) {
        pseudo_button_msg += "SWAGGY";
    }
    else if (avg < 2.5 && avg >= 1.5) {
        pseudo_button_msg += "COOKIN";
    }
    else if (avg < 3.5 && avg >= 2.5) {
        pseudo_button_msg += "BALLIN";
    }
    else if (avg < 4.5 && avg >= 3.5) {
        pseudo_button_msg += "nDzone";
    }
    else if (avg < 5 && avg >= 4.5) {
        pseudo_button_msg += "GOAT";
    }



    // Set the msg.
    rate_average_pseudo_button.childNodes[1].innerHTML = pseudo_button_msg;
}