@extends('admin.layouts.admin_designs')

@section('siteTitle')
दर्ता भएका उम्मेदवार
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
					<li class="breadcrumb-item text-muted">दर्ता भएका उम्मेदवारहरुको सूची</li>
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
							<table class="table-bordered table-striped table-condensed cf" id="registeredCandidatesTable"
								width="100%">

								<thead class="cf" style="background: #DFE1E5;">
									<tr style="color:#3C2784;font-size:16px">
                                        <th>क्रम संख्या </th>
                                        <th>नाम</th>
                                        <th>लिङ्ग</th>
                                        <th>संपर्क नम्बर</th>
                                        <th>इ-मेल ठेगाना</th>
                                        <th>Registered Date & Time</th>
					<th width="10%">Vacancy</th>

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

<div class="modal fade" id="vacancydetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
 aria-hidden="true">
 <div class="modal-dialog modal-xl" style="margin: 90px auto;" role="document">
	 <div class="modal-content">
		 <div class="modal-header border-0">
			 <h5 class="modal-title" id="exampleModalLongTitle"></h5>
			 <button type="button" id="closedmodal" class="close  pull-right" value="vacancydetailModal"
				 data-dismiss="modal">&times;</button>
		 </div>
		 <div class="modal-body" id="vacancydetails">
		 </div>
	 </div>
 </div>
</div>

@endsection

@section('scripts')

<script>
var registeredCandidates;
var gender = 'gender';
$(document).ready(function() {
	registeredCandidates = $('#registeredCandidatesTable').dataTable({
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
		"sAjaxSource": baseUrl + "/getregisteredcandidatesdetails",
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
				"data": "fullname"
			},
			{
				"data": "gender"
			},
			{
				"data": "contactnumber"
			},
			{
				"data": "email"
			},
			{
				"data": "registereddate"
			},
			{
 				"data": "vacancy"   
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
				type: "select", values:['Male', 'Female']
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
				type : "null"    
			},
		]
	});
});
</script>

<script>
	$(document).ready(function() {
		$(document).off('change', '#jobapply');
		$(document).on('change', '#jobapply', function() {
			servicegroupid = $(this).find('option:selected').data("serviceid");
			designationid = $(this).find('option:selected').data("designationid");
			academicid = $(this).find('option:selected').data("academicid");
			advertPop(designationid, servicegroupid, academicid);
		});
	});
</script>

<script>
	function advertPop(designationid, servicesgroupid, academicid) {
		$("#vacancydetails").html()
		var data = {
			designationid: designationid,
			servicesgroupid: servicesgroupid,
			academicid: academicid,
			userid: $("#jobapply").val()
		};
		var url = "{{ route('modifyApplication') }}";
		$.ajax({
			type: 'POST',
			url: url,
			data: data,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response) {
				$("#vacancydetails").html(response)
				$("#vacancydetailModal").modal('show');
			}
		});

	}
</script>


@endsection
