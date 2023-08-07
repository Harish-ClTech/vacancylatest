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
					<li class="breadcrumb-item text-muted">रुजु गर्ने अधिकारी</li>
					<!--end::Item-->
				</ul>
				<!--end::Breadcrumb-->
			</div>
		</div>
	</div>
	<div class="post d-flex flex-column-fluid" id="kt_post" style="margin-top: 70px;">
		<div id="kt_content_container" class="container-xxl">
			<div class="card">
				<div class="card-body py-4">
					<form id="signatureSetupForm" method="post" class="form" enctype="multipart/form-data" action="{{route('signaturesetup.store')}}">
						<input type="hidden" value="{{ @$signatureSetupInfo->id }}" name="signaturesetupid" />
						<div class="mb-13 text-center">
							<h3 class="mb-3" style=" color: #3C2784;  font-weight: 600; margin-top: 5px;">रुजु गर्ने अधिकारी सेटअप</h3>
						</div>
						<div class="custom_form">
							<div class="row g2 mb-2">
								<div class="col-md-4 mb-3">
									<label for="fullname" class="required fs-6 fw-bold mb-2"> नाम</label>
									<input type="text" class="form-control form_input form-control-solid" placeholder="नाम" id="fullname" name="fullname" value="{{ @$signatureSetupInfo->fullname }}">
								</div>

								<div class="col-md-4 mb-3">
									<label for="designation" class="required fs-6 fw-bold mb-2"> पद</label>
									<input type="text" class="form-control form_input form-control-solid" placeholder="पद" id="designation" name="designation" value="{{ @$signatureSetupInfo->designation }}">
								</div>

								<div class="col-md-4 mb-3">
									<label for="signaturedate" class="required fs-6 fw-bold mb-2"> मिति</label>
									<input type="text" class="form-control form_input form-control-solid nepali-calendar" placeholder="मिति" id="signaturedate" name="signaturedate" value="{{ @$signatureSetupInfo->signaturedate }}">
								</div>

								<div class="col-md-4 mb-3">
									<label for="status" class="required fs-6 fw-bold mb-2"> स्थिति</label>
									<select name="status" id="status" class="form-select">
										<option value="Y" {{ (!empty($signatureSetupInfo->status) && $signatureSetupInfo->status=='Y')? 'selected':''}}>Active</option>
										<option value="N" {{ (!empty($signatureSetupInfo->status) && $signatureSetupInfo->status=='N')? 'selected':''}}>Inactive</option>
									</select>
								</div>
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-12 mb-2">
											<label for="signature" class="required fs-6 fw-bold mb-2"> हस्ताक्षर</label>
											<input type='file' name="signature" id="signature"/>
										</div>
										<div class="col-md-12">
											@if(!empty($signatureSetupInfo->signature))
												<img id="previewsignature" src="{{ asset('uploads/signaturesetup').'/'.@$signatureSetupInfo->signature }}" alt="Scanned Signature" style="max-width: 100px;height: 100px;object-fit: cover;" />
											@else
												<img id="previewsignature" src="{{ asset('adminAssets/assets/images/no_image.png') }}" alt="Scanned Signature" style="max-width: 100px;height: 100px;object-fit: cover;" />
											@endif
										</div>
									</div>
								</div>
							
								<div class="col-md-12 text-end">
									<button type="button" id="saveSignatureSetup" class="btn btn-primary">{{ !empty($signatureSetupInfo)? 'अपडेट गर्नुहोस्': 'सेभ गर्नुहोस्'}}</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
	<script>
		$(document).ready(function() {
			// Image Preview On Browsing New Image
			$('#signature').change(function(){
				let reader = new FileReader();
				reader.onload = (e) => {
				$('#previewsignature').attr('src', e.target.result);
				}
				reader.readAsDataURL(this.files[0]);
			});
			$('.nepali-calendar').nepaliDatePicker({
				npdMonth: true,
				npdYear: true,
				language: 'nepali',
				unicodeDate: true,
				npdYearCount: 100 // Options | Number of years to show
			});
			$('.autotext-multiple').select2();

			$(document).off('click', '#saveSignatureSetup');
			$(document).on('click', '#saveSignatureSetup', function() {
				$('#signatureSetupForm').ajaxSubmit({
					success: function(response) {
						var result = JSON.parse(response);
						if (result.type == 'success') {
							$.notify(result.message, 'success');
						} else {
							$.notify(result.message, 'error');
						}
					}
				});
			});

			$(document).off('click', '.editSignatureSetup');
			$(document).on('click', '.editSignatureSetup', function() {

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

			$(document).off('click', '.deleteSignatureSetup');
			$(document).on('click', '.deleteSignatureSetup', function() {
				var usersetupid = $(this).data('usersetup');
				var url = "{{route('signaturesetup.store')}}";
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
		});
	</script>
@endsection
