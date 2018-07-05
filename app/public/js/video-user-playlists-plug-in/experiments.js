function CN_EXP_getArrayOfUserPlaylistObjs() {
    return [
        {
            user_id: 8,
            playlist_id: 9,
            created_at: "monday",
            playlist: {
                title: "[chamba chamba]"
            }
        },
        {
            user_id: 8,
            playlist_id: 1,
            created_at: "monday",
            playlist: {
                title: "My Songs"
            }
        },
        {
            user_id: 8,
            playlist_id: 3,
            created_at: "tuesday",
            playlist: {
                title: "[My Guitar Cover]"
            }
        },
        {
            user_id: 8,
            playlist_id: 4,
            created_at: "tuesday",
            playlist: {
                title: "[lkasjdfljsaldjflsajd;fljsaldjflasjdflkjlkjjljjljljlkjMy Guitar Cover]"
            }
        }
    ];
}

function CN_EXP_doRegularDisplayVideoUserPlaylist(arrayOfUserPlaylistObjs) {

    for (i = 0; i < arrayOfUserPlaylistObjs.length; i++) {

        // Reference the ith obj.
        var currentObj = arrayOfUserPlaylistObjs[i];

        // Cn-clone the #video-user-playlist-plug-in’s #playlist-item-template.
        var playlistItem = cnCloneTemplate("#playlist-item-template");

        // Add class: playlist-items to the the cloned template.
        $(playlistItem).addClass("playlist-items");

        // Fill-in the cloned template with details from the ith obj.
        $(playlistItem).find(".playlist-titles").html(currentObj.playlist.title);
        $(playlistItem).find(".playlist-titles").attr("title", currentObj.playlist.title);

        // Append the cloned template to  #video-user-playlist-plug-in’s .actual-contents-section.
        $("#video-user-playlists-plug-in").find(".actual-contents-section").append($(playlistItem));
    }
}