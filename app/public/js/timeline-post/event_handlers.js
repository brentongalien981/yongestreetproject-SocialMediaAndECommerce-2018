function add_listeners_to_post_settings_popup() {

    //
    $(".post-settings-popup-trigger-el").mouseover(function (event) {
        event.stopPropagation();
        clearTimeout(tpspw_mouseout_handler);
        $("#tpspw").css("display", "block");
    });


    //
    $(".post-settings-popup-trigger-el").mouseout(function (event) {

        //
        event.stopPropagation();
        tpspw_mouseout_handler = setTimeout(function () {
            $("#tpspw").css("display", "none");
        }, 1000);
    });
}

// Add event-listeners to the trigger elements of the post-settings-pop-up.
function add_post_popup_trigger_el_listeners(trigger_el) {

    //
    $(trigger_el).mouseover(function (event) {
        // event.stopPropagation();
        attach_post_settings_popup(this);
    });

    //
    $(trigger_el).mouseout(function (event) {
        // event.stopPropagation();
        detach_post_settings_popup(this);
    });





}

function attach_post_settings_popup(trigger_el) {

    //
    clearTimeout(tpspw_mouseout_handler);

    // Find the closest b-post-details-bar (up the DOM chain).
    var post = $(trigger_el).closest(".b-post-details-bar");

    $("#tpspw").insertAfter($(post));

    $("#tpspw").css("display", "block");
}

function detach_post_settings_popup(trigger_el) {

    //
    tpspw_mouseout_handler = setTimeout(function () {
        $("#tpspw").css("display", "none");
    }, 1000);
}

function set_timeline_post_settings_popup_position() {

    //
    tpspw_mouseout_handler = setTimeout(function () {
        var scroll_top = parseInt($('#main_content').scrollTop());
        $('#the-rate-bar').css("margin-top", "-" + scroll_top + "px");
        $('#the-rate-bar').css("display", "none");
        $('#main_content').append($('#the-rate-bar'));
        // $('#main_content').append($('#the-rate-bar'));

    }, 1);
}