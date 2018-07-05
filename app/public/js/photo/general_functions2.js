function createPhotoElContainer(photoObj, photoEl, photoCaption) {

    //
    var photoElContainer = document.createElement("div");
    photoElContainer.classList.add("individual_photo_container");
    photoElContainer.classList.add("photo");
    $(photoElContainer).attr("created-at", photoObj.created_at);

    //
    $(photoElContainer).append($(photoEl));
    $(photoElContainer).append($(photoCaption));

    return photoElContainer;
}

function createPhotoCaption(photo, currentPhotoDimensions, isViewingOwnAccount) {

    //
    var w = currentPhotoDimensions.width;
    var h = currentPhotoDimensions.height;

    //
    var caption = document.createElement("div");
    caption.classList.add("captions");

    $(caption).width(w);
    $(caption).height(h);

    //
    var captionMarginTop = "-" + h + "px";
    $(caption).css("margin-top", captionMarginTop);


    // Add event listeners.
    add_click_listener_to_caption(caption);



    // Set the caption content.
    var captionContent = getPhotoCaptionContent(photo, isViewingOwnAccount);

    // Add the content of the caption.
    $(caption).append($(captionContent));


    return caption;
}

function getPhotoCaptionContent(photo, isViewingOwnAccount) {

    var content = document.createElement("div");
    content.classList.add("caption_action_bar");


    // Append the photo title to the caption content.
    var photoTitleEl = document.createElement("h6");
    $(photoTitleEl).addClass("photo-caption-title");
    $(photoTitleEl).html(photo.title);
    content.appendChild(photoTitleEl);


    return content;
}

function createPhotoEl(photo, currentPhotoDimensions) {

    var photoEl = document.createElement("img");

    photoEl.setAttribute("id", photo.id);
    photoEl.setAttribute("alt", photo.title);
    photoEl.setAttribute("stack-index", photo.stack_index);
    photoEl.setAttribute("src", photo.src);
    photoEl.setAttribute("raw-width", photo.raw_width);
    photoEl.setAttribute("raw-height", photo.raw_height);
    photoEl.setAttribute("width", currentPhotoDimensions.width);
    photoEl.setAttribute("height", currentPhotoDimensions.height);

    // photoEl.setAttribute("for-data-flickr-embed", "true");
    photoEl.setAttribute("for-href", photo.href);

    return photoEl;
}

function getPhotoDimensions(p, total_reference_width) {

    // current_photo_width_percentage
    var wp = p.reference_width / total_reference_width;


    // Now calculate their dimensions when displayed by multiplying each
    // width percentage to the width of the row container.

    // width
    var w = (getPhotoContainerWidth() * wp) - 1;
    var w = roundToTwo(w);


    // aspect ratio
    var r = p.raw_width / p.raw_height;

    // height
    var h = roundToTwo(w / r);

    //
    var photoDimensions = {
        width: w,
        height: h
    }

    //
    return photoDimensions;
}

function doRegularDisplayOfRowPhotos(photos_to_be_displayed, total_reference_width, json) {

    // Now, all photos in that row container have their raw dimensions.
    // So calculate the width percentage that each of them consume.
    for (i = 0; i < photos_to_be_displayed.length; i++) {

        // current photo
        var p = photos_to_be_displayed[i];

        //
        var currentPhotoDimensions = getPhotoDimensions(p, total_reference_width);


        // Create the <img>
        var photoEl = createPhotoEl(p, currentPhotoDimensions);


        // Create the photo caption.
        var isViewingOwnAccount = json.is_viewing_own_account;
        var photoCaption = createPhotoCaption(p, currentPhotoDimensions, isViewingOwnAccount);


        // Create the photo container.
        var photoElContainer = createPhotoElContainer(p, photoEl, photoCaption);


        // Append
        $("#photo-main-container").append(photoElContainer);
    }
}

function getRawWidthOfCombinedPhotosInRow(photos_to_be_displayed) {

    var total_reference_width = 0;

    for (i = 0; i < photos_to_be_displayed.length; i++) {
        total_reference_width += photos_to_be_displayed[i].reference_width;
    }

    return total_reference_width;
}

function getPhotosToBeDisplayed(photos, numOfPhotosInRow, rawHeightOfTallestPhotoInRow) {

    //
    var photosToBeDisplayed = [];


    // Set the attributes of all the photos to be displayed
    // in the row container
    for (i = 0; i < numOfPhotosInRow; i++) {

        //
        var currentPhotoIndex = getNumOfNewlyDisplayedPhotos();
        var rawPhotoObj = photos[currentPhotoIndex];

        //
        if (!isTherePhotoToBeDisplayed(rawPhotoObj)) {
            break;
        }


        //
        photosToBeDisplayed[i] = getPhotoToBeDisplayed(rawPhotoObj, rawHeightOfTallestPhotoInRow);

        // setNumOfNewlyDisplayedPhotos
        var numOfNewlyDisplayedPhotos = getNumOfNewlyDisplayedPhotos() + 1;
        setNumOfNewlyDisplayedPhotos(numOfNewlyDisplayedPhotos);

    }

    //
    return photosToBeDisplayed;
}

