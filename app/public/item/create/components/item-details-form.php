<form id="item-details-form" class="col-10">

    <h3 class="header-label">Add Item</h3>

    <!-- name -->
    <div class="form-group">
        <label for="item-name">item name</label>
        <input type="text" class="form-control" id="item-name" aria-describedby="" placeholder="(max of 256 characters...)">
        <label class="cn-error-label" id="cn-error-label-item-name"></label>
    </div>

    <!-- quantity -->
    <div class="form-group">
        <label for="item-quantity">quantity</label>
        <input type="number" class="form-control" id="item-quantity" aria-describedby="">
        <label class="cn-error-label" id="cn-error-label-item-quantity"></label>
    </div>

    <!-- price -->
    <div class="form-group">
        <label for="item-price">price</label>
        <input type="number" class="form-control" id="item-price" aria-describedby="">
        <label class="cn-error-label" id="cn-error-label-item-price"></label>
    </div>

    <!-- description -->
    <div class="form-group">
        <label for="item-description">description</label>
        <textarea class="form-control" id="item-description" rows="5"></textarea>
        <label class="cn-error-label" id="cn-error-label-item-description"></label>
    </div>

    <!-- photo-urls -->
    <div class="form-group">
        <label for="item-photo-urls">photo URLs</label>
        <textarea class="form-control" id="item-photo-urls" rows="5" placeholder="Paste your photo html-embed-codes or paste the image URLs.. Separate them with commas."></textarea>
        <label class="cn-error-label" id="cn-error-label-item-photo-urls"></label>
    </div>

    <!-- tags -->
    <div class="form-group">
        <label for="item-tags">tags</label>
        <textarea class="form-control" id="item-tags" rows="5" placeholder="Separate them with commas."></textarea>
        <label class="cn-error-label" id="cn-error-label-item-tags"></label>
    </div>

    <!-- btns -->
    <div class="form-group">
        <button id="publish-item-btn" class="btn btn-primary">publish</button>
        <button id="update-item-btn" class="btn btn-primary">update</button>
    </div>

    <div class="loader-element-container"></div>

</form>


<!-- <link rel="stylesheet" type="text/css" href="###css/item/create/components/item-details-form.css###"> -->