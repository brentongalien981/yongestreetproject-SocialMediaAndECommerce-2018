<!--css / main-->
<link rel="stylesheet" type="text/css" href="<?= CN_URL_PUBLIC_CSS . "three-columned-page/index.css"; ?>">

<!-- meat -->
<div id="main-content" class="">


    <div id="cn-left-col" class="cn-col animated">
        <div class="cn-container"></div>
    </div>


    <div id="cn-right-col" class="cn-col animated">
        <div class="cn-container"></div>
    </div>


    <!--*** NOTE ***-->
    <!--Make sure to always load this #cn-center-col the latest...-->
    <!--...later than the left and right cols, so that you won't have problem-->
    <!--...with the displaying of the DOM.-->
    <div id="cn-center-col" class="cn-col">
        <div class="cn-container container-fluid row justify-content-center"></div>
    </div>


    <!-- Reference-->
    <div id="" class="reference-for-loading-more-objs"></div>
</div>