<div id="work-item-template" class="cn-template">

    <div>
        <i class="fa fa-black-tie"></i>
        <h4 class="work-position-title work-labels"></h4>
    </div>

    <div>
        <i class="fa fa-building-o"></i>
        <h5 class="work-employer work-labels">work-employer</h5>
    </div>

    <div>
        <i class="fa fa-calendar"></i>
        <h6 class="work-calendar work-labels">work-year</h6>
    </div>



    <div class="work-descriptions">

        <div id="work-description-template" class="cn-template">
            <i class="fa fa-check-circle-o"></i>
            <p class="work-description work-labels"></p>
        </div>

    </div>


</div>




<style>

    .work-item {
        background-color: white;
        border-left: 5px solid deepskyblue;
        /* padding: 2%; */
        padding: 40px 50px;
        border-radius: 5px;
        margin-bottom: 80px;
        box-shadow: 0 0 30px rgb(150, 150, 150);
    }

    .work-item i {
        font-size: 130%;
    }

    .work-labels,
    .work-description {
        margin-left: 15px;
        vertical-align: top;
    }

    .work-labels {
        display: inline-block;
        margin-bottom: 10px;

    }

    .work-descriptions {
        margin-top: 25px;
        margin-left: 0;
    }

    .work-description {
        width: 90%;
        font-weight: 100;
        font-size: 90%;
        /*vertical-align: top;*/

    }
</style>