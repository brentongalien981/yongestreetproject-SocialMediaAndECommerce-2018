function readUserSocialMediaAccount() {

    //
    doPreReadUserSocialMediaAccount();

    //
    doRegularReadUserSocialMediaAccount();

    //
    // doPostReadUserSocialMediaAccount();
}

function doPreReadUserSocialMediaAccount() {

    // //
    // if (getIsPhotoReading() || (getNumOfFailedPhotoAjaxRead() >= 3)) { return; }
    // setIsPhotoReading(true);


    // Set the loader element.
    var loaderMsg = "Loading user's social media...";
    var loaderId = "profile-social-media-xxx";
    var clonedLoaderEl = getClonedLoaderEl(loaderId, loaderMsg);

    var loaderContainer = $("#contact-information-container");

    appendClonedLoaderEl(loaderContainer, clonedLoaderEl);
}


function doRegularReadUserSocialMediaAccount() {
    var crud_type = "read";
    var request_type = "GET";

    var key_value_pairs = {
        read : "yes"
    };


    var obj = new UserSocialMediaAccount(crud_type, request_type, key_value_pairs);
    obj.read();
}