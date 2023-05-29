@extends('admin.layouts.admin_designs')

@section('siteTitle')
विवरण परिवर्तनका लागि गरिएको अनुरोध
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
				{{-- <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1" style="color:#3C2784!important;font-weight:600!important;">विवरण परिवर्तनका लागि गरिएको अनुरोध  </h1> --}}
				<!--end::Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1" style="padding: 4px 15px;">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">ड्यासबोर्ड</a>
					</li>
					<!--end::Item--> 
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">विवरण परिवर्तनका लागि गरिएको अनुरोध</li>
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
							<table class="table-bordered table-striped table-condensed cf" id="accesslogstable"
								width="100%">

								<thead class="cf" style="background:#DFE1E5;">

									<tr style="color:#3C2784">
                                        <th>SN.No.</th>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>Sender</th>
                                        <th>Message</th>
                                        <th>Log Status</th>
                                        <th>Module Name</th>
                                        <th>Date</th>
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
@endsection
@section('scripts')

@section('scripts')
<script>
var accesslogstable;
var sendby = 'sendby';
var logstatus = 'logstatus';
var modulename = 'modulename';
var taskstatus = 'taskstatus';
$(document).ready(function() {
	accesslogstable = $('#accesslogstable').dataTable({
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
		"sAjaxSource": baseUrl + "/getAccesslogs",
		"oLanguage": {
			"sEmptyTable": "<p class='no_data_message'>No data available.</p>"
		},
        "fnServerParams": function (aoData) {
            aoData.push({ "name": "sendby", "value":sendby},
                        { "name": "logstatus", "value":logstatus},
                        { "name": "modulename", "value":modulename},
                        { "name": "taskstatus", "value":taskstatus})
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
				"data": "sendby"
			},
			{
				"data": "message"
			},
			{
				"data": "logstatus"
			},
			{
				"data": "modulename"
			},
			{
				"data": "createdatetime"
			},
			{
				"data": "taskstatus"
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
				type: "select", values:['User', 'Admin']
			},
			{
				type: "text"
			},
			{
				type: "select", values:['Request', 'Allow', 'Completed']
			},
			{
				type: "select", values:['Personal', 'Others', 'Contact', 'Education', 'Training', 'Experiences', 'Document']
			},
			{
				type: "text"
			},
			{
				type: "select", values:['Pending', 'Completed']
			},
		]
	});

    $(document).off('change', '.taskStatus');
    $(document).on('change', '.taskStatus', function () {
        var logid = $(this).data('logid');
		var currentStatus = $(this).val();
        $.ajax({
            url : '{{ route('changelogqueue') }}',
            type : 'POST',
            data : {logid:logid,currentStatus:currentStatus},
            success : function (response) {
                var data = JSON.parse(response);
                if (data.type == 'success') {
                    toastr.success(data.message);
                    accesslogstable.fnDraw();
                }  else if (data.type == 'error') {
                    toastr.error(data.message);
                }
            }
        });
    });
});
</script>
@endsection
