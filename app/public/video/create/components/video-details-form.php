<form id="video-details-form" class="col-10">

    <h3>Add Video</h3>

    <div class="form-group">
        <input type="text" class="form-control" id="video-title" aria-describedby="" placeholder="TITLE (max of 256 characters...)">
        <label class="cn-error-label" id="cn-error-label-video-title"></label>
    </div>

    <div class="form-group">
        <input type="text" class="form-control" id="video-owner-user-name" aria-describedby="" placeholder="OWNER'S USERNAME (give props to the owner of producer of this video...)">
        <label class="cn-error-label" id="cn-error-label-video-owner-user-name"></label>
    </div>

    <div class="form-group">
        <textarea class="form-control" id="video-embed-code" placeholder="EMBED CODE (paste the <embed-code></embed-code> here...)"
            rows="5"></textarea>
        <label class="cn-error-label" id="cn-error-label-video-embed-code"></label>
    </div>


    <div class="form-group">
        <textarea class="form-control" id="video-description" placeholder="DESCRIPTION - Type a brief description of your video. Max of 1024 characters..."
            rows="5"></textarea>
        <label class="cn-error-label" id="cn-error-label-video-description"></label>
    </div>



    <h3 id="extra-details-title">Extra Details</h3>

    <div class="form-group">
        <textarea class="form-control" id="video-tags" placeholder="TAGS - Separate your tags with comma. Max of 1024 characters..."
            rows="5"></textarea>
            <label class="cn-error-label" id="cn-error-label-video-tags"></label>
    </div>


    <div class="form-group">
        <label for="video-categories-select-control">Categories</label>
        <select multiple class="form-control" id="video-categories-select-control">
            <option id="video-category-option-template" value="0">&lt;select categories for your videos...&gt;</option>
        </select>
        <label class="cn-error-label" id="cn-error-label-video-categories-select-control"></label>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="private-video-checkbox">
        <label class="form-check-label" for="private-video-checkbox">Make this video private</label>
    </div>

    <div class="form-group">
        <button id="publish-video-btn" class="btn btn-primary">publish</button>
    </div>

    <div class="loader-element-container"></div>

</form>