function setXWidget(xWidget) {

    // Enable / disable xWidgetToggleBtn.
    var xWidgetToggleBtn = xWidget.find(".widget-toggle-btn");
    var toggleState = toggleXWidgetBtnState(xWidgetToggleBtn);


    //
    if (toggleState == "on") {
        maximizeAnimateXWidgetContainer(xWidget);
    }
    else {
        minimizeAnimateXWidgetContainer(xWidget);
    }
}

function getXWidgetMinWidth(xWidget) {
    var minWidgetWidth = xWidget.find(".widget-toggle-btn").outerWidth();
    return minWidgetWidth;
}

function getXWidgetMinHeight(xWidget) {
    var minWidgetHeight = xWidget.find(".widget-toggle-btn").outerHeight();
    return minWidgetHeight;
}

function minimizeAnimateXWidgetContainer(xWidget) {

    //
    var minWidgetWidth = getXWidgetMinWidth(xWidget);
    var minWidgetHeight = getXWidgetMinHeight(xWidget);

    //
    var widthDecrement = getAnimationDimensionDelta("width");
    var heightDecrement = getAnimationDimensionDelta("height");



    //
    var chatWidgetAnimationHandler = setInterval(function () {

        // Get the current width.
        var currentWidth = xWidget.width();
        var currentHeight = xWidget.height();

        // Check if the widget width has reached the limit.
        if (currentWidth < minWidgetWidth) {

            clearInterval(chatWidgetAnimationHandler);
            chatWidgetAnimationHandler = null;

            // On the final increase of the widget's width, set it exactly
            // to the limit width, because it might have decimal points
            // dangling after it.
            xWidget.width(minWidgetWidth);
            xWidget.height(minWidgetHeight);

            //
            var toggleState = "off";
            setXWidgetSubContentProperties (xWidget, toggleState);


            // enable this btn.
            xWidget.find(".widget-toggle-btn").removeAttr("disabled");

            return;

        }

        // Decrease the widget width.
        xWidget.width(parseFloat(currentWidth) - widthDecrement);
        xWidget.height(parseFloat(currentHeight) - heightDecrement);



    }, getReAnimationTimeInterval());
}

/*

        GOAL:
            I want to animate the width of the x-widget-container from
            width x (initial size of it which is the size of its toggle-btn)
            to maxWidgetWidth.
            And I also want that whole animation process to take place in
            approximately 3s.


        QUESTION:
            How much widthIncrement should I add everytime the animatino
            process loops?


        WIDTH:

            400px               ?px => 5px
            -------     =     -------
            3000ms              50ms


        ANSWER:

            widthIncrement = (maxWidgetWidth) * (reAnimationTimeInterval) / animationTime

     */
function maximizeAnimateXWidgetContainer(xWidget) {

    var widthIncrement = getAnimationDimensionDelta("width");
    var heightIncrement = getAnimationDimensionDelta("height");


    //
    var chatWidgetAnimationHandler = setInterval(function () {

        // Get the current width.
        var currentWidth = xWidget.width();
        var currentHeight = xWidget.height();

        // Check if the widget width has reached the limit.
        if (currentWidth >= getMaxWidgetWidth()) {

            clearInterval(chatWidgetAnimationHandler);
            chatWidgetAnimationHandler = null;

            // On the final increase of the widget's width, set it exactly
            // to the limit width, because it might have decimal points
            // dangling after it.
            xWidget.width(getMaxWidgetWidth());
            xWidget.height(getMaxWidgetHeight());

            //
            var toggleState = "on";
            setXWidgetSubContentProperties (xWidget, toggleState);

            // enable this btn.
            xWidget.find(".widget-toggle-btn").removeAttr("disabled");

            return;

        }

        // Increase the widget width.
        xWidget.width(parseFloat(currentWidth) + widthIncrement);
        xWidget.height(parseFloat(currentHeight) + heightIncrement);


    }, getReAnimationTimeInterval());
}

function setXWidgetSubContentProperties (xWidget, toggleState) {
    if (toggleState == "on") {
        xWidget.find(".widget-nav").css("display", "block");
        xWidget.find(".widget-main-content").css("display", "block");
    }
    else {
        xWidget.find(".widget-nav").css("display", "none");
        xWidget.find(".widget-main-content").css("display", "none");
    }
}

function getAnimationDimensionDelta(whichDimension) {

    var dimensionIncrement = null

    if (whichDimension == "width") {
        dimensionIncrement = getMaxWidgetWidth() * getReAnimationTimeInterval() / getAnimationTime();
    }
    else {
        dimensionIncrement = getMaxWidgetHeight() * getReAnimationTimeInterval() / getAnimationTime();
    }

    return dimensionIncrement;
}

function toggleXWidgetBtnState(xWidgetToggleBtn) {

    if (xWidgetToggleBtn.attr("toggle-state") == "on") { xWidgetToggleBtn.attr("toggle-state", "off"); }
    else { xWidgetToggleBtn.attr("toggle-state", "on"); }

    return xWidgetToggleBtn.attr("toggle-state");
}