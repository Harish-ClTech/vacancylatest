@extends('admin.layouts.admin_designs')

@section('siteTitle')
खल्ती
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
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1" style="color:#3C2784!important;font-weight:600!important;">खल्ती </h1>
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
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-300 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">खल्ती सूची</li>
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
				<div class="card-header border-0 pt-6">
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
					</div>
					<!--end::Card toolbar-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body py-4">
					<!--begin::Table-->
					<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
						<div class="table_form">
							<table class="table-bordered table-striped table-condensed cf" id="esewaTable"
								width="100%">

								<thead class="cf" style="background: #DFE1E5;">
									<tr style="color:#3C2784;font-size:16px;">
                                        <th>S.No.</th>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                        <th>Purchased Date & Time</th>
                                        <th>Status</th>
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

<div id="perviewSetupModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="perviewSetupModalTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dailog-centered mw-900px" role="document">
		<div class="modal-content rounded">
			<div class="modal-header pb-0 border-0 justify-content-end">
				<button type="button" id="closedmodal" class="close  pull-right" value="perviewSetupModal"
					data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body scroll-y px=10 px-lg-15 pt-0 pb-15" style="padding: 0px 15px 30px !important;">
				</div>
				<div class="col-md-6 " style="margin-left:40px;">
					<textarea type="text" class="form-control form-control-solid" placeholder="remarks" value="" name="remarks" id="remarks" ></textarea>
				</div>
			<div class="modal-footer" style="border-top: 0px;">
				<div class="text-center">
					<button type="button" value="" class="btn btn-success saveperviewSetups" data-status='Verified'>
						<span class="indicator-label">Accept</span>
					</button>
                    <button type="button"  value="" class="btn btn-primary saveperviewSetups" data-status='Incomplete'>
						<span class="indicator-label">Incomplete</span>
					</button>
					<button type="button"  value="" class="btn btn-danger saveperviewSetups" data-status='Rejected'>
						<span class="indicator-label">Reject</span>
					</button>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection

@section('scripts')

<script>
var registeredCandidates;
var status = 'status';
$(document).ready(function() {
	registeredCandidates = $('#esewaTable').dataTable({
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
		"sAjaxSource": baseUrl + "/getKhaltiDetails",
		"oLanguage": {
			"sEmptyTable": "<p class='no_data_message'>No data available.</p>"
		},
        "fnServerParams": function (aoData) {
            aoData.push({ "name": "status", "value":status})
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
				"data": "contactnumber"
			},
			{
				"data": "transactionid"
			},
			{
				"data": "amount"
			},
            {
				"data": "posteddatetime"
			},
			{
				"data": "status"
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
				type: "text"
			},
			{
				type: "text"
			},
            {
				type: "text"
			},
			{
				type: "select", values:['P','Y','F']
			},
		]
	});
});
</script>

@endsection

