@extends('admin.layouts.admin_designs')

@section('siteTitle')
आवेदनहरू
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
				<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1" style="padding: 4px 15px;">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">ड्यासबोर्ड</a>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">आवेदनहरुको सूची</li>
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
							<table class="table-bordered table-striped table-condensed cf" id="applicantDetailTable"
								width="100%">

								<thead class="cf" style="background-color: #dfe1e5;">
									<tr style="color: #3C2784;font-size: 16px;">
										<th>क्रम संख्या </th>
										<th>दर्ता नं.</th>
										<th>आवेदन मिति</th>
										<th>रसिद नं.</th>
										<th>नाम</th>
										<th>रकम</th>
										<th>भुक्तानी स्रोत</th>
										<th>संपर्क नम्बर</th>
										<th>पद</th>
										<th>तह</th>
										<th>Aprove Status</th>
										<th>लिङ्ग</th>
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

<div id="perviewSetupModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="perviewSetupModalTitle" style="z-index:9999;" aria-hidden="true">
	<div class="modal-dialog modal-dailog-centered mw-900px" role="document">
		<div class="modal-content rounded" style="margin-top: 70px !important;">
			<div class="modal-header pb-0 border-0 justify-content-end">
				<button type="button" id="closedmodal" class="close  pull-right" value="perviewSetupModal"
					data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body scroll-y px=10 px-lg-15 pt-0 pb-15" style="padding: 0px 15px 30px !important;">
                <!-- preview -->
			</div>

			<div class="modal-footer" style="border-top: 0px;">
				<div class="text-center statusaction">
					<button type="button" id="isaccessaccept"  value="" data-designationid="" data-jobid="" class="btn btn-success saveperviewSetups" data-status='Verified'>
						<span class="indicator-label">Accept</span>
					</button>
                   			 <button type="button"  value="" data-designationid="" data-jobid="" class="btn btn-primary saveperviewSetups" data-status='Incomplete'>
						<span class="indicator-label">Incomplete</span>
					</button>
					<button type="button" id="isaccessreject"  value="" data-designationid="" data-jobid="" class="btn btn-danger saveperviewSetups" data-status='Rejected' >
						<span class="indicator-label">Reject</span>
					</button>
				</div>
				<div class="text-center texthide">                
				</div>
			</div>

		</div>
	</div>
</div>


<!-- for vacancy verify started-->
<div class="modal fade" id="vacancyconfirmation" role="dialog" tabindex="-1" aria-labelledby="perviewSetupModalTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLongTitle">Verification Submition</h5>
			<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>

			<div class="modal-body">
				<div class="col-md-12">
					<label>Select Valid Issues</label>
					<select id="autotext" class="autotext-multiple" name="autotext[]" multiple="multiple" style="width: 100%;">
					</select>
				</div>

				<div class="col-md-12">
					<label>For other remarks</label>
					<textarea type="text" class="form-control form-control-solid" placeholder="remarks" value="" name="remarks" id="remarks" style="width: 100%;"></textarea>
				</div>
			<div class="col-md-12">
					Is pending for crop image? <input type="checkbox" value="Y" name="iscropimage" class="iscropimage">
				</div>
			</div>

			<div class="modal-footer">
				<label style="font-size: 18px;">Are your sure to confirm  <span class="cfstatus" style="color:red"></span>?</label> 
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
				<button type="button" class="btn btn-primary saveconfirmationstatus confirmationstatus"  data-applerjobid=""  id="confirmationstatus" value="" data-applerstatus="" data-applerdesignationid="">Yes</button>
			</div>
		</div>
	</div>
</div>
<!-- vacancy verify ended -->


@endsection
@section('scripts')

@section('scripts')
<script>
var applicantDetailTable;
var appliedstatus = 'appliedstatus';
var paymentsource = 'paymentsource';
var designation = 'designation';
var labelname = 'labelname';
var gender = 'gender';
$(document).ready(function() {
	applicantDetailTable = $('#applicantDetailTable').dataTable({
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
		"sAjaxSource": baseUrl + "/getapplicationlist",
		"oLanguage": {
			"sEmptyTable": "<p class='no_data_message'>No data available.</p>"
		},
        "fnServerParams": function (aoData) {
            aoData.push({ "name": "appliedstatus", "value":appliedstatus},
                        {"name": "paymentsource", "value":paymentsource},
                        {"name": "designation", "value":designation},
			{"name": "labelname", "value":labelname},{"name": "gender", "value":gender});
			
        },
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0, ]
		}],
		"aoColumns": [{
				"data": "sn"
			},
			{
				"data": "registrationnumber"
			},
			{
				"data": "applieddatead"
			},
			{
				"data": "receipnumber"
			},
			{
				"data": "fullname"
			},
			{
				"data": "applyamount"
			},
			{
				"data": "paymentsource"
			},
			{
				"data": "contactnumber"
			},
			{
				"data": "designation"
			},
			{
				"data": "labelname"
			},
			{
				"data": "appliedstatus"
			},
			{
				"data": "gender"
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
				type: "text"
			},
			{
				type: "text"
			},
			{
				type: "text"
			},
			{
                type: "select",values:['ESEWA','KHALTI', 'connectIPS'],
			},
			{
				type: "text"
			},
			{
                type: "select",values:['बरिष्ठ प्रबन्धक','प्रबन्धक', 'उप प्रबन्धक', 'उप प्रबन्धक (वित्त विश्लेषक)', 'सहायक प्रबन्धक', 'सहायक प्रबन्धक (कानून)', 'प्रमुख सहायक', 'सब इन्जिनियर', 'सहायक'],
			},

			{
                type: "select",values:['4','5', '6', '7', '8', '9'],
			},

			{
                type: "select",values:['Verified','Incomplete', 'Rejected', 'Pending'],
			},
			{
				type: "select",values:['Male','Female'],
			},	
			{
				type: "null"
			},		
		
		]
	});
});
</script>

