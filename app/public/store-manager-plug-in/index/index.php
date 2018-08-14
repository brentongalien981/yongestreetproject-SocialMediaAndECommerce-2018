<div id="store-manager-plug-in">

    <h6 class="">Store Manager Actions</h6>
    <hr>

    <a class="store-manager-plug-in-action-item" href="<?=CN_URL_PUBLIC . "order/update/"?>">Update Sold Items Status</a>
    <a class="store-manager-plug-in-action-item" href="<?=CN_URL_PUBLIC . "item/create/"?>">Add Store Item</a>
    <a class="store-manager-plug-in-action-item" href="<?=CN_URL_PUBLIC . "item/update/"?>">Update Store Item</a>
    <a class="store-manager-plug-in-action-item" href="<?=CN_URL_PUBLIC . "#"?>">Reports and Analytics</a>

</div>


<style>
    a.store-manager-plug-in-action-item {
        display: block;
        color: blue;
        font-size: 80%;
        font-weight: 100;
    }

    #store-manager-plug-in {
        margin: 30px 10px;
        padding: 0 10px;
    }

    #store-manager-plug-in a {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow-x: hidden;
    }
</style>