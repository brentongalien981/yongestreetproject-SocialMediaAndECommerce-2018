<!-- Modal -->
<div class="modal fade" id="my-photo-update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="my-photo-update-modal-header-title">Update Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>



            <div class="modal-body">

                <form id="my-photo-update-form">

                    <input type="hidden" id="my-photo-update-photo-id" value="">

                    <div class="form-group">
                        <label for="my-photo-update-photo-title-input">Photo Title</label>
                        <label class="error_msg" id="error_my_photo_update_photo_title"></label>
                        <input type="text" class="form-control" id="my-photo-update-photo-title-input" aria-describedby="" placeholder="Enter new title for your photo">
                        <small class="form-text text-muted">
                            Your photo's title must be 4-255 characters long.
                        </small>
                    </div>


                    <div class="form-group">
                        <label for="my-photo-update-embed-code-input">Photo Embed Code</label>
                        <label class="error_msg" id="error_my_photo_update_embed_code"></label>
                        <textarea
                            class="form-control"
                            id="my-photo-update-embed-code-input"
                            aria-describedby=""
                            placeholder="Enter new embed code for your photo">
                        </textarea>
                        <small class="form-text text-muted">
                            Your photo's embed code must be less than 2048 characters long.
                        </small>
                    </div>



                </form>

            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button id="update-my-photo-btn" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>

        <div class="loader-container"></div>
    </div>
</div>