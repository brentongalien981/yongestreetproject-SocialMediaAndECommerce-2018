import CnComponent from "./CnComponent.js";

class VideoUserPlaylistsPlugIn extends CnComponent {

    constructor() {
        super({ nodeSelector: "#video-user-playlists-plug-in" });
    }


    /** @override */
    regularSetView(json) {
        var arrayOfUserPlaylistObjs = json.objs;

        for (let i = 0; i < arrayOfUserPlaylistObjs.length; i++) {

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

    /** @override */
    postSetView() {
        var playlistItems = $("#video-user-playlists-plug-in").find(".playlist-items");

        if (playlistItems.length == 0) {
            $("#video-user-playlists-plug-in").find(".no-playlist-to-display-el").css("display", "block");
        } else {
            $("#video-user-playlists-plug-in").find(".no-playlist-to-display-el").css("display", "none");
        }
    }

}


export { VideoUserPlaylistsPlugIn as default }