function getPhotoToBeDisplayed(rawPhotoObj, rawHeightOfTallestPhotoInRow) {

    var id = "photo" + rawPhotoObj['id'];
    var title = rawPhotoObj['title'];
    var href = rawPhotoObj['href'];
    var src = rawPhotoObj['src'];
    var raw_width = rawPhotoObj['width'];
    var raw_height = rawPhotoObj['height'];
    var created_at = rawPhotoObj['created_at'];

    // Given the aspect ratio of each photo, calculate their widths at
    // that maximum reference height.
    var reference_width = get_reference_width(rawHeightOfTallestPhotoInRow, raw_width, raw_height);


    var a_photo_to_be_displayed = {
        "id": id,
        "title": title,
        "stack_index": getStackIndex(),
        "href": href,
        "src": src,
        "raw_width": raw_width,
        "raw_height": raw_height,
        "reference_width": reference_width,
        "reference_height": rawHeightOfTallestPhotoInRow,
        "created_at": created_at
    };

    setStackIndex(getStackIndex() + 1);

    //
    return a_photo_to_be_displayed;
}

/**
 * // Given the aspect ratio of each photo, calculate their widths at
 * // that maximum reference height.
 */
function get_reference_width(max_ref_height, raw_width, raw_height) {
    // Aspect ratio
    var r = raw_width / raw_height;

    var reference_width = r * max_ref_height;

    return reference_width;

}

function isTherePhotoToBeDisplayed(photo) {

    if (photo != null) {
        return true;
    }

    return false;
}

function setHorizontalDividerForRowOfPhotos() {

    var horizontal_divider = document.createElement("div");
    horizontal_divider.classList.add("horizontal_divider");
    $("#photo-main-container").append($(horizontal_divider));
}


function show_solo_img(referenced_img) {
    //
    if (referenced_img == null) { return; }


    // Create the new solo img.
    var solo_img = document.createElement("img");
    // solo_img.classList.add("solo_imgs");
    solo_img.setAttribute("referencing-photo-id", referenced_img.id);
    solo_img.setAttribute("referencing-stack-index", referenced_img.getAttribute("stack-index"));
    solo_img.setAttribute("src", referenced_img.src);

    var raw_width = parseInt(referenced_img.getAttribute("raw-width"));
    var raw_height = parseInt(referenced_img.getAttribute("raw-height"));
    var w = raw_width;
    var h = raw_height;

    // If both dimension are too big
    if (raw_width >= 900 && raw_height >= 900) {
        if (raw_width > raw_height) {
            var r = raw_width / raw_height;
            var w = 900;
            var h = w / r;
        }
        else {
            var r = raw_width / raw_height;
            var h = 900;
            var w = h * r;
        }
    }
    else if (raw_width > 900) {
        var r = raw_width / raw_height;
        var w = 900;
        var h = w / r;
    }
    else if (raw_height > 900) {
        var r = raw_width / raw_height;
        var h = 900;
        var w = h * r;
    }

    solo_img.setAttribute("width", w);
    solo_img.setAttribute("height", h);


    //
    clear_solo_img_container();

    // link holder for the img
    var link_holder = document.createElement("a");
    link_holder.classList.add("solo_link_holder");
    link_holder.id = "link_holder";
    link_holder.setAttribute("href", referenced_img.getAttribute("for-href"));
    link_holder.setAttribute("data-flickr-embed", "true");
    link_holder.setAttribute("target", "_blank");

    link_holder.appendChild(solo_img);

    $("#solo_img_container").append($(link_holder));
    // solo_img_container.appendChild(link_holder);


    set_solo_view_container();

    add_listener_to_solo_link_holder();
}

function set_solo_view_container() {

    var the_body = document.getElementById("the_body");

    $('#solo_view_container').css("display", "none");

    $('#solo_view_container').css("width", the_body.scrollWidth + "px");
    $('#solo_view_container').css("height", the_body.scrollHeight + "px");

    $('#solo_view_container').css("display", "block");

    //
    setSoloImgContainer();
}

function setSoloImgContainer() {

    var windowWidth = $(window).width();
    var windowHeight = $(window).height();

    var adjustedSoloImgContainerWidth = windowWidth * 0.65;
    var adjustedSoloImgContainerHeight = windowHeight * 0.85;


    /* Finalize the dimensions of the solo img. */
    var soloImg = $("#solo_img_container").find("img");
    var soloImgAspectRatio = $(soloImg).width() / $(soloImg).height();
    var soloImgWidth = adjustedSoloImgContainerWidth;
    var soloImgHeight = adjustedSoloImgContainerWidth / soloImgAspectRatio;

    // Re-adjust the dimensions if the photo is portrait.
    if (soloImgHeight > windowHeight) {
        soloImgHeight = adjustedSoloImgContainerHeight;
        soloImgWidth = soloImgHeight * soloImgAspectRatio;
    }

    //
    $("#solo_img_container").width(adjustedSoloImgContainerWidth);
    $("#solo_img_container").height(adjustedSoloImgContainerHeight);

    //
    $(soloImg).width(soloImgWidth);
    $(soloImg).height(soloImgHeight);

}

function clear_solo_img_container() {
    var solo_img_container = $("#solo_img_container").get(0);
    var length = solo_img_container.childNodes.length;

    for (i = 0; i < length; i++) {
        solo_img_container.removeChild(solo_img_container.childNodes[0]);
    }
}

function get_referenced_img(old_stack_index, which_img) {

    //
    var photos_container = $("#photo-main-container").get(0);

    var nodes = photos_container.childNodes;
    var index_incrementor = 0;

    if (which_img == "next") {
        index_incrementor = 1;
    }
    else {
        index_incrementor = -1;
    }

    var new_index = parseInt(old_stack_index) + parseInt(index_incrementor);

    // Get the reference to an element based on its attribute.
    return $("[stack-index=" + new_index + "]");
}