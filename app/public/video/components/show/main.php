<div id="main-content" class="">


    <div id="cn-left-col" class="cn-col animated">
        <div>
            <div id="video-user-playlists-plug-in-container"></div>
        </div>
    </div>


    <div id="cn-right-col" class="cn-col animated">
        <div>
            <div id="page-outline-plug-in-container"></div>
            <div id="video-categories-plug-in-container"></div>
        </div>
    </div>


    <!--*** NOTE ***-->
    <!--Make sure to always load this #cn-center-col the latest...-->
    <!--...later than the left and right cols, so that you won't have problem-->
    <!--...with the displaying of the DOM.-->
    <div id="cn-center-col" class="cn-col">

        <div id="shown-video-container" class="video-container container-fluid row justify-content-center">

            <div class="col-12">

<!--                https://www.youtube.com/embed/NWI4zJgcQEc?rel=0&amp;showinfo=0-->

                <iframe
                    class="video-item rateable-item"
                    rateable-item-id=""
                    item-x-type-id="2"
                    src=""
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
                </iframe>

                <div class="loader-container"></div>
            </div>

        </div>



        <!--Comments and Video-recommendations-->
        <div id="comments-and-recommendations-container" class="container-fluid row">

            <div class="col-10 mx-auto">

                <div class="row">

                    <div id="comments-plug-in-col" class="col-lg-9">

                        <!-- ############ -->
                        <div id="comments-plug-in-container" class="container-fluid row"></div>

                    </div>


                    <div id="video-recommendations-plug-in-col" class="col-lg-3">

                        <!-- ############ -->
                        <div id="video-recommendations-plug-in-container" class="container-fluid row"></div>

                    </div>

                </div>

            </div>


        </div>

    </div>


    <!-- Reference-->
    <div id="" class="reference-for-loading-more-objs"></div>
</div>