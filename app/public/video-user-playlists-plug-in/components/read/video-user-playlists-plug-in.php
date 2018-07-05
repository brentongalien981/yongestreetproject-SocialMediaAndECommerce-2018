<div id="video-user-playlists-plug-in" class="col-12">

    <div class="actual-contents-section">

        <?php global $session; ?>
        <?php if ($session->is_logged_in()) { ?>
            <?php if ($session->is_viewing_own_account()) { ?>
                <h5 title="My Playlists">My Playlists</h5>
            <?php } else { ?>
                <h5 title="<?= $session->currently_viewed_user_name . "'s Playlists"; ?>"><?= $session->currently_viewed_user_name . "'s Playlists"; ?></h5>
            <?php } ?>
        <?php } else { ?>
            <h5>Playlists</h5>
        <?php } ?>

        <hr>


        <h6 class="no-playlist-to-display-el">You currenlty don’t have any playlist...</h6>

        <a id="playlist-item-template" href="#" class="cn-template"><h6 class="playlist-titles">[cn-template]</h6></a>

    </div>

    <div class="loader-element-container"></div>


    <div class="btns-section">
        <button type="button" class="show-more-btn btn-sm btn-primary">show more</button>
        <button type="button" class="show-less-btn btn-sm btn-primary">show less</button>
    </div>
</div>


<style>
    #video-user-playlists-plug-in {
        padding: 20px;
        padding-bottom: 120px;
        /*background-color: pink;*/
    }

    #video-user-playlists-plug-in .playlist-titles {
        font-size: 80%;
        font-weight: 100;
        padding-bottom: 5px;
        color: black;
    }

    #video-user-playlists-plug-in .no-playlist-to-display-el {
        display: none;
    }

    #video-user-playlists-plug-in .actual-contents-section * {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow-x: hidden;
    }

    #video-user-playlists-plug-in .btns-section {
        margin-top: 10px;
    }

    #video-user-playlists-plug-in .show-less-btn {
        visibility: hidden;
    }

    #video-user-playlists-plug-in .loader-element-container {
        width: 100%;
    }
</style>