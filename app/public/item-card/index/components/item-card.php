<?php for ($i=0; $i < 5; $i++) { ?>

    <div id="item-card-template" class="item-card col col-lg-4 col-md-6 col-7">

        <div class="item-card-holder">
            <div class="img-holder">
                <img src="<?= CN_URL_PUBLIC . "item-card/photos/iphoneX-portrait.jpg"; ?>" alt="item-img">
            </div>

            <h5 class="name">Apple iPhone X</h5>

            <h6 class="price">$349.99</h6>
        </div>
    </div>

<?php } ?>