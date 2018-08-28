<?php for ($i=0; $i < 6; $i++) { ?>

    <div class="col col-lg-4 col-md-6 col-7">

        <div id="item-card-template" class="item-card">
            <div class="img-holder">
                <img src="<?= CN_URL_PUBLIC . "item-card/photos/iphoneX-portrait.jpg"; ?>" alt="item-img">
            </div>

            <h5 class="name">Apple iPhone X</h5>

            <h6 class="price">$349.99</h6>
        </div>
    </div>

<?php } ?>


<style>

    .item-card {
        background-color: rgb(250, 250, 250);
        /* width: 250px; */
        /* width: inherit  */
        /* height: 400px; */
        margin-bottom: 50px;
        border: 1px solid lightgray;
        border-radius: 10px;
        box-shadow: 0 0 20px lightgrey;
        padding: 20px 0;

    }

    .item-card .img-holder {
        /* background-color: pink; */
        /* width: 250px; */
        /* width: inherit; */
        height: 350px;
        margin-bottom: 10px;
        /* border-top-left-radius: 10px; */
        /* border-top-right-radius: 10px; */

    }

    .item-card img {
        height: 100%;
        display: block;
        margin: auto;
        /* border-top-left-radius: 10px; */
        /* border-top-right-radius: 10px; */
    }

    .item-card .name, .item-card .price {
        text-align: center;
    }

</style>