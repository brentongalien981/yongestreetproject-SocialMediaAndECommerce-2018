<div id="notification-widget-container" class="widgets widget-toggled-off">

    <div id="notification-widget-content">

        <div id="notification-widget-header"  class="sticky-top">

            <button id="notification-widget-btn" toggle-state="off" type="button" class="btn btn-primary widget-toggle-btn">
                <i class="fa fa-bell"></i>
                <span class="badge badge-danger">2</span>
            </button>

            <nav id="notification-widget-nav" class="widget-nav nav navbar-nav">

                <a class="nav-item"
                   href="#"
                   data-toggle="tooltip"
                   data-placement="bottom"
                   title="Timeline Notification">
                    <i class="fa fa-list-alt"></i>
                </a>

                <a class="nav-item"
                   href="#"
                   data-toggle="tooltip"
                   data-placement="bottom"
                   title="MyBusiness Notification">
                    <i class="fa fa-bitcoin"></i>
                </a>

                <a class="nav-item"
                   href="#"
                   data-toggle="tooltip"
                   data-placement="bottom"
                   title="Friendship Notification">
                    <i class="fa fa-users"></i>
                </a>

            </nav>

        </div>

        <div id="notification-widget-main-content" class="widget-main-content"></div>

    </div>

</div>


<style>

    #notification-widget-container {
        /*width: 400px;*/
        /*margin-bottom: 150px;*/
        overflow-y: auto;
    }

    #notification-widget-header {
        /*height: 30px;*/
        background-color: blue;
    }

    #notification-widget-nav {
        height: 30px;
        display: none;
        background-color: pink;
    }

    #notification-widget-main-content {
        /*height: 100px;*/
        display: none;
        background-color: whitesmoke;
    }
</style>


