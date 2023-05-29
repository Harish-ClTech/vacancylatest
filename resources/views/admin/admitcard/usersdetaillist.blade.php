<style>
  .swal2-icon.swal2-warning {
    size: 20px;
  }
  .swal2-popup.swal2-modal.swal2-icon-warning.swal2-show {
    display: grid;
    width: 460px;
    padding: 0px;
    overflow: hidden;
  }
  .swal2-icon.swal2-warning.swal2-icon-show{
    font-size: 8px;
    display: flex;
  }
  .rows{
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
<div class="btn-group" style="float: right">
  <div class="upload-btn-wrapper">
    <button type="button" class="btn btn-success printAdmit"><i class="fa fa-print"></i>All-Print</button>
    <button type="button" class="btn btn-primary printRange" aria-label="Try me! Example: multiple inputs"><i class="fa fa-print"></i>Print Range </button>  
  </div>
</div>
<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
						<div class="table_form">
							<table class="table-bordered table-striped table-condensed cf" id="admitCardTable"
								width="100%">

								<thead class="cf">
									<tr>
											<th>क्रम संख्या </th>
											<th>नाम</th>
											<th>पद</th>
											<th>Aprove Status</th>
											<th width="10%">Action</th>
									</tr>

								</thead>

								<tbody>

									<tr>

									</tr>
								</tbody>
							</table>
						</div>
					</div>
<script>

  var admitCardTable;
  var yearid= "{{@$post['yearid']}}";
  var levelid= "{{@$post['levelid']}}";
  var designationid= "{{@$post['designationid']}}";
  
  $(document).ready(function() {
    admitCardTable = $('#admitCardTable').dataTable({
      "sPaginationType": "full_numbers",
      "bSearchable": false,
      "lengthMenu": [
        [10, 30, 50, 70, 90, -1],
        [10, 30, 50, 70, 90, "All"]
      ],
      'iDisplayLength': 10,
      "sDom": 'ltipr',
      "bAutoWidth": false,
      "aaSorting": [
        [0, 'desc']
      ],
      // "bSort": false,
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": baseUrl + "/admit-card/getapplicant",
      "oLanguage": {
        "sEmptyTable": "<p class='no_data_message'>No data available.</p>"
      },
          "fnServerParams": function (aoData) {
            aoData.push({ "name": "yearid", "value":yearid},
                          {"name": "levelid", "value":levelid},
                          {"name": "designationid", "value":designationid});
          },
      "aoColumnDefs": [{
        "bSortable": false,
        "aTargets": [0, ]
      }],
      "aoColumns": [{
          "data": "sn"
        },
        {
          "data": "fullname"
        },
        {
          "data": "designation"
        },
        {
          "data": "appliedstatus"
        },
        {
          "data": "action"
        },
      ],
    }).columnFilter({
      sPlaceHolder: "head:after",
      aoColumns: [{
          type: "null"
        },
        {
          type: "text"
        },
        {
          type: "null"
        },
        {
          type: "null"
        },
        {
          type: "null"
        },
  
  
      ]
    });

    $('.printRange').on('click', function(){
      (async () => {
          const { value: formValues } = await Swal.fire({
          title: 'प्रवेश पत्र प्रिन्ट गर्न रोलनम्बर कति देखि कति सम्म प्रिन्ट गर्ने ?',
          icon: 'warning',
          confirmButtonText: '<i class="fa fa-print"></i> &nbsp; प्रिन्ट गर्नुहोस',
          html:
            '<div class="rows">\
              <div class="col-md-6">\
                <label>रोलनम्बर ..... देखि</label>\
                <input id="symbol_number_from" class="form-control" placeholder="Symbol Number From">\
              </div>\
              <div class="col-md-6">\
                <label>रोलनम्बर ..... सम्म</label>\
                <input id="symbol_number_to" class="form-control" placeholder="Symbol Number To">\
              </div>\
            </div>',
          focusConfirm: false,
          preConfirm: () => {
            return [
              document.getElementById('symbol_number_from').value,
              document.getElementById('symbol_number_to').value
            ]
          }
        })

        if (formValues) {
          $('#loading').show();
          var designationid = $('#designation').val();
          var url = baseUrl + '/admit-card/print';
          var symbol_no_from = formValues[0];
          var symbol_no_to = formValues[1];
          if(!symbol_no_from || !symbol_no_to){
            Swal.fire({
              title: 'माफ गर्नुहोला !',
              // icon: 'warning',
              text: 'रोलनम्बरको रेन्ज प्रविष्ट गर्नुहोस् ।',
              width:320,
              padding:0,
              margin:0,
            });
            return false;
          }
          window.open(url + "?designationid=" + designationid+"&symbol_from="+ symbol_no_from+"&symbol_to="+symbol_no_to);             
        }
      
      })()
    });

  });

</script>

