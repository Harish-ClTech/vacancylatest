<div class="p-0 m-0">
	<div class="row_form">
		<div class="post flex-column-fluid" id="kt_post">
			<!--begin::Container-->
			<div id="kt_content_container" class="col-md-12">
				<!--begin::Card-->
				<div class="card_form">
					<!--begin::Card header-->
					<div class="card-header border-0 pt-6" style="background: transparent;">
						<!--begin::Card toolbar-->
						<div class="card-toolbar">
							<div class="d-flex justify-content-end">

								<button type="button" id="addTrainingDetail"style="background: #3C2784; color: #fff;border: none;padding: 10px 20px;font-weight: 600;border-radius: 3px;" data-toggle="modal"
									data-target="#modal_boxx" class="pull-right">
									<i class="fa fa-plus"></i>
									सिर्जना गर्नुहोस्
								</button>
							</div>
							<!--end::Toolbar-->
						</div>
						<!--end::Card toolbar-->
					</div>
					<!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body py-4">
						<!--begin::Table-->
						<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
							<div class="table-responsive">
								<table class="table-bordered table-striped table-condensed cf" id="trainingDetailTable"
									width="100%">

									<thead class="cf">

										<tr>
											<th>क्रम संख्या </th>
											<th>तालिम प्रदायकको नाम</th>
											<th>तालिमको नाम </th>
											<th>ग्रेड/प्रतिशत </th>
											<th>अवधि देखि </th>
											<th>अवधि सम्म </th>
											<th>Document</th>
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
	<div class="row mx-1">
		<div class="col-md-12">
			@if ((auth()->user()->is_submitted == 0) || (auth()->user()->is_submitted == 1 and auth()->user()->training_enabled == 1))
			<div class="btn_flx">
				{{-- <button class="" type="button" onclick="navigaterTo('education')">Previous</button> --}}
				<button class="" type="button" id="nextTraining" style="float: right">Next</button>
			</div>
			@endif
		</div>
	</div>
</div>





<div id="trainingSetupModal" style="z-index: 99999;" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="trainingSetupModalTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dailog-centered mw-900px" role="document">
		<div class="modal-content rounded">
			<div class="modal-header pb-0 border-0 justify-content-end">
				<button type="button" id="closedmodal" class="close  pull-right" value="trainingSetupModal"
					data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body scroll-y px=10 px-lg-15 pt-0 pb-15" style="padding-bottom: 15px !important;"></div>
			<div class="modal-footer">
				<div class="text-center">
					<button type="button" id="saveTrainingDetails" class="" style=" background-color: #3C2784;color: #fff;border: none;padding: 8px 30px;font-size: 18px;font-weight: 600;border-radius: 3px;
			float: right;">
						<span class="indicator-label"></span>
					</button>

				</div>
			</div>
		</div>
	</div>
</div>

<script>
var trainingDetailTable;
$(document).ready(function() {
	trainingDetailTable = $('#trainingDetailTable').dataTable({
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
		"sAjaxSource": baseUrl + "/gettrainingdetails",
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
				"data": "trainingproviderinstitutionalname"
			},
			{
				"data": "trainingname"
			},
			{
				"data": "gradedivisionpercent"
			},
			{
				"data": "fromdatebs"
			},
			{
				"data": "enddatebs"
			},
			{
				"data": "document"
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

		]
	});
});
</script>
<script>
$(document).ready(function() {
	$(document).off('click', '#addTrainingDetail');
	$(document).on('click', '#addTrainingDetail', function() {
		var url = baseUrl + '/training/form';

		$.post(url, function(response) {
			$('.indicator-label').html('Save');

			$('#trainingSetupModal').modal('show');
			$('#trainingSetupModal .modal-body').html(response);


		})
	});
})

$(document).ready(function() {
	$(document).off('click', '#nextTraining');
	$(document).on('click', '#nextTraining', function() {
		var redirectUrl = 'experience';
		getProfileID();
		gotToTab('#preview');


	});
})


$(document).ready(function() {
	$(document).off('click', '#saveTrainingDetails');
	$(document).on('click', '#saveTrainingDetails', function() {
		$('#trainingDetailsForm').ajaxSubmit({
			dataType: 'json',
			success: function(response) {
				if (response.type == 'success') {
					$('#trainingSetupModal').modal('hide');
					trainingDetailTable.fnDraw();
					$.notify(response.message, 'success');
				} else {
					$.notify(response.message, 'error');



				}
			}
		});
	})
});


$(document).ready(function() {
	$(document).off('click', '.editTrainingDetail');
	$(document).on('click', '.editTrainingDetail', function() {

		var trainingdetailid = $(this).data('trainingdetail');
		var url = baseUrl + '/training/form'
		var infoData = {
			trainingdetailid: trainingdetailid
		}

		$.post(url, infoData, function(response) {
			if (trainingdetailid) {
				$('.indicator-label').html('Update');
			}
			$('#trainingSetupModal').modal('show');
			$('#trainingSetupModal .modal-body').html(response);
		})

	});

})

$(document).off('click', '.deleteTrainingDetail');
$(document).on('click', '.deleteTrainingDetail', function() {
	var trainingdetailid = $(this).data('trainingdetail');
	var url = baseUrl + '/trainingdetails/delete'
	var infoData = {
		trainingdetailid: trainingdetailid
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

					trainingDetailTable.fnDraw();
					$.notify(result.message, 'success');
				} else {
					alert(result.message);
				}
			});
		});

	$('#province').trigger('click');
	$('#districtid').trigger('click');
})
</script>