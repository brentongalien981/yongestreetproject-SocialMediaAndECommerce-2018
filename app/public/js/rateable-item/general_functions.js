function do_rateable_item_after_effects(class_name, crud_type, json, x_obj) {


    switch (crud_type) {
        case "read":
            /* set_rateable_item_ids */
            var rateable_items = json.objs;
            attach_rateable_item_ids(rateable_items);


            /* */
            var rateable_item_id = rateable_items[0]["id"];

            read_rate_tag(rateable_item_id);
            read_rate_sigma(rateable_item_id);
            read_rate_value_sigma(rateable_item_id);


            break;
        case "create":
            // var item_x_id = json["item_x_id"];
            var item_x_id = x_obj.key_value_pairs.item_x_id;

            /* Read the rateable item. */
            var post_id = item_x_id;
            read_rateable_item_id(post_id);

            break;
        case "update":
            break;
        case "delete":
            break;
    }
}


function show_element(el, display) {
    $(el).css("display", display);
}

function hide_element(el) {
    $(el).css("display", "none");
}

/**
 *
 * @param el element
 * @param a animation
 */
function b_add_animation(el, a) {
    el.classList.add(a);


}

/**
 *
 * @param el element
 * @param a animation
 */
function b_remove_animation(el, a) {
    el.classList.remove(a);
}

function hide_create_post_form() {
    // show_element($('#create_post_link'), "inline");
    show_element($('#create_post_link'), "initial");


    // b_remove_animation($('#create_post_form').get(0), "fadeInDown");
    // b_add_animation($('#create_post_form').get(0), "fadeOutUp");
    b_remove_animation($('#cn-header-pop-up').get(0), "fadeInDown");
    b_add_animation($('#cn-header-pop-up').get(0), "fadeOutUp");

    setTimeout(function () {
        // hide_element($('#create_post_form'));
        hide_element($('#cn-header-pop-up'));

    }, 500);
}