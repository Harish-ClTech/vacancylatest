<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLongTitle">आवेदन अस्वीकृत गर्ने फारम</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form id="cancelApplicationForm" method="post" action="{{route('storeRemarksToCancelApplication')}}">
    @csrf
    <input type="hidden" name="jobapplydetailid" value="{{@$applydetailid}}">
    <input type="hidden" name="userid" value="{{@$userid}}">
    <input type="hidden" name="designation" value="{{@$designation}}">
    <input type="hidden" name="jobcategoryname" value="{{@$jobcategoryname}}">
    <div class="form-group">
      <label for="vacancycanceledremarks" class="col-form-label">अस्वीकृत गर्न टिप्पणी लेख्नुहोस <code>*</code>:</label>
      <input type="text" class="form-control" name="vacancycanceledremarks" id="vacancycanceledremarks">
    </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary cancelBtn" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> &nbsp; बन्द गर्नुहोस</button>
  <a href="javascript:;" title="Save Remarks" type="button" class="btn btn-primary saveRemarksButton"><i class="fa-solid fa-floppy-disk"></i>&nbsp; सेभ गर्नुहोस</a>
</div>
</form>

  <script>
      // click Save button
      $('.saveRemarksButton').on('click', function() {
          $('#cancelApplicationForm').ajaxSubmit({
              success: function (response) {
                  var result = JSON.parse(response);
                  if (result.type == 'success') {
                    toastr.success(result.message);
                    $('#cancelApplicationForm').trigger('reset');
                    $('.cancelBtn').trigger('click');
                  }else{
                    toastr.error(result.message);

                  }
              }
          });
      });
  </script>
