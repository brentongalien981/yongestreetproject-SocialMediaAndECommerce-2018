<div id="videos-table">
    <h3 class="header-title">Select video to edit</h3>

    <div class="cn-table-container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>owner</th>
                </tr>
            </thead>

            <tbody class="videos-table-body">
                <tr id="video-record-row-template">
                    <td class="video-record-id">#zzz</td>
                    <td class="video-record-title">{title}</td>
                    <td class="video-record-owner">{owner}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="loader-element-container"></div>
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
        max-height: 700px;
    }


    /* Extra small devices (phones, 640px and down) */

    @media only screen and (max-width: 640px) {

    }

    /* Small devices (portrait tablets and large phones, 600px and up) */

    @media only screen and (min-width: 641px) {}

    /* Medium devices (landscape tablets, 768px and up) */

    @media only screen and (min-width: 768px) {}

    /* Large devices (laptops/desktops, 992px and up) */

    @media only screen and (min-width: 992px) {}

    /* Extra large devices (large laptops and desktops, 1200px and up) */

    @media only screen and (min-width: 1200px) {}
</style>