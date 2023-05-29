@extends('admin.layouts.admin_designs')

@section('siteTitle')
विज्ञापन मिति व्यवस्थापन
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
				<!--begin::Title-->
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">विज्ञापन मिति सेटअप </h1>
				<!--end::Title-->
				<!--begin::Separator-->
				<span class="h-20px border-gray-300 border-start mx-4"></span>
				<!--end::Separator-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1" style="padding: 4px 15px;">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">ड्यासबोर्ड</a>
					</li>
					<li class="breadcrumb-item text-muted">विज्ञापन मिति सूची</li>
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
		</div>
		<!--end::Container-->
	</div>
	<div class="post d-flex flex-column-fluid" id="kt_post" style="margin-top: 40px;">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
						<div class="d-flex justify-content-end">
							<button type="button" id="addVacancyDateSetup" data-toggle="modal" data-target="#modal_boxx"
								class="btn btn-primary pull-right">
								<i class="fa fa-plus"></i>
								थप गर्नुहोस्
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
							<table class="table-bordered table-striped table-condensed cf" id="vacancyDateSetupTable"
								width="100%">

								<thead class="cf">

									<tr>
										<th>क्रम संख्या </th>
										<th>आर्थिक वर्ष</th>
										<th>प्रकाशित मिति</th>
										<th>समाप्ति मिति</th>
										<th>विस्तारित मिति</th>
										<th>फारम भर्न दिने ?</th>
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

<div id="vacancyDateSetupModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="vacancyDateSetupModalTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dailog-centered mw-900px" role="document">
		<div class="modal-content rounded">
			<div class="modal-header pb-0 border-0 justify-content-end">
				<button type="button" id="closedmodal" class="close  pull-right" value="vacancyDateSetupModal"
					data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body scroll-y px=10 px-lg-15 pt-0 pb-15" style="padding: 0px 15px 30px !important;"></div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
var vacancyDateSetupTable;
$(document).ready(function() {
	vacancyDateSetupTable = $('#vacancyDateSetupTable').dataTable({
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
		"sAjaxSource": baseUrl + "/getvacancydatemastserlist",
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
				"data": "fiscalyearname"
			},
			{
				"data": "vacancypublishdate"
			},
			{
				"data": "vacancyenddate"
			},
			{
				"data": "vacancyextendeddate"
			},
			{
				"data": "allow_registration"
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
	$(document).off('click', '#addVacancyDateSetup');
	$(document).on('click', '#addVacancyDateSetup', function() {
		var url = baseUrl + '/vacancydatemastser/form';

		$.post(url, function(response) {
			$('.indicator-label').html('Save');

			$('#vacancyDateSetupModal').modal('show');
			$('#vacancyDateSetupModal .modal-body').html(response);


		})
	});
})




$(document).ready(function() {
	$(document).off('click', '#saveVacancyDate');
	$(document).on('click', '#saveVacancyDate', function() {
		$('#vacancyDateSetupForm').ajaxSubmit({
			dataType: 'json',
			success: function(response) {
				if (response.type == 'success') {
					$('#vacancyDateSetupModal').modal('hide');
					vacancyDateSetupTable.fnDraw();
					$.notify(response.message, 'success');
				} else {
					$.notify(response.message, 'error');
				}
			}
		});
	})
})

$(document).ready(function() {
	$(document).off('click', '.editVacancyDateSetup');
	$(document).on('click', '.editVacancyDateSetup', function() {
		var dataid = $(this).data('vacancydatesetup');
		var url = baseUrl + '/vacancydatemastser/form'
		var infoData = {
			dataid: dataid
		}
		$.post(url, infoData, function(response) {
			if (dataid) {
				$('.indicator-label').html('Update');
			}
			$('#vacancyDateSetupModal').modal('show');
			$('#vacancyDateSetupModal .modal-body').html(response);
		})

	});

})

$(document).off('click', '.deleteVacancyDateSetup');
$(document).on('click', '.deleteVacancyDateSetup', function() {
	var dataid = $(this).data('vacancydatesetup');
	var url = baseUrl + '/vacancydatemastser/delete'
	var infoData = {
		dataid: dataid
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

					vacancyDateSetupTable.fnDraw();
					$.notify(result.message, 'success');
				} else {
					alert(result.message);
				}
			});
		});


});

</script>
@endsection
