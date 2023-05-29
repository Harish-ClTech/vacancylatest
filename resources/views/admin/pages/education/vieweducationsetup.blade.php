
<div class="post flex-column-fluid col-md-12" id="kt_post">
	<!--begin::Container-->
	<div id="kt_content_container" class="">
		<!--begin::Card-->
		<div class="card_form">
			<!--begin::Card body-->
			<div class="card-body py-4">
				<!--begin::Table-->
				<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
					<div class="table-responsive">
						<div class="d-flex justify-content-end">
							<button type="button" id="addEducationSetup" style="background: #3C2784; color: #fff;border: none;padding: 10px 20px;font-weight: 600;border-radius: 3px;" data-toggle="modal" data-target="#modal_boxx" class=" pull-right">
								<i class="fa fa-plus"></i> सिर्जना गर्नुहोस्
							</button>
						</div>
						<table class="table-bordered table-striped table-condensed cf" id="educationDetailsTable" width="100%">
							<thead class="cf">
								<tr>
									<th>क्रम संख्या </th>
									<th>विश्वविद्यालय / बोर्ड नाम </th>
									<th>शैक्षिक उपाधि</th>
									<th>शैक्षिक संकाय</th>
									<th>श्रेणि /ग्रेड /प्रतिशत</th>
									<th>प्रमुख विषय</th>
									<th>पास गरेको साल(B.S)</th>
									<th>Uploaded Document</th>
									<th>Equivalent</th>
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
				<!--end::Table-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
	</div>
	<!--end::Container-->
</div>
</div>

<div id="educationSetupModal" style="z-index: 9999999;" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="educationSetupModalTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dailog-centered mw-900px" role="document">
		<div class="modal-content rounded">
			<div class="modal-header pb-0 border-0 justify-content-end">
				<button type="button" id="closedmodal" class="close  pull-right" value="educationSetupModal"
					data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body scroll-y px=10 px-lg-15 pt-0 pb-15" style="padding-bottom: 0px !important;"></div>
			<div class="modal-footer">
				<div class="text-center">
					<button type="button" id="saveEducationSetup" class="" style=" background-color: #3C2784;color: #fff;border: none;padding: 8px 30px;font-size: 18px;font-weight: 600;border-radius: 3px;
			float: right;">
						<span class="indicator-label"></span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12 ">

	<?php if(empty($verifydoctdetails)){?>
	@if ((auth()->user()->is_submitted == 0) || (auth()->user()->is_submitted == 1 and auth()->user()->education_enabled == 1))
	<div class="btn_flx" style="display: flex; justify-content: end; margin-top: 30px;">
		{{-- <button class="" type="button" onclick="navigaterTo('contactdetailForm')" style=" background-color: #03c75e;color: #fff;border: none;padding: 8px 30px;font-size: 18px;font-weight: 600;border-radius: 3px;">Previous</button> --}}

		<button class="" type="button" id="nextEducation" style=" background-color: #1472d0;color: #fff;border: none;padding: 8px 30px;font-size: 18px;font-weight: 600;border-radius: 3px; float: right;">Next</button>
	</div>
	@endif
	<?php } ?>

</div>
<script>
var educationDetailsTable;
$(document).ready(function() {
	educationDetailsTable = $('#educationDetailsTable').dataTable({
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
		"sAjaxSource": baseUrl + "/geteducationdetails",
		"oLanguage": {
			"sEmptyTable": "<p class='no_data_message'>No data available.</p>"
		},
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0, ]
		}],
		"aoColumns": [{
				"data": "sn"
			},
			{
				"data": "universityboardname"
			},
			{
				"data": "educationlevel"
			},
			{
				"data": "educationfaculty"
			},
			{
				"data": "devisiongradepercentage"
			},
			{
				"data": "mejorsubject"
			},
			{
				"data": "passoutdatead"
			},
			{
				"data": "academicdocument"
			},
			{
				"data": "equivalentdocument"
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
});
</script>

<script>
$(document).ready(function() {
	$(document).off('click', '#nextEducation');
	$(document).on('click', '#nextEducation', function() {
		var redirectUrl = 'training';
		getProfileID();
		gotToTab('#experience');


	});
})

$(document).ready(function() {
	$(document).off('click', '#addEducationSetup');
	$(document).on('click', '#addEducationSetup', function() {
		var educationdetailid = $('#educationdetail').data('educationdetail')

		var url = baseUrl + '/education/form';
		$.post(url, function(response) {
			$('.indicator-label').html('Save');

			$('#educationSetupModal').modal('show');
			$('#educationSetupModal .modal-body').html(response);


		})
	});
})




$(document).ready(function() {
	$(document).off('click', '#saveEducationSetup');
	$(document).on('click', '#saveEducationSetup', function() {
		$('#educationSetupForm').ajaxSubmit({
			dataType: 'json',
			success: function(response) {
				if (response.type == 'success') {
					$('#educationSetupModal').modal('hide');
					educationDetailsTable.fnDraw();
					$.notify(response.message, 'success');
				} else {
					$.notify(response.message, 'error');



				}
			}
		});
	})
})

$(document).ready(function() {
	$(document).off('click', '.editEducationSetup');
	$(document).on('click', '.editEducationSetup', function() {

		var educationdetailid = $(this).data('educationdetail');
		var url = baseUrl + '/education/form';
		var infoData = {

			educationdetailid: educationdetailid
		}

		$.post(url, infoData, function(response) {
			if (educationdetailid) {
				$('.indicator-label').html('Update');
			}
			$('#educationSetupModal').modal('show');
			$('#educationSetupModal .modal-body').html(response);
		})

	});

})

$(document).off('click', '.deleteEducationDetail');
$(document).on('click', '.deleteEducationDetail', function() {
	var educationdetailid = $(this).data('educationdetail');

	var url = baseUrl + '/educationdetails/delete'
	var infoData = {
		educationdetailid: educationdetailid
	}
	swal({
			title: "के तपाई यो रेकर्ड हटाउन चाहनुहुन्छ ? ",
			text: "तपाइँ यो रेकर्ड पुन: प्राप्त गर्न सक्नुहुने छैन |",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "होइन",
			confirmButtonClass: "btn-danger",
			confirmButtonText: "हो"
		},

		function() {

			$.post(url, infoData, function(response) {
				var result = JSON.parse(response);
				if (result.type == 'success') {
					educationDetailsTable.fnDraw();
					$.notify(result.message, 'success');
				} else {
					alert(result.message);
				}
			});
		});


});
</script>
