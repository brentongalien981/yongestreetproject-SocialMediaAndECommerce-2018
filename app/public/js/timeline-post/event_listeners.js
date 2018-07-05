$('#create_post_button').click(function (event) {
    event.stopPropagation();

    create_timeline_post();
});


$('#cancel_create_post_button').click(function (event) {
    event.stopPropagation();

    hide_create_post_form();
});

$('#create_post_link').click(function (event) {
    event.stopPropagation();

    // hide_element($('#edit_photo_form'));
    hide_element($('#create_post_link'));
    // show_element($('#create_post_form'), "block");
    show_element($('#cn-header-pop-up'), "block");


    // cn-header-pop-up
    // b_remove_animation($('#create_post_form').get(0), "fadeOutUp");
    // b_add_animation($('#create_post_form').get(0), "fadeInDown");
    b_remove_animation($('#cn-header-pop-up').get(0), "fadeOutUp");
    b_add_animation($('#cn-header-pop-up').get(0), "fadeInDown");
});

$("#the-rate-bar").find('.rate-bar-hover-trigger').mouseover(function (event) {
    event.stopPropagation();

    clearTimeout(the_rate_bar_mouseout_handler);
    $('#the-rate-bar').css("display", "none");




    // If the hovered element is a rate-pseudo-button itself,
    // then just append the-rate-bar directly.
    // Else, if it's not, traverse up back the DOM until I find
    // the proper rate-pseudo-button. Then append the-rate-bar.
    if (this.classList.contains("rate-pseudo-button")) {
        // $('#the-rate-bar').insertAfter($('#rate-button'));
        $('#the-rate-bar').insertAfter($(this));
    }
    // else if (this.id == "the-rate-bar") { ; }
    else {
        var the_rate_pseudo_button = $(this).closest(".rate-pseudo-button");
        $('#the-rate-bar').insertAfter($(the_rate_pseudo_button));
    }

    // $('#the-rate-bar').css("display", "inline-block");
    $('#the-rate-bar').css("display", "block");

});

$("#the-rate-bar").find('.rate-bar-hover-trigger').mouseout(function (event) {
    event.stopPropagation();

    // if (this.id == "the-rate-bar") { return; }

    the_rate_bar_mouseout_handler = setTimeout(function () {
        $('#the-rate-bar').css("display", "none");
    }, 1000);


});


// Set "the-rate-bar" events.
$("#the-rate-bar").mouseover(function (event) {
    event.stopPropagation();
    clearTimeout(the_rate_bar_mouseout_handler);
    $('#the-rate-bar').css("display", "none");




    if (this.classList.contains("rate-pseudo-button")) {
        // $('#the-rate-bar').insertAfter($('#rate-button'));
        $('#the-rate-bar').insertAfter($(this));
    }
    else {
        var the_rate_pseudo_button = $(this).closest(".rate-pseudo-button");

    }

    // $('#the-rate-bar').css("display", "inline-block");
    $('#the-rate-bar').css("display", "block");

});

$("#the-rate-bar").mouseout(function (event) {
    event.stopPropagation();
    the_rate_bar_mouseout_handler = setTimeout(function () {
        $('#the-rate-bar').css("display", "none");
    }, 1000);


});


$('#main_content').scroll(function (event) {
    // return;
    event.stopPropagation();

    // This is for the timeline-post-options-popup.
    the_rate_bar_mouseout_handler = setTimeout(function () {
        var scroll_top = parseInt($('#main_content').scrollTop());
        var new_top_pos = scroll_top + 50;
        $('#tpspw').css("margin-top", "-" + new_top_pos + "px");
        $('#tpspw').css("display", "none");
        $('#main_content').append($('#tpspw'));

    }, 1);


    // This is for the timeline-post-rate-bar-popup.
    set_timeline_post_settings_popup_position();
});




$('.rate-option').click(function () {
    var rate_value = $(this).attr("rate-value");

    var response_bar = $(this).closest(".b-post-response-bar");
    var rateable_item_id = $(response_bar).attr("rateable-item-id");

    update_rateable_item_user(rateable_item_id, rate_value);
});




// TODO: subscribe-to-post-button event-listener.
$("#subscribe-to-post-button").click(function () {

    // create_timeline_post_subscription();
    createTimelinePostUserSubscription();
});

function add_rate_pseudo_button_hover_listener(post_id) {
    // Append event listener.
    $('#' + post_id).find('.rate-bar-hover-trigger').mouseover(function (event) {
        event.stopPropagation();

        // window.alert("this.id: " + this.id);
        if (this.id == "the-rate-bar") { return; }

        clearTimeout(the_rate_bar_mouseout_handler);
        $('#the-rate-bar').css("display", "none");




        // If the hovered element is a rate-pseudo-button itself,
        // then just append the-rate-bar directly.
        // Else, if it's not, traverse up back the DOM until I find
        // the proper rate-pseudo-button. Then append the-rate-bar.
        if (this.classList.contains("rate-pseudo-button")) {
            // $('#the-rate-bar').insertAfter($('#rate-button'));
            $('#the-rate-bar').insertAfter($(this));
        }
        else {
            var the_rate_pseudo_button = $(this).closest(".rate-pseudo-button");
            $('#the-rate-bar').insertAfter($(the_rate_pseudo_button));
        }

        // $('#the-rate-bar').css("display", "inline-block");
        $('#the-rate-bar').css("display", "block");
    });

    $('#' + post_id).find('.rate-bar-hover-trigger').mouseout(function (event) {
        event.stopPropagation();

        if (this.id == "the-rate-bar") { return; }

        the_rate_bar_mouseout_handler = setTimeout(function () {
            $('#the-rate-bar').css("display", "none");
        }, 1000);


    });
}


