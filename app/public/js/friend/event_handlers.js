function addClickListenerToSocialMediaItem(socialMediaItem, socialMediaCompanyName, socialMediaUserName) {
    
    $(socialMediaItem).click(function () {
        window.open("https://www." + socialMediaCompanyName + ".com/" + socialMediaUserName);
    });
}