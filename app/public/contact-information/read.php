<div id="contact-information-container">

    <div id="contact-information-holder">

        <div id="profile-photo-section">
            <img>
        </div>

        <div id="profile-names-section" class="profile-detail-sections"></div>
        <hr>

        <div id="profile-contacts-actual-section" class="profile-detail-sections"></div>
        <hr>

        <div id="profile-social-media-section" class="profile-detail-sections"></div>

    </div>

</div>


<?php //require_once(PUBLIC_PATH . "contact-information/social-media-entry-template.php"); ?>
<?php require_once(PUBLIC_PATH . "contact-information/contact-detail-template.php"); ?>



<style>

    #profile-photo-section img {
        width: 256px;
    }

    #contact-information-container {
        margin-bottom: 150px;
    }

    .profile-detail-sections {
        margin: 20px 10px;
        margin-bottom: 30px;
        margin-left: 15px;
    }

    #profile-names-section {
        font-size: 18px;
        font-weight: 100;
    }

    #profile-contacts-actual-section {
        font-size: 13px;
        font-weight: 100;
    }

    #profile-social-media-section {
        font-size: 13px;
        font-weight: 100;
    }

    #contact-information-container hr {
        margin: 0 10px;
        opacity: 0.7;
    }

</style>
