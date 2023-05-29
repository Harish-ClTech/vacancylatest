@extends('admin.layouts.admin_designs')

@section('siteTitle')
प्रयोगकर्ता
@endsection
@section('css')
<style>
	 /* The switch - the box around the slider */
	.switch {
	position: relative;
	display: inline-block;
	width: 60px;
	height: 34px;
	}

	/* Hide default HTML checkbox */
	.switch input {
	opacity: 0;
	width: 0;
	height: 0;
	}

	/* The slider */
	.slider {
	position: absolute;
	cursor: pointer;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: #ccc;
	-webkit-transition: .4s;
	transition: .4s;
	}

	.slider:before {
	position: absolute;
	content: "";
	height: 26px;
	width: 26px;
	left: 4px;
	bottom: 4px;
	background-color: white;
	-webkit-transition: .4s;
	transition: .4s;
	}

	input:checked + .slider {
	background-color: #3C2784;
	}

	input:focus + .slider {
	box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	-webkit-transform: translateX(26px);
	-ms-transform: translateX(26px);
	transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
	border-radius: 34px;
	height: 20px;
	width: 45px;
	}

	.slider.round:before {
	border-radius: 50%;
	} 

	.slider::before {
	position: absolute;
	content: "";
	height: 12px;
	width: 12px;
	left: 4px;
	bottom: 4px;
	background-color: white;
	-webkit-transition: .4s;
	transition: .4s;
	}
	.modal-open .select2-container--bootstrap5 .select2-dropdown {
		z-index: 999999999 !important;
	}

</style>
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
					<li class="breadcrumb-item text-muted">प्रयोगकर्ता सूची</li>
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

							<button type="button" id="adduserSetup" data-toggle="modal" data-target="#modal_boxx" style="     background: #3C2784;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-weight: 600;
    border-radius: 3px;
	float: right;"
								class="pull-right">
								<i class="fa fa-plus"></i>
								प्रयोगकर्ता थप गर्नुहोस्
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
							<table class="table-bordered table-striped table-condensed cf" id="userSetupTable"
								width="100%">

								<thead class="cf" style="background-color: #dfe1e5;">

									<tr style="color:#3C2784;font-size: 16px;">
										<th>क्रम संख्या </th>
										<th>प्रयोगकर्ताको नाम</th>
										<th>पद</th>
										<th>इमेल ठेगाना</th>
										<th>फोन न.</th>
										<th>हेर्नुपर्ने विज्ञापन</th>
										<th>स्थिति</th>
										<th width="10%">कार्य</th>

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

<div id="userSetupModal" style="z-index: 9999;" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="userSetupModalTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dailog-centered mw-900px" role="document" style="margin-top: 100px;">
		<div class="modal-content rounded">
			<div class="modal-header pb-0 border-0 justify-content-end">
				<button type="button" id="closedmodal" class="close  pull-right" value="userSetupModal"
					data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body scroll-y px=10 px-lg-15 pt-0 pb-15" style="padding: 0px 15px 30px !important;"></div>
			<div class="modal-footer" style="border-top: 0px;">
				<div class="text-center">
					<button type="button" id="saveUserSetups" class="" style="background: #3C2784;
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
var userSetupTable;
$(document).ready(function() {
	userSetupTable = $('#userSetupTable').dataTable({
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
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": baseUrl + "/getusersetuplist",
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
				"data": "profilename"
			},
			{
				"data": "designationtitle"
			},
			{
				"data": "email"
			},
			{
				"data": "contactnumber"
			},
			{
				"data": "userlevel"
			},
			{
				"data": "userstatus"
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

	$(document).off('click', '#adduserSetup');
	$(document).on('click', '#adduserSetup', function(e) {
		e.preventDefault();
		var url = baseUrl + '/usersetup/form';

		$.post(url, function(response) {
			$('.indicator-label').html('<i class="fa-solid fa-floppy-disk"></i> &nbsp; सेभ');
			$('#userSetupModal').modal('show');
			$('#userSetupModal .modal-body').html(response);
		})
	});

	$(document).off('click', '#saveUserSetups');
	$(document).on('click', '#saveUserSetups', function() {
		$('#userSetupForm').ajaxSubmit({
			success: function(response) {
				var result = JSON.parse(response);
				if (result.type == 'success') {
					$('#userSetupModal').modal('hide');
					userSetupTable.fnDraw();
					$.notify(result.message, 'success');
				} else {
					$.notify(result.message, 'error');
				}
			}
		});
	});

	$(document).off('click', '.editUserSetup');
	$(document).on('click', '.editUserSetup', function() {

		var usersetupid = $(this).data('usersetup');
		var url = baseUrl + '/usersetup/form'
		var infoData = {
			usersetupid: usersetupid
		}
		$.post(url, infoData, function(response) {
			if (usersetupid) {
				$('.indicator-label').html('<i class="fa-solid fa-pen-to-square"></i>&nbsp; अपडेट गर्नुहोस्');
			}
			$('#userSetupModal').modal('show');
			$('#userSetupModal .modal-body').html(response);
		})
	});
});

$(document).off('click', '.deleteUserSetup');
$(document).on('click', '.deleteUserSetup', function() {
	var usersetupid = $(this).data('usersetup');
	var url = baseUrl + '/usersetup/delete'
	var infoData = {
		usersetupid: usersetupid
	}
	swal({
			title: "के तपाई यो प्रयोगकर्ता हटाउन चाहनुहुन्छ ? ",
			text: "तपाइँ यो प्रयोगकर्ता पुन: प्राप्त गर्न सक्नुहुने छैन |",
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
				userSetupTable.fnDraw();
				toastr.success(result.message);
			} else {
				toastr.error(result.message);
			}
		});
	});

});

// Check for status?
$(document).off('change','.status');
$(document).on('change','.status', function(){
	var status, confirmMsg, btnMsg, finalMsg;
	var ischecked = $(this).val();
	if(ischecked == 'Y'){
		status = 'N';
		confirmMsg = 'के तपाई यो प्रयोगकर्तालाई निश्कृय पर्न चाहानुहुन्छ ?';
		btnMsg = 'निश्कृय पार्नुहोस् !';
		finalMsg = 'निश्कृय !';
	}else{
		status = 'Y';
		confirmMsg = 'के तपाई यो प्रयोगकर्तालाई सकृय पर्न चाहानुहुन्छ ?';
		btnMsg = 'सकृय पार्नुहोस् !';
		finalMsg = 'सकृय !';
	}
	var userid = $(this).data('id');
	var url = '{{ route('updateStatus') }}';
	var token =  "{{ csrf_token() }}";
	var data = {'userid':userid, 'status':status,'_token':token};
	Swal.fire({
		text: confirmMsg,
		icon: 'info',
		showCancelButton: true,
		confirmButtonColor: '#24174F',
		cancelButtonColor: 'red',
		confirmButtonText: 'हो ।  '+btnMsg,
		cancelButtonText: 'होइन । अहिलेलाई नगर्ने ! ',
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(url, data, function(response){
				var result = JSON.parse(response);
				if(result.type == 'success'){
					Swal.fire(
						finalMsg,
						result.message,
						'success'
					);
					userSetupTable.fnDraw();
				}
			})
		}else{
			if(ischecked == 'Y'){
				$(this).prop('checked', true);
			}else{
				$(this).prop('checked', false);
			}
		}
	});
});
</script>
@endsection
