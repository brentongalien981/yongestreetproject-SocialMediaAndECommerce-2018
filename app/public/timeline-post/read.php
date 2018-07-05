<div id="main_content2"  class="container-fluid">

    <?php if ($session->is_logged_in()) { ?>
        <h4>TODO: Oh yeah! You're now logged in!!</h4>
    <?php } else { ?>
        <h4>Oh shootz! Ain't logged-in yet!!</h4>
    <?php } ?>


    <div class="row cn-row">


        <div id="cn-left-col" class="col-xl-3 cn-col">
            left col
        </div>


        <div id="cn-center-col" class="col-xl cn-col">

            <div class="post_background" style="display: none;">
                default reference for fetching first timeline-post.
            </div>

        </div>


        <div id="cn-right-col" class="col-xl-3 cn-col">
            right col
        </div>


    </div>


    <!-- Reference-->
    <div id="reference-for-loading-more-timeline-posts" class="reference-for-loading-more-objs"></div>
</div>





<style>
    .replies-container {
        max-height: 470px;
        overflow-y: auto;
        margin: 0;
        padding: 0;
        /* background-color: orange; */
        border: 1px solid rgb(230, 230, 230);
        /* border-radius: 5px; */
        border-left: none;
        border-right: none;
    }

    #main_content2 {
        /*height: 700px;*/
        /*z-index: 800;*/
    }
    .cn-row {
        height: 100%;
    }

    .cn-col {
        height: 100%;
        display: block;
        padding: 0;
    }


    #cn-left-col {
        background-color: yellow;
    }

    #cn-center-col {
        background-color: red;
    }

    #cn-right-col {
        background-color: black;
    }
</style>