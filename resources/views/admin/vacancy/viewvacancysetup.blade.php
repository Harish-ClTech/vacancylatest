<style>
	#ndp-nepali-box{
		z-index: 999999;
	}
</style>

@extends('admin.layouts.admin_designs')

@section('siteTitle')
विज्ञापन
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Toolbar-->
	<div class="toolbar" id="kt_toolbar" style="padding-top: 0px; background-color: #fff;">
		<!--begin::Container-->
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<!--begin::Page title-->
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend"
				data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
				class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1" style="padding: 4px 15px;">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">ड्यासबोर्ड</a>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">विज्ञापन सेटअप सूची</li>
					<!--end::Item-->
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
		</div>
		<!--end::Container-->
	</div>
	<div class="post d-flex flex-column-fluid" id="kt_post" style="margin-top: 70px;">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6 justify-content-end">
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
						<div class="d-flex ">
							<button type="button" id="addvacancySetup" data-toggle="modal" data-target="#modal_boxx"
								class="pull-right" style="    background: #3C2784;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-weight: 600;
    border-radius: 3px;
    float: right;">
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
						<div class="table_form">
							<table class="table-bordered table-striped table-condensed cf" id="vacancySetupTable"
								width="100%">

								<thead class="cf" style="background-color: #dfe1e5;">

									<tr style="color: #3C2784;font-size: 16px;">
										<th>क्रम संख्या </th>
										<th>विज्ञापन नं</th>
										<th>स्तर</th>
										<th>पद</th>
										<th>आ.प्र</th>
										<th>योग्यता</th>
										<th>सेवा÷समूह</th>
										<th>विज्ञापन वर्ग</th>
										<th>विज्ञापन दर</th>
										<th>विज्ञापन संख्या</th>
										<th>प्रकाशित मिति</th>
										<th>समाप्ति मिति</th>
										<th>विस्तारित मिति</th>
										<th>विज्ञापन स्थिति</th>
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

<div id="vacancySetupModal" style="z-index:9999;" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="vacancySetupModalTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dailog-centered mw-900px" role="document" style="margin-top: 50px;">
		<div class="modal-content rounded">
			<div class="modal-header pb-0 border-0 justify-content-end">
				<button type="button" id="closedmodal" class="close  pull-right" value="vacancySetupModal"
					data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body scroll-y px=10 px-lg-15 pt-0 pb-15" style="padding: 0px 15px 30px !important;"></div>
			<div class="modal-footer" style="border-top: 0px;">
				<div class="text-center">
					<button type="button" id="saveVacancySetups" class="" style="background: #3C2784;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-weight: 600;
    border-radius: 3px;
	float: right;">
						<span class="indicator-label"></span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
var vacancySetupTable;
$(document).ready(function() {
	vacancySetupTable = $('#vacancySetupTable').dataTable({
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
		"sAjaxSource": baseUrl + "/getvancacysetuplist",
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
				"data": "vacancynumber"
			},
			{
				"data": "level"
			},
			{
				"data": "designation"
			},
			{
				"data": "isinternalvacancy"
			},
			{
				"data": "qualification"
			},
			{
				"data": "servicesgroup"
			},
			{
				"data": "jobcategory"
			},
			{
				"data": "vacancyrate"
			}, {
				"data": "numberofvacancy"
			},
			{
				"data": "vacancypublishdate"
			},
			{
				"data": "vacancyenddate"
			},
			{
				"data": "extendeddate"
			},
			{
				"data": "jobstatus"
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

		]
	});
});
</script>

<script>
$(document).ready(function() {
	$(document).off('click', '#addvacancySetup');
	$(document).on('click', '#addvacancySetup', function() {
		var url = baseUrl + '/vancacysetup/form';

		$.post(url, function(response) {
			$('.indicator-label').html('<i class="fa-solid fa-floppy-disk"></i> &nbsp; सेभ');

			$('#vacancySetupModal').modal('show');
			$('#vacancySetupModal .modal-body').html(response);


		})
	});
})




$(document).ready(function() {
	$(document).off('click', '#saveVacancySetups');
	$(document).on('click', '#saveVacancySetups', function() {
		$('#vacancySetupForm').ajaxSubmit({
			dataType: 'json',
			success: function(response) {
				if (response.type == 'success') {
					$('#vacancySetupModal').modal('hide');
					vacancySetupTable.fnDraw();
					$.notify(response.message, 'success');
				} else {
					$.notify(response.message, 'error');



				}
			}
		});
	})
})

$(document).ready(function() {
	$(document).off('click', '.editVacancySetup');
	$(document).on('click', '.editVacancySetup', function() {

		var vacancysetupid = $(this).data('vacancysetup');
		var url = baseUrl + '/vancacysetup/form'
		var infoData = {
			vacancysetupid: vacancysetupid
		}

		$.post(url, infoData, function(response) {
			if (vacancysetupid) {
				$('.indicator-label').html('Update');
			}
			$('#vacancySetupModal').modal('show');
			$('#vacancySetupModal .modal-body').html(response);
		})

	});

})

$(document).off('click', '.deleteVacancySetup');
$(document).on('click', '.deleteVacancySetup', function() {
	var vacancysetupid = $(this).data('vacancysetup');
	var url = baseUrl + '/vancacysetup/delete'
	var infoData = {
		vacancysetupid: vacancysetupid
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

					vacancySetupTable.fnDraw();
					$.notify(result.message, 'success');
				} else {
					alert(result.message);
				}
			});
		});


});
</script>
@endsection