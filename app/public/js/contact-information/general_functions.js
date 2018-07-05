function displayContactInformation(json) {

    //
    var profiles = json.objs;

    //
    for (i = 0; i < profiles.length; i++) {
        var profile = profiles[i];

        //
        setProfilePhotoSections(profile);
        setProfileNamesSection(profile);
        setProfileContactsActualSection(profile);
        // setProfileSocialMediaSection();

    }
}

function setProfileContactsActualSection(profile) {

    //
    var contactDetailItemPhoneNumber = cnCloneTemplate("#contact-detail-template");
    var contactDetailItemEmail = cnCloneTemplate("#contact-detail-template");
    var contactDetailItemAddress = cnCloneTemplate("#contact-detail-template");

    //
    $(contactDetailItemPhoneNumber).find(".contact-detail-icon").addClass("fa fa-phone");
    $(contactDetailItemEmail).find(".contact-detail-icon").addClass("fa fa-envelope");
    $(contactDetailItemAddress).find(".contact-detail-icon").addClass("fa fa-home");

    //
    $(contactDetailItemPhoneNumber).find(".contact-detail-label").html(profile["phone"]);
    $(contactDetailItemEmail).find(".contact-detail-label").html("TODO: a@email.com");

    var address = profile["street1"];
    if (profile["street2"] != null) {
        address += ", " + profile["street2"];
    }
    address += ", " + profile["city"];
    address += " " + profile["state"];
    address += " CA";
    address += " " + profile["zip"];

    $(contactDetailItemAddress).find(".contact-detail-label").html(address);


    //
    $("#profile-contacts-actual-section").append($(contactDetailItemPhoneNumber));
    $("#profile-contacts-actual-section").append($(contactDetailItemEmail));
    $("#profile-contacts-actual-section").append($(contactDetailItemAddress));


}

function setProfileNamesSection(profile) {

    // full-name
    var contactDetailItemFullName = cnCloneTemplate("#contact-detail-template");


    $(contactDetailItemFullName).find(".contact-detail-icon").addClass("fa fa-user");

    //
    var fullName = profile["first_name"] + " " + profile["last_name"];
    if (fullName == "") {
        fullName = "add your full name..";
    }
    $(contactDetailItemFullName).find(".contact-detail-label").html(fullName);



    // user-name
    var contactDetailItemUserName = cnCloneTemplate("#contact-detail-template");
    $(contactDetailItemUserName).addClass("contact-detail-item");

    $(contactDetailItemUserName).find(".contact-detail-icon").addClass("fa fa-at");
    $(contactDetailItemUserName).find(".contact-detail-label").html(profile["user_name"]);



    // append.
    $("#profile-names-section").append($(contactDetailItemFullName));
    $("#profile-names-section").append($(contactDetailItemUserName));
}


function setProfilePhotoSections(profile) {
    if (profile["pic_url"] == "0") { profile["pic_url"] = get_default_pic_url(); }
    $("#contact-information-container img").attr("src", profile["pic_url"]);

}