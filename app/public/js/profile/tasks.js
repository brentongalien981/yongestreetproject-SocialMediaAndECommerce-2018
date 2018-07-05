$(document).ready(function () {

    setPageTitle("Profile | CuteNinjar");

    initPage();

    readProfileSummary();

    readContactInformation();
});


function initPage() {
    initContainers();

    $("#center-col-toggle-btn").remove();

    setSideColumns();

    initBootstrapScrollSpy();

    addSmoothScrollingToLinks();
}

function setSideColumns() {

    // $("#cn-right-col").height($(this).height());
    // $("#cn-left-col").height($(this).height());
    $("#cn-right-col").height($(this).outerHeight());
    $("#cn-left-col").height($(this).outerHeight());
}

function initContainers() {
    $("#cn-center-col").append($("#user-top-activities-container"));
    $("#cn-center-col").append($("#user-summary-container"));
    $("#cn-center-col").append($("#work-container"));
    $("#cn-center-col").append($("#connections-container"));

    $("#cn-left-col").append($("#contact-information-container"));
    $("#cn-right-col").append($("#profile-page-outline-container"));
}

function initBootstrapScrollSpy() {
    /*

             class="cn-col scrollspy-example"
             data-spy="scroll"
             data-target="#profile-page-outline-container"
             data-offset="0
     */
    $("#the_body").addClass("scrollspy-example");
    $("#the_body").attr("data-spy", "scroll");
    $("#the_body").attr("data-target", "#profile-page-outline-container");
    $("#the_body").attr("data-offset", "50");
}

function addSmoothScrollingToLinks() {


    $("#profile-page-outline-container a").on('click', function(e) {

        // prevent default anchor click behavior
        e.preventDefault();

        // store hash
        var hash = this.hash;

        // animate
        $('html, body').animate({
            scrollTop: $(hash).offset().top
        }, 300, function(){

            // when done, add hash to url
            // (default click behaviour)
            window.location.hash = hash;
        });

    });
}