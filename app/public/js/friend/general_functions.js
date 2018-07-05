function doFriendPreAfterEffects(className, crudType, json, xObj) {

    //
    switch (crudType) {
        case "read":

            // Unset loader el.
            var loaderEl = $("#loader-for-connection-xxx");
            removeClonedLoaderEl(loaderEl);

            //
            if (!isCnAjaxResultOk(json)) {
                setNumOfFailedFriendAjaxRead(parseInt(getNumOfFailedFriendAjaxRead()) + 1);
            }

            break;

        case "create":
        case "update":
        case "delete":
        case "fetch":
        case "patch":
            break;
    }
}

function doFriendAfterEffects(className, crudType, json, xObj) {
    switch (crudType) {
        case "read":

            displayFriends(json);

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

function displayFriends(json) {

    var friends = json.objs;


    //
    for (var i = 0; i < friends.length; i++) {

        var friend = friends[i];

        //
        var friendItem = getFriendItem(friend);

        //
        $("#friend-item-holder").append($(friendItem));

    }

}

function getFriendItem(friend) {

    // Clone a friend-item-template.
    var friendItem = $("#friend-item-template").clone(true);
    $(friendItem).removeAttr("id");
    $(friendItem).removeClass("cn-template");
    $(friendItem).addClass("friend-item");


    // Set the friend-photo.
    var picUrl = friend.profile.pic_url;
    setFriendItemPhoto(friendItem, picUrl)

    // Set the friend-details.
    setFriendItemDetails(friendItem, friend);

    // Return the friend-item.
    return friendItem;
}

function setFriendItemDetails(friendItem, friend) {

    $(friendItem).find(".friend-name").html("@" + friend.user_name);
    var userProfilePageLink = $(friendItem).find(".friend-name").attr("href");
    userProfilePageLink += friend.user_name;
    $(friendItem).find(".friend-name").attr("href", userProfilePageLink);

    //
    setFriendItemSocialMediaEntries(friendItem, friend.socialMediaAccounts);
}

function setFriendItemSocialMediaEntries(friendItem, socialMediaAccounts) {

    for (var i = 0; i < socialMediaAccounts.length; i++) {

        var socialMediaAccount = socialMediaAccounts[i];

        // Clone a friend-social-media-item template.
        var socialMediaItem = $("#friend-social-media-item").clone(true);
        $(socialMediaItem).removeAttr("id");
        $(socialMediaItem).removeClass("cn-template");
        $(socialMediaItem).addClass("friend-social-media-item");


        // Set the icon.
        var socialMediaItemIcon = $(socialMediaItem).find("i");
        var socialMediaCompanyName = socialMediaAccount.social_media_company_name;
        var socialMediaUserName = socialMediaAccount.social_media_username;

        
        switch (socialMediaCompanyName) {
            case "facebook":
                $(socialMediaItemIcon).addClass("fa fa-facebook-square");
                break;
            case "twitter":
                $(socialMediaItemIcon).addClass("fa fa-twitter");
                break;
            default:
                $(socialMediaItemIcon).addClass("fa fa-bug");
                break;
        }


        //
        addClickListenerToSocialMediaItem(socialMediaItem, socialMediaCompanyName, socialMediaUserName);


        // Append.
        $(friendItem).find(".friend-social-media-holder").append($(socialMediaItem));
        
    }
}

function setFriendItemPhoto(friendItem, picUrl) {

    if (picUrl == "0") {
        picUrl = get_default_pic_url();
    }


    $(friendItem).find("img").attr("src", picUrl);
}

function setConnectionsScrollbarWidth() {

    $("#connections-scrollbar").width($(this).width());
}