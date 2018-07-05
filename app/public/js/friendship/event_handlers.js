function addClickListenerTo(socialMediaItem, socialMediaCompanyName) {
    
    $(socialMediaItem).click(function () {
        window.open("https://www." + socialMediaCompanyName + ".com/");
    });
}