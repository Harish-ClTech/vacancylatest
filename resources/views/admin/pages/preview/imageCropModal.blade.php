<div class="modal-header">
    <h5 class="modal-title" id="modalLabel">Image Crop & Rotate </h5>
    <button type="button" class="close" aria-label="Close">
    <span aria-hidden="true" class='closeButton'>×</span>
    </button>
</div>
<div class="modal-body">
    <div class="img-container">
        <div class="row">
            <div class="col-md-7">
                <img id="image">
            </div>
            <div class="col-md-5">
                <div class="row" id="side">
                    <div class="col-md-12">
                        <div class="preview" id="crop-preview"></div>
                    </div>
                    <div class="col-md-6">
                        <label>Width</label>
                        <input type="text" class="form-control" id="image-width">
                    </div>
                    <div class="col-md-6">
                        <label>Height</label>
                        <input type="text" class="form-control" id="image-height">
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary" id="rotate-left" title="Rotate 45 deg. Left"><i class="fa fa-undo"></i></button>
                        <button class="btn btn-primary" id="rotate-right" title="Rotate 45 deg. Right"><i class="fa fa-redo"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-primary" id="updateImage"><i class="fa fa-edit"></i> Update Image</button>
</div>

<script>
   
</script>

  