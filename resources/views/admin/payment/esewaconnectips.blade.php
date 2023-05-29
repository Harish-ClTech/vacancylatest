@extends('admin.layouts.admin_designs')

@section('siteTitle')
भुक्तानीको विवरण
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
					<li class="breadcrumb-item text-muted">भुक्तानीको विवरण</li>
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
				<div class="container mt-3">
					@include('admin.layouts.alert')
				</div>
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
                                        <th>Transaction Code</th>
                                        <th>Payment Source</th>
                                        <th>Amount</th>
                                        <th>Purchased Date & Time</th>
                                        <th>Status</th>
                                        <th>Reference ID</th>
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
	<form id="paymentReconcileForm" action="{{route('verifyKhalti')}}" method="GET">
		@csrf
		<input type="hidden" id="transactionid" name="transactionid">
		<input type="hidden" id="transactioncode" name="transactioncode">
		<input type="hidden" id="TXNID" name="TXNID">
		<input type="hidden" id="appliedby" name="appliedby">
		<input type="hidden" id="amount" name="amount">
		<input type="hidden" id="is_reconcile" name="is_reconcile">
		<input type="hidden" id="applicantid" name="applicantid">
	</form>
</div>
@endsection

@section('scripts')

<script>
var registeredCandidates;
var status = 'status';
var usedthrough = 'usedthrough';
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
		"sAjaxSource": baseUrl + "/getesewaconnectips",
		"oLanguage": {
			"sEmptyTable": "<p class='no_data_message'>No data available.</p>"
		},
        "fnServerParams": function (aoData) {
            aoData.push({ "name": "usedthrough", "value":usedthrough},
                        { "name": "status", "value":status})
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
				"data": "transactioncode"
			},
			{
				"data": "usedthrough"
			},
			{
				"data": "amount"
			},
            {
				"data": "purchasedatetime"
			},
			{
				"data": "status"
			},
			{
				"data": "referenceid"
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
				type: "select", values:['ESEWA', 'ConnectIPS']
			},
			{
				type: "text"
			},
            {
				type: "text"
			},
			{
                type: "select", values:['Y', 'F', 'P']
			},
			{
				type: "text"
			},
		]
	});
	
	var vacancyBaseRate = [600, 1000];
	$(document).on('click', '.reconcilePaymentBtn', function(e){
		e.preventDefault();
		var paymenttype = $(this).data('usedthrough');
		$('#TXNID').val($(this).data('transactioncode'));
		$('#transactioncode').val($(this).data('transactioncode'));
		$('#transactionid').val($(this).data('transactionid'));
		$('#appliedby').val($(this).data('applicantid'));
		var amt = $(this).data('amount');
		$('#amount').val(amt);
		var vacancyid = $(this).data('vacancyid').toString();
		var vacancyArray = vacancyid.split(',');
		if(vacancyBaseRate.includes(amt)){ // vacancy amount is 600 or 1000. (must have only one applied vacancy)
			if(vacancyArray.length !=1){ //no. of applied vacancy not equals to 1. stop here
				$.notify('Sorry, applicant can only apply for one vacancy.', 'error');
				return false;
			}
		}else{ //(must have more than one applied vacancy)
			if(vacancyArray.length<2){ //no. of applied vacancy less than 2. stop here
				$.notify('Sorry, the amount and applied vacancy doesnot match.', 'error');
				return false;
			}
		}
		
		$('#is_reconcile').val(true);
		var url = '';
		if(paymenttype=='esewa'){
			url = "{{route('verifyEsewa', 'callback')}}";
		}else if(paymenttype=='connectips'){
			url = "{{route('verifyConnectIps')}}";
		}else if(paymenttype=='khalti'){
			url = "{{route('verifyKhalti')}}";
		}

		$('#paymentReconcileForm').attr('action', url);
		$('#paymentReconcileForm').submit();
	});
});
</script>

@endsection
