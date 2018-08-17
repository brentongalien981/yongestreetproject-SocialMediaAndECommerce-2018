<div id="items-table">
    <h3 class="header-title">Select item to edit</h3>

    <div class="cn-table-container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>quantity</th>
                    <th>price</th>
                    <th>date added</th>
                    <th>last update</th>
                    <th>action</th>
                </tr>
            </thead>

            <tbody class="items-table-body">
                <tr id="item-record-row-template">

                    <td class="item-record-id">#zzz</td>
                    <td class="item-record-name">{name}</td>
                    <td class="item-record-quantity">{quantity}</td>
                    <td class="item-record-price">{price}</td>

                    <td class="item-record-created-at">{date added}</td>
                    <td class="item-record-updated-at">{last update}</td>
                    <td><button type="button" class="item-record-delete-btn btn btn-danger"><i class="fa fa-trash-o"></i></button></td>

                </tr>
            </tbody>
        </table>

        <div class="loader-element-container"></div>
        
        <!-- Reference-->
        <div class="reference-for-loading-more-objs"></div>

    </div>
</div>


<!-- <link rel="stylesheet" type="text/css" href="css/item/update/components/items-table.css"> -->