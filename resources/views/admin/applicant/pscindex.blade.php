@extends('admin.layouts.admin_designs')
@section('siteTitle')
लोक सेवा आयोग रिपोर्ट
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
					<li class="breadcrumb-item text-muted">लोक सेवा आयोग रिपोर्ट</li>
					<!--end::Item-->
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<button class="btn btn-success exportButton text-right"><i class="fa fa-file"></i> Export</button>

		</div>
		<!--end::Container-->
	</div>
	<div class="post d-flex flex-column-fluid" id="kt_post" style="margin-top: 70px;">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6" style="display:none;">
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
							<table class="table-bordered table-striped table-condensed cf" id="pscreport"
								width="100%" style="font-size:12px;">
								<thead class="cf" style="background: #DFE1E5;">
									<tr style="color:#3C2784;font-size:16px">
                                                            <th>S.N.</th>
                                                            <th>Master ID.</th>
                                                            <th>Roll No.</th>
                                                            <th>English Name</th>
                                                            <th>Nepali Name</th>
                                                            <th>Father Name</th>
                                                            <th>Mother Name</th>
                                                            <th>Grand Fathe Name</th>
                                                            <th>Gender</th>
                                                            <th>Full Address</th>
                                                            <th>Designation</th>
                                                            <th>Lavel</th>
                                                            <th>Job Category</th>
                                                            <th>Vacancy Number</th>
                                                            <th>Vacancy Type</th>
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
<script>
var registeredCandidates;
var gender = 'gender';
$(document).ready(function() {
	registeredCandidates = $('#pscreport').dataTable({
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
		"sAjaxSource": baseUrl + "/getpscreport",
		"oLanguage": {
			"sEmptyTable": "<p class='no_data_message'>No data available.</p>"
		},
        "fnServerParams": function (aoData) {
            aoData.push({ "name": "gender", "value":gender})
        },
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0, ]
		}],
		"aoColumns": [{
				"data": "sn"
			},
                  {
				"data": "masterid"
			},
			{
				"data": "symbolnumber"
			},
			{
				"data": "englishfullname"
			},                  
			{
				"data": "nepalifullname"
			},
			{
				"data": "fatherhfullname"
			},
			{
				"data": "motherhfullname"
			},
			{
 				"data": "grandfatherfullname"   
			},	
			{
 				"data": "gender"   
			}, 
			{
 				"data": "fulladdress"   
			},  
			{
 				"data": "designationstitle"   
			},   
			{
 				"data": "labelname"   
			}, 
			{
 				"data": "jobcategory"   
			},   
			{
 				"data": "vacancynumber"   
			},   
			{
 				"data": "isinternalvacancy"   
			},                                                                                                     
		],
	}).columnFilter({
		sPlaceHolder: "head:after",
		aoColumns: [{
				type: "null"
			},
			{
				type: "null"
			},
                  {
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
                  {
				type: "null"
			},                                                                        
			{
				type: "select", values:['Male', 'Female']
			},
                  {
				type: "null"
			},
                  {
				type: "select",values:['व्यवस्थापक','उप-व्यवस्थापक', 'अधिकृत', 'सहायक अधिकृत', 'सहायक कम्प्युटर अधिकृत', 'बरिष्ठ सहायक', 'सहायक', 'सहायक कम्प्युटर अपरेटर']
			},  
                  {
				type: "select",values:['4','5', '6', '7', '8', '9']
			},
                  {
				type: "null"
			},     
                  {
				type: "null"
			},   
                  {
				type: "select",values:['Y','N']
			},                                                                                      
		]
	});


	$(document).off('click', '.exportButton');
	$(document).on('click', '.exportButton', function (e) {
		e.preventDefault();
		var infoData = $.param($('#pscreport').DataTable().ajax.params());
		var url = baseUrl + "/getpscreport",
		infoData = infoData + '&type=excel&isexport=Y';
		window.open(url + '?' + infoData);
	});

});
</script>
@endsection