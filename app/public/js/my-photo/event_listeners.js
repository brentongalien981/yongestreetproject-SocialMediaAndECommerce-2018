$(window).resize(function () {

    if (hasScreenChangedBreakPoint()) {
        reSetPhotoContainer();
        $( "#solo_view_container" ).trigger( "click" );
        readPhotos();
    }

    // if the solo_view_container is visible..
    if ($('#solo_view_container').css("display") == "block") {
        set_solo_view_container();
    }

});

$('#solo_view_container').click(function () {

    $(this).css("display", "none");
});

$('#previous-solo-button').click(function (event) {

    event.stopPropagation();

    //
    var solo_img_container = $("#solo_img_container").get(0);

    //
    var old_solo_img = solo_img_container.childNodes[0].childNodes[0];
    var old_stack_index = old_solo_img.getAttribute("referencing-stack-index");

    // New referenced img.
    var referenced_img = get_referenced_img(old_stack_index, "previous")[0];


    //
    show_solo_img(referenced_img);

    // add_listener_to_solo_link_holder();
});

$('#next-solo-button').click(function (event) {
    event.stopPropagation();

    //
    var old_solo_img = solo_img_container.childNodes[0].childNodes[0];
    var old_stack_index = old_solo_img.getAttribute("referencing-stack-index");

    // New referenced img.
    var referenced_img = get_referenced_img(old_stack_index, "next")[0];


    //
    show_solo_img(referenced_img);

    // add_listener_to_solo_link_holder();
});

$(window).scroll(function () {
    if (!getIsPhotoReading()) {

        /**/
        if (canIReadMorePhotos()) {
            readPhotos();
        }
    }
});


$("#save-photo-btn").click(function () {
    createPhoto();
});

$("#update-my-photo-btn").click(function () {
    updatePhoto();
});