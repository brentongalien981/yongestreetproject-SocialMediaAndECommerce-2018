<form id="video-details-form" class="col-10">

    <h3>Add Video</h3>

    <div class="form-group">
        <input type="text" class="form-control" id="" aria-describedby="" placeholder="TITLE (max of 256 characters...)">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" id="" aria-describedby="" placeholder="OWNER'S USERNAME (give props to the owner of producer of this video...)">
    </div>

    <div class="form-group">
        <textarea class="form-control" id="" rows="5">EMBED CODE (paste the <embed-code></embed-code> here...)</textarea>
    </div>


    <div class="form-group">
        <textarea class="form-control" id="" rows="5">DESCRIPTION - Type a brief description of your video. Max of 1024 characters...</textarea>
    </div>



    <h3 id="extra-details-title">Extra Details</h3>

    <div class="form-group">
        <textarea class="form-control" id="" rows="5">TAGS - Separate your tags with comma. Max of 1024 characters...</textarea>
    </div>


    <div class="form-group">
        <label for="video-categories-select-control">Categories</label>
        <select multiple class="form-control" id="video-categories-select-control">
            <option id="video-category-option-template" value="0">&lt;select categories for your videos...&gt;</option>
        </select>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="private-video-checkbox">
        <label class="form-check-label" for="private-video-checkbox">Make this video private</label>
    </div>

    <div class="form-group">
        <button id="publish-video-btn" class="btn btn-primary">publish</button>
    </div>

</form>