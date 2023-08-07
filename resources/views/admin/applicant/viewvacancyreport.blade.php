<style>
	#kt_header{
		background: #fff;
	z-index: 99999;
	}
	.toolbar{
		background-color: #fff !important;
	z-index: 9999999 !important;
	}
	.card-body{
		overflow: hidden;
	}
	.toolbar{
		margin-bottom: 15px;
	}
	.post {
		margin-top: 0px !important;
	}
	table{
		overflow: scroll;
		height: 500px;
		display: block;
		width: 2200px !important;
	
	}
	.table_form{
	/* overflow: hidden; */
	/* height: 600px; */
	}
	thead{
		position: sticky;
		top: 0px;
		z-index: 9999;
		background: #f7f7f7;
		/* z-index: -1; */
	}
	table thead th{
		background: #f7f7f7;
	}
	table tbody td{
		font-size: 14px;
	}
	.card-header{
		position: absolute;
		right: 30px;
		top: -4px;
	}
	table thead tr th:nth-child(1){
		position:  sticky !important;
		top: 0px;
		left: 0px;
		background-color: #f7f7f7;
		z-index: 9999 !important;
	}
	table thead tr th:nth-child(2){
		position:  sticky !important;
		left: 58px;
		top: 0px;
		background-color: #f7f7f7;
		z-index: 9999 !important;
	}
	table thead tr th:nth-child(3){
		position:  sticky !important;
		left: 118px;
		background-color: #f7f7f7;
		width: 118px;
		z-index: 9999 !important;;
		top: 0px;
		/* display: block; */
	}
	table tbody tr td:nth-child(1){
		position:  sticky;
		left: 0px;
		background-color: #fff;
	}
	table tbody tr td:nth-child(2){
		position:  sticky;
		left: 58px;
		background-color: #fff;
	}
	table tbody tr td:nth-child(3){
		position:  sticky;
		left: 118px;
		width: 100px;
		/* display: block; */
		background-color: #fff;
	}

</style>
@extends('admin.layouts.admin_designs')

