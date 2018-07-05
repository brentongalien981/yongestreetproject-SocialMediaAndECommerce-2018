/* event_listeners.js */
$("#chat-widget-btn").click(function () {

    // Reference the the xwidget based on the toggle-btn clicked.
    var xWidget = $(this).closest(".widgets");

    // Disable this btn.
    $(this).attr("disabled", "true");

    setXWidget(xWidget);
});