<div id="user-summary-container" class="container-fluid profile-main-item">

    <div class="row justify-content-center">

        <div class="col-10">

            <h2 class="profile-header-title">Summary</h2>

            <?php if ($session->is_viewing_own_account()) { ?>
                <a href="#TODO"><i class="fa fa-sliders profile-header-edit-icon"></i></a>
            <?php } ?>

            <hr>

        </div>

    </div>



    <div class="row justify-content-center">

        <div class="col-8 actual-content">

            <p id="profile-summary"></p>

        </div>

    </div>



</div>

<style>
    #user-summary-container {
        background-color: white;
    }
</style>