@section('siteTitle')
विज्ञापन रिपोर्ट
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
					<li class="breadcrumb-item text-muted">विज्ञापनको सूची</li>
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
		<div id="kt_content_container" class="container-fluid">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6" style="z-index: 99999;">
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
						<div class="btn-group">
							<div class="upload-btn-wrapper text-right">
								{{-- <button type="button" class="btn btn-danger" onclick="printPdfApplicantData()"> <i class="fa fa-file-pdf" aria-hidden="true"></i> Print to Pdf</button> --}}
								<button type="button" class="btn btn-success" onclick="exportApplicantData()"> <i class="fa fa-file-excel" aria-hidden="true"></i> Export</button>
							</div>
						</div>
					</div>
					<!--end::Card toolbar-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body py-4">
					<!--begin::Table-->
					<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
						<div class="table_form">
							<table class="table-bordered table-striped table-condensed cf" id="vacancyReportTable"
								width="100%">

								<thead class="cf" style="background:#DFE1E5!important;">
									<tr style="color:#3C2784">
										<th>क्र.सं.</th>
										<th>दर्ता नं.</th>
										<th>नाम नेपालीमा</th>
										<th>नाम अङ्ग्रेजीमा</th>
										<th>लिङ्ग</th>
										<th>जन्म मिति (वि.स.)</th>
										<th>बुवाको नाम</th>
										<th>आमाको नाम</th>
										<th>हजुरबुबाको नाम</th>
										<th>उमेर</th>
										<th>नागरिकता नम्बर</th>
										<th>इमेल</th>
										<th>संपर्क नम्बर</th>
										<th>पद</th>
										<th>तह</th>
										<th>खुला/समावेशी</th>
										<th>Apply Date</th>
										<th>Receipt Number</th>
										<th>Payment Method</th>
										<th>Amount</th>
										<th>स्थिति</th>
										<th width="10%">कैफियत</th>
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
                <!-- preview -->
			</div>

			<div class="modal-footer" style="border-top: 0px;">
				<div class="text-center statusaction">
					<button id="isaccessaccept" type="button" value="" data-designationid="" data-jobid="" class="btn btn-success saveperviewSetups" data-status='Verified'>
						<span class="indicator-label">Accept</span>
					</button>
                   	<button value="" data-designationid="" data-jobid="" class="btn btn-primary saveperviewSetups" data-status='Incomplete'>
						<span class="indicator-label">Incomplete</span>
					</button>
					<button type="button" type="button"  id="isaccessreject"  value="" data-designationid="" data-jobid="" class="btn btn-danger saveperviewSetups" data-status='Rejected' >
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
					<label>Select Valied Issues</label>
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
<script>
var vacancyReportTable;
var appliedstatus = 'appliedstatus';
var paymentsource = 'paymentsource';
var designation = 'designation';
var labelname = 'labelname';
var gender = 'gender';
$(document).ready(function() {
	vacancyReportTable = $('#vacancyReportTable').dataTable({
		"sPaginationType": "full_numbers",
		"bSearchable": false,
		"lengthMenu": [
			[10, 30, 50, 70, 90,100, 500, 1000, 2500, 5000,10000, -1],
			[10, 30, 50, 70, 90,100, 500, 1000, 2500, 5000,10000, "All"]
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
		"sAjaxSource": baseUrl + "/getvacancyreport",
		"oLanguage": {
			"sEmptyTable": "<p class='no_data_message'>No data available.</p>"
		},
       
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0, ]
		}],
		"aoColumns": [
			{
				"data": "sn"
			},
			{
				"data": "registrationnumber"
			},
			{
				"data": "nepalifullname"
			},
			{
				"data": "englishfullname"
			},
			{
				"data": "gender"
			},
			{
				"data": "dateofbirthbs"
			},
			{
				"data": "fatherfullname"
			},
			{
				"data": "motherfullname"
			},
			{
				"data": "grandfatherfullname"
			},
			{
				"data": "age"
			},
			{
				"data": "citizenshipnumber"
			},
			{
				"data": "email"
			},
			{
				"data": "contactnumber"
			},
			{
				"data": "designationtitle"
			},
			{
				"data": "leveltitle"
			},
			{
				"data": "jobcategory"
			},
			{
				"data": "applieddatead"
			},
			{
				"data": "receipnumber"
			},
			{
				"data": "paymentsource"
			},
			{
				"data": "applyamount"
			},
			{
				"data": "appliedstatus"
			},
			{
				"data": "remarks"
			}
		],
	}).columnFilter({
		sPlaceHolder: "head:after",
		aoColumns: [
			{
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
				type: "select", values:['Male','Female']
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
			{
				type: "null"
			},
			{
				type: "text"
			},
			{
				type: "select", values:['All','बरिष्ठ प्रबन्धक','प्रबन्धक','उप प्रबन्धक','उप प्रबन्धक (वित्त विश्लेषक)','सहायक प्रबन्धक','सहायक प्रबन्धक (कानून)','प्रमुख सहायक','सब इन्जिनियर','सहायक']
			},
			{
				type: "select", values:['All','1', '2', '3', '4', '5', '6', '7', '8', '9']
			},
			{
				type: "select", values:['All','खुला', 'महिला', 'आदिवासीजनजाती', 'मधेशी', 'दलित', 'पिछिडिएकाक्षेत्र', 'अपाङ्ग']
			},
			{
				type: "text"
			},
			{
				type: "null"
			},
			{
				type: "select", values:['All','ESEWA','KHALTI', 'connectIPS']
			},
			{
				type: "null"
			},
			{
				type: "select", values:['All','Verified','Incomplete', 'Rejected', 'Pending']
			},	
			{
				type: "null"
			},		
		]
	});
});

var jobstatusid = '';
$(document).ready(function() {
	$(document).off('click', '.previewUser');
	$(document).on('click', '.previewUser', function(e) {
		e.preventDefault();
		var userid = $(this).data('userid');
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

			if(applicantstatus == 'Rejected' || applicantstatus == 'Verified'){
			$(".texthide").html('<span class="indicator-label">'+applicantstatus+'</span>');
			$('.statusaction').hide();
			} else {
			$(".texthide").html('');
			$('.statusaction').show();
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
			vacancyReportTable.fnDraw();
			if (response.type == "success") {
				vacancyReportTable.fnDraw();
				$('#perviewSetupModal').modal('hide');
				$('#autotext option:selected').remove();
				toastr.success(response.message);
				$('#vacancyconfirmation').modal('hide');
				$('#remarks').val('');
			} else {
				vacancyReportTable.fnDraw();
				toastr.error(response.message);
			}
		});
	});
})

$(document).ready(function() {
    $('.autotext-multiple').select2();
});
function exportApplicantData() {
	var url = baseUrl + '/export';
	var infoData = $.param($('#vacancyReportTable').DataTable().ajax.params());

	infoData = infoData + '&isexport=Y'+'&type=excel';
		url = baseUrl + '/getvacancyreport?';
	window.location.href = url + infoData;
}

function printPdfApplicantData() {
	var url = baseUrl + '/export';
	var infoData = $.param($('#vacancyReportTable').DataTable().ajax.params());

	infoData = infoData + '&ispdf=Y'+'&type=pdf';
		url = baseUrl + '/getvacancyreport?';
	window.location.href = url + infoData;
}



</script>


@endsection