<script>
var jobstatusid = '';
$(document).ready(function() {
	$(document).off('click', '.previewUser');
	$(document).on('click', '.previewUser', function(e) {
		e.preventDefault();
		var userid = $(this).data('userid');
		var authUserId = {{auth()->user()->id}};
		jobstatusid += $(this).data('jobapplyid');
		var applicantstatus = $(this).data('aplicantstatus');
		var designationid = $(this).data('designationid');
		var isaccess = $(this).data('isaccess');
		var jobid = $(this).data('jobid');
		var url = baseUrl + '/getpreview';
		var infoData = {
			userid: userid,
            designationid : designationid
		};
		$.post(url, infoData, function(response) {
			$('#perviewSetupModal').modal('show');
			$('.saveperviewSetups').val(userid);
			$('.saveperviewSetups').attr('data-designationid',designationid);
			$('.saveperviewSetups').attr('data-jobid',jobid);
		
			if(isaccess=='Y'){
				$('#isaccessaccept').show();
				$('#isaccessreject').show();
			} else{
				$('#isaccessaccept').hide();
				$('#isaccessreject').hide();
			}

			if(authUserId != 4826){
				if(applicantstatus == 'Rejected' || applicantstatus == 'Verified') {
					$(".texthide").html('<span class="indicator-label"><b>'+applicantstatus+'</b></span>');
					$('.statusaction').hide();
				} else {
					$(".texthide").html('');
					$('.statusaction').show();
				}
			} else {
				$(".texthide").html('<span class="indicator-label"><b>'+applicantstatus+'</b></span>');
			}
			$('#perviewSetupModal .modal-body').html(response);
		})
	});
});

$(document).ready(function() {
	$(document).off('click', '.saveperviewSetups');
	$(document).on('click', '.saveperviewSetups', function(e) {
		e.preventDefault();
	
		var verifyaction = $(this)[0].dataset.status;//$(this).data('status');
		var userid       = $(this).val();
		var designationid= $(this)[0].dataset.designationid;//$(this).data('designationid');
		var jobid        = $(this)[0].dataset.jobid; //$(this).data('jobid');
		var url = baseUrl + '/verifyaction'
		var infoData = {
			verifyaction: verifyaction
		}

		$.post(url, infoData, function(response) {
			response=JSON.parse(response);
			if(response.type=='success'){
				$('.confirmationstatus').val(userid);
				$('#confirmationstatus').attr('data-applerstatus',verifyaction);
				$('#confirmationstatus').attr('data-applerdesignationid',designationid);
				$('#confirmationstatus').attr('data-applerjobid',jobid);
				$('.cfstatus').text(verifyaction);
				$('#autotext').html(response.message);
			} else{
				toastr.error(response.message);
			}
		});	
		$('#vacancyconfirmation').modal('show');
		$('#perviewSetupModal').modal('hide');
	});
});

// commented for short time
$(document).ready(function() {
	$(document).off('click', '.saveconfirmationstatus');
	$(document).on('click', '.saveconfirmationstatus', function(e) {
		e.preventDefault();
		var userid = $(this).val();
		var status= $(this)[0].dataset.applerstatus;//$(this).data('applerstatus');
		var designationid = $(this)[0].dataset.applerdesignationid;//$(this).data('applerdesignationid');
		var jobapplyid = $(this)[0].dataset.applerjobid;//$(this).data('applerjobid');
		var remarks = $('#remarks').val();
		var autotext = $('#autotext').val();
		var applicantname = $('#applicantname').val();
		var designation = $('#designation').val();
		var iscropimage = $('.iscropimage').val();
		var url = baseUrl + '/storeuserstatus'
		var infoData = {
			userid: userid,
			status : status,
			jobstatusid : jobstatusid,
			remarks : remarks,
			autotext: autotext,
			designationid: designationid,
			jobapplyid: jobapplyid,
                        iscropimage: iscropimage

		}

		$.post(url, infoData, function(response) {
			response=JSON.parse(response)
			applicantDetailTable.fnDraw();
			if (response.type == "success") {
				applicantDetailTable.fnDraw();
				$('#perviewSetupModal').modal('hide');
				$('#autotext option:selected').remove();
				toastr.success(response.message);
				$('#vacancyconfirmation').modal('hide');
				$('#remarks').val('');
			} else {
				applicantDetailTable.fnDraw();
				toastr.error(response.message);
			}
		});
	});
})

$(document).ready(function() {
    $('.autotext-multiple').select2();
});
</script>


@endsection
