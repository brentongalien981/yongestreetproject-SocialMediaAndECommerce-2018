<div id="videos-table">
    <h3 class="header-title">Select video to edit</h3>

    <div class="cn-table-container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <!-- <th>id</th> -->
                    <th>title</th>
                    <th>owner</th>
                    <th>date added</th>
                    <th>last update</th>
                    <th>action</th>
                </tr>
            </thead>

            <tbody class="videos-table-body">
                <tr id="video-record-row-template">
                    <!-- <td class="video-record-id">#zzz</td> -->
                    <td class="video-record-title">{title}</td>
                    <td class="video-record-owner">{owner}</td>
                    <td class="video-record-created-at">{date added}</td>
                    <td class="video-record-updated-at">{last update}</td>
                    <td><button type="button" class="video-record-delete-btn btn btn-danger"><i class="fa fa-trash-o"></i></button></td>
                </tr>
            </tbody>
        </table>

        <div class="loader-element-container"></div>
        
        <!-- Reference-->
        <div class="reference-for-loading-more-objs"></div>

    </div>
</div>



<style>
    #videos-table {
        padding: 60px 0;
    }

    #videos-table table {
        font-size: 12px;
        font-weight: 100;
        width: 800px;
    }

    #videos-table table td {
        max-width: 500px;
        word-wrap: break-word;
    }

    #videos-table table td:hover {
        cursor: pointer;
    }

    #videos-table .cn-table-container {
        overflow: scroll;
        max-height: 600px;
    }

    #videos-table #video-record-row-template {
        display: none;
    }

    #videos-table .video-record-delete-btn {
        padding: 0 5px;
    }

    #videos-table .video-record-delete-btn:hover {
        box-shadow: 0 0 5px red;
    }


    /* Extra small devices (phones, 640px and down) */

    @media only screen and (max-width: 640px) {}

    /* Small devices (portrait tablets and large phones, 600px and up) */

    @media only screen and (min-width: 641px) {}

    /* Medium devices (landscape tablets, 768px and up) */

    @media only screen and (min-width: 768px) {}

    /* Large devices (laptops/desktops, 992px and up) */

    @media only screen and (min-width: 992px) {}

    /* Extra large devices (large laptops and desktops, 1200px and up) */

    @media only screen and (min-width: 1200px) {}
</style>