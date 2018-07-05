<div id="chat-widget-container" class="widgets">

    <div id="chat-widget-content">

        <div id="chat-widget-header" class="sticky-top">

            <button id="chat-widget-btn" type="button" class="btn btn-primary widget-toggle-btn">
                <i class="fa fa-comments-o"></i>
                <span class="badge badge-danger">4</span>
            </button>


            <nav id="chat-widget-nav" class="widget-nav"></nav>

        </div>



        <div id="chat-widget-main-content" class="widget-main-content"></div>

    </div>

</div>





<style>
    #chat-widget-container {
        /*width: 400px;*/
        /*margin-bottom: 150px;*/
        margin-top: 10px;
        margin-left: 5px;
        overflow-y: auto;
    }

    #chat-widget-header {
        /*height: 30px;*/
        background-color: blue;
    }

    #chat-widget-nav {
        height: 40px;
        background-color: pink;
        display: none;
    }

    #chat-widget-main-content {
        height: 100px;
        background-color: gray;
        display: none;
    }
</style>