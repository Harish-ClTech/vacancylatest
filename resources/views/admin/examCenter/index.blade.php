@extends('admin.layouts.admin_designs')

@section('siteTitle')
परिक्षा केन्द्र
@endsection
<style>
	.modal-dialog.modal-xl {
		max-width: 95%;
	}
</style>
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
					<li class="breadcrumb-item text-muted">परिक्षा केन्द्र सूची</li>
					<!--end::Item-->
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
		</div>
		<!--end::Container-->
	</div>
	<div class="post d-flex flex-column-fluid" id="kt_post" style="margin-top: 70px !important;">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6  justify-content-end">
					<!--begin::Card toolbar-->
					<div class="card-toolbar ">
						<div class="d-flex">

							<button type="button" id="addExamCenterBtn" data-toggle="modal" style="background: #3C2784;color:#fff;border: none;padding: 10px 20px;font-weight: 600;border-radius: 3px;float: right;" class="pull-right">
								<i class="fa fa-plus"></i> सिर्जना गर्नुहोस्
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
							<table class="table-bordered table-striped table-condensed cf" id="examCenterTable" width="100%">
								<thead class="cf" style="background: #DFE1E5;">
									<tr style="color:#3C2784;font-size:16px;">
										<th>क्रम संख्या </th>
										<th>परिक्षा केन्द्रको नाम</th>
										<th>ठेगाना</th>
										<th>स्थिति</th>
										<th width="12%">Action</th>
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

<div id="examCenterModal" style="z-index: 99999;" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="examCenterModalTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dailog-centered mw-900px" role="document">
		<div class="modal-content rounded">
			<div class="modal-header pb-0 border-0 justify-content-end">
				<h4 class="modal-title"></h4>
				<button type="button" id="closedmodal" class="close  pull-right" value="examCenterModal" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body scroll-y px=10 px-lg-15 pt-0 pb-15" style="padding: 0px 15px 30px !important;"></div>
			<div class="modal-footer" style="border-top: 0px;">
				<div class="text-center">
					<button type="button" id="saveExamCenterBtn" class="" style="background: #3C2784;color: #fff;border: none;padding: 10px 20px;font-weight: 600;border-radius: 3px;float: right;">
						<span class="indicator-label"></span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="assignModal" class="modal fade" style="z-index: 99999;" role="dialog" tabindex="-1" aria-labelledby="assignModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content rounded">
			<div class="modal-header pb-0 border-0 justify-content-end">
				<h4 class="modal-title title"></h4>
				<button type="button" id="closedmodal" class="close  pull-right" value="assignModal" data-bs-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body scroll-y px=10 px-lg-15 pt-0 pb-15" style="padding: 0px 15px 30px !important;"></div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
	<script>
		var examCenterTable;
		$(document).ready(function() {
			examCenterTable = $('#examCenterTable').dataTable({
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
				"sAjaxSource": baseUrl + "/setup/getexamcenterlist",
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
						"data": "examcentername"
					},
					{
						"data": "address"
					},
					{
						"data": "status"
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

				]
			});
			$(document).off('click', '#addExamCenterBtn');
			$(document).on('click', '#addExamCenterBtn', function() {
				var url = baseUrl + '/setup/examcenter/form';

				$.post(url, function(response) {
					$('.indicator-label').html('<i class="fa fa-save"></i> सेभ गर्नुहोस्');
					$('#examCenterModal').modal('show');
					$('#examCenterModal .modal-body').html(response);
				})
			});

			$(document).off('click', '#saveExamCenterBtn');
			$(document).on('click', '#saveExamCenterBtn', function() {
				$('#examCenterForm').ajaxSubmit({
					dataType: 'json',
					success: function(response) {
						if (response.type == 'success') {
							$('#examCenterModal').modal('hide'); examCenterTable.fnDraw();
							$.notify(response.message, 'success');
						} else {
							$.notify(response.message, 'error');
						}
					}
				});
			});
		
			$(document).off('click', '.editExamCenter');
			$(document).on('click', '.editExamCenter', function() {
				var examcenterid = $(this).data('data');
				var url = baseUrl + '/setup/examcenter/form'
				var infoData = {
					examcenterid: examcenterid
				}

				$.post(url, infoData, function(response) {
					if (examcenterid) {
						$('.indicator-label').html('<i class="fa fa-edit"></i> अपडेट गर्नुहोस् ');
					}
					$('#examCenterModal').modal('show');
					$('#examCenterModal .modal-body').html(response);
				})
			});

			$(document).off('click', '.deleteExamCenter');
			$(document).on('click', '.deleteExamCenter', function() {
				var examcenterid = $(this).data('data');
				var url = baseUrl + '/setup/examcenter/delete'
				var infoData = {
					examcenterid: examcenterid
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
								examCenterTable.fnDraw();
								$.notify(result.message, 'success');
							} else {
								$.notify(result.message, 'error');
							}
						});
					});
			});
		

			//to open examcenter assign form
			$(document).off('click', '.assignExamCenter');
			$(document).on('click', '.assignExamCenter', function() {
				var url = baseUrl + '/setup/examcenter/assignform';
				var name = $(this).data('name');
				var address = $(this).data('address');
				var examcenterid = $(this).data('data');
				var data = {examcenterid:examcenterid};
				$.post(url, data, function(response) {
					$('.indicator-label').html('<i class="fa fa-save"></i> तोक्नुहोस्');
					$('#assignModal').modal('show');
					$('#assignModal .modal-title').html('परिक्षाकेन्द्रको नाम : <span class="titlevalue">' +name+ ',</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ठेगाना : <span class="titlevalue">' +address+ '</span>');
					$('#assignModal .modal-body').html(response);
				});
			});

			//to  assign examcenter, this updates symbol_number_manages table
			$(document).off('click', '#assignExamCenterBtn');
			$(document).on('click', '#assignExamCenterBtn', function(e) {
				e.preventDefault();
				if ($('#examCenterAssignForm').valid()) {
					$('#examCenterAssignForm').ajaxSubmit({
						dataType: 'json',
						success: function(response) {
							if (response.type == 'success') {
								getExamCenterData();
								$.notify(response.message, 'success');
							} else {
								$.notify(response.message, 'error');
							}
						}
					});
				}
			});
		});
	</script>
@endsection