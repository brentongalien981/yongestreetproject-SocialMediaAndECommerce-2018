function doUserPlaylistPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            // // Unset loader el.
            // var loaderEl = $("#loader-for-video-user-playlists-plug-in");
            // removeClonedLoaderEl(loaderEl);


            //
            setIsUserPlaylistReading(false);

            //
            if (!isCnAjaxResultOk(json)) {
                setNumOfFailedUserPlaylistAjaxRead(parseInt(getNumOfFailedUserPlaylistAjaxRead()) + 1);
            }

            // //
            // if (!getHasUserPlaylistInitializedFetching()) {
            //     initializeUserPlaylistFetching();
            // }

            break;

        case "show":
            break;
        case "create":
        case "update":
        case "delete":
        case "fetch":

            break;
        case "patch":
            break;
    }
}


function doUserPlaylistAfterEffects(className, crudType, json, xObj) {

    switch (crudType) {
        case "read":
            displayVideoUserPlaylist(json, crudType);
            break;
        case "show":
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


function displayVideoUserPlaylist(json, crudType) {

    doPreDisplayVideoUserPlaylist();
    doRegularDisplayVideoUserPlaylist(json);
    doPostDisplayVideoUserPlaylist();
}

function doPreDisplayVideoUserPlaylist() {
    
}


function doRegularDisplayVideoUserPlaylist(json) {

    var arrayOfUserPlaylistObjs = json.objs;

    for (i = 0; i < arrayOfUserPlaylistObjs.length; i++) {

        // Reference the ith obj.
        var currentObj = arrayOfUserPlaylistObjs[i];

        //
        if (currentObj == null) { continue; }

        // Cn-clone the #video-user-playlist-plug-in’s #playlist-item-template.
        var playlistItem = cnCloneTemplate("#playlist-item-template");

        // Add class: playlist-items to the the cloned template.
        $(playlistItem).addClass("playlist-items");

        // Fill-in the cloned template with details from the ith obj.
        $(playlistItem).find(".playlist-titles").html(currentObj.playlist.title);
        $(playlistItem).find(".playlist-titles").attr("title", currentObj.playlist.title);
        // TODO: Set the href attribute.
        var hrefAttr = get_local_url() + "video-playlist/show.php?id=" + currentObj.playlist.id;
        $(playlistItem).attr("href", hrefAttr);
        $(playlistItem).attr("created-at", currentObj.created_at);

        // Append the cloned template to  #video-user-playlist-plug-in’s .actual-contents-section.
        $("#video-user-playlists-plug-in").find(".actual-contents-section").append($(playlistItem));
    }
}


function doPostDisplayVideoUserPlaylist() {
    var playlistItems = $("#video-user-playlists-plug-in").find(".playlist-items");

    if (playlistItems.length == 0) {
        $("#video-user-playlists-plug-in").find(".no-playlist-to-display-el").css("display", "block");
    } else {
        $("#video-user-playlists-plug-in").find(".no-playlist-to-display-el").css("display", "none");
    }

    //
    setNumOfFailedUserPlaylistAjaxRead(0);
}