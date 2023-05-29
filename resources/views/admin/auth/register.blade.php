<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
@include('admin.layouts.head')
<!-- #086bce blue -->
<!-- #03c712  green -->

<head>
	<style>
		.footer{
			background-color: #505050;
			padding: 10px 0px !important;
		}
		.footer .text-dark span{
			color: !important;
		}
		.footer .text-dark a{
			color: #ffffff8c !important;
			font-weight: 600;
		}
	</style>
</head>

<body id="kt_body" class="bg-dark">
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
			style="background-image: url(assets/media/illustrations/sketchy-1/14-dark.png">
			<div class="d-flex flex-center sign_flx">
			<div class=" sign_img">
				<img src="<?php echo url('/') . '/adminAssets/assets/images/log_bk.png'; ?>" alt="">
			</div>
			<div class=" bg-body shadow-sm sign_form">

				<div class="" id="profileUpdateData" style="">
					<!--begin::Card header-->
					<div class="card-header border-0 cursor-pointer sign_text_heading" role="button"
						data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true"
						aria-controls="kt_account_profile_details">
						<!--begin::Card title-->
						<div class="card-title m-0">
							<h3 class="fw-bolder m-0 head_txt">Sign Up</h3>
						</div>
						<div class="text-center">
							<p class="mb-3 errorColor">
								@if (session()->has('failure'))
								{!! session()->get('failure') !!}
								@endif
							</p>
						</div>
						<!--end::Card title-->
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>

						@endif
					</div>
					<!--begin::Card header-->
					<!--begin::Content-->
					<div id="kt_account_settings_profile_details" class="collapse show">
						<!--begin::Form-->
						<form id="registerForm" method="post" action="{{route('registerUser')}}" class="form"
							enctype="multipart/form-data">
							<!--begin::Card body-->
							@csrf
							<div class="card-body border-top p-9">
								<!--begin::Input group-->
								<div class="row mb-6">
									<div class="col-lg-12">
										<!--begin::Row-->
										<div class="row">
											<!--begin::Col-->
											<div class="col-lg-4 fv-row">
												<label class="col-form-label fw-bold fs-6">First Name
													<span class="compulsory">&nbsp;*</span></label>

												<input type="text" name="firstname" id="firstname"
													class="form-control form-control-sm form-control-solid mb-3 mb-lg-0"
													placeholder="First Name" value="{{ old('firstname') }}" style="font-size: 16px;">
											</div>
											<!--end::Col-->
											<!--begin::Col-->
											<div class="col-lg-4 fv-row">
												<label class="col-form-label  fw-bold fs-6">Middle Name</label>

												<input type="text" name="middlename" id="middlename"
													class="form-control form-control-sm form-control-solid"
													placeholder="Middle Name" value="{{ old('middlename') }}" style="font-size: 16px;">
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-lg-4 fv-row">
												<label class="col-form-label  fw-bold fs-6">Last Name<span
														class="compulsory">&nbsp;*</span></label>

												<input type="text" name="lastname" id="lastname"
													class="form-control form-control-sm form-control-solid"
													placeholder="Last Name" value="{{ old('lastname') }}" style="font-size: 16px;">
											</div>
											<!--end::Col-->

										</div>
										<!--end::Row-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Input group-->

								<!--begin::Input group-->
								<div class="row mb-6">
									<div class="col-lg-12">
										<!--begin::Row-->
										<div class="row">
											<div class="col-lg-4 fv-row">
												<label class="col-form-label  fw-bold fs-6">Gender<span
														class="compulsory">&nbsp;*</span></label>
												<select name="gender"
													class="border-0" style="color: #5e6278; padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;background: #f5f8fa !important;">
													<option value="" selected="">Select Gender</option>
													<option value="Male" selected="">Male</option>
													<option value="Female">Female</option>
													<option value="Others">Others</option>
												</select>
											</div>
											<!--end::Col-->
											<!--begin::Col-->
											<div class="col-lg-4 fv-row">
												<label class="col-form-label fw-bold fs-6">Email<span
														class="compulsory">&nbsp;*</span></label>

												<input type="email" name="email"
													class="form-control form-control-sm form-control-solid"
													placeholder="Email" value="{{ old('email') }}" style="font-size: 16px;">
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-lg-4 fv-row">
												<label class="col-form-label fw-bold fs-6">Mobile Number<span
														class="compulsory">&nbsp;*</span></label>

												<input type="number" name="contactnumber"
													class="form-control form-control-sm form-control-solid"
													placeholder="Mobile Number" value="{{ old('contactnumber') }}" style="font-size: 16px;">
											</div>
											<!--end::Col-->

										</div>
										<!--end::Row-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Input group-->

								<!--begin::Input group-->
								<div class="row mb-6">
									<div class="col-lg-12">
										<!--begin::Row-->
										<div class="row">
											<div class="col-lg-6 fv-row">
												<label class="col-form-label fw-bold fs-6">Create Password<span
														class="compulsory">&nbsp;*</span></label>

												<input type="password" name="password" id="newpassword"
													class="form-control form-control-sm form-control-solid"
													placeholder="Password" value="{{ old('password') }}" style="font-size: 16px;">
											</div>
											<!--end::Col-->

											<!--begin::Col-->
											<div class="col-lg-6 fv-row">
												<label class="col-form-label  fw-bold fs-6">Retype Password<span
														class="compulsory">&nbsp;*</span></label>

												<input type="password" name="retypepassword" id="confirmpassword"
													class="form-control form-control-sm form-control-solid"
													placeholder="Retype Password" value="{{ old('retypepassword') }}" style="font-size: 16px;">
												<p id="matchpassword">
											</div>
											<!--end::Col-->
											<div style="display: flex;justify-content: center;margin-top: 20px;"
												class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
												<!-- <label for="password" class="col-md-4 control-label">Captcha</label> -->


												<div class="col-md-6"
													style="border: 1px solid #ddd; padding-bottom: 21px;">
													<div class="captcha">
														<span></span>
														<!-- <div class="captcha_box">

														</div> -->
														<img src="{{route('refresh_captcha')}}" class="" />
														{{-- <button type="button" class="btn btn-success btn-refresh"><i
																class="fa fa-refresh" aria-hidden="true"></i></button> --}}
													</div>
													<input id="captcha" type="text" class="form-control"
														placeholder="Enter Captcha" name="captcha">


													@if ($errors->has('captcha'))
													<span class="help-block">
														<strong>{{ $errors->first('captcha') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-md-12">
												<button type="submit" class="reg_btn" id="saveProfile">Register</button>
											</div>

										</div>
										<!--end::Row-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Card body-->
							<!--begin::Actions-->
							<div class="log_txt_redirect">
								<p>If you already have an account &nbsp; &nbsp;<a href="{{route('login')}}">Login</a>
								</p>

							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Content-->

				</div>
			</div>

		</div>
	</div>
	</div>

	<!--begin::Javascript-->
	@include('admin.layouts.scripts')
	<!--end::Javascript-->
	
	<!--begin::Footer-->
	<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
		<!--begin::Container-->
		<div class="container d-flex flex-column flex-md-row align-items-center" style="justify-content: space-between;">
			<!--begin::Copyright-->
			<div class="text-dark order-2 order-md-1">
				<span class="text-muted fw-bold me-1"><?php echo date('Y'); ?>©</span>
				<a class="text-gray-800 text-hover-primary" href="https://www.nlk.org.np/home" target="_new">नागरिक लगानी कोष</a>
			</div>
			<div class="text-dark order-2 order-md-1">
				Developed By: <a href="https://cltech.com.np" target="_new"  class="text-gray-800 text-hover-primary">Code Logic Technologies Pvt. Ltd.</a>
			</div>
			<!--end::Copyright-->
				</div>
		<!--end::Container-->
	</div>
	<!--end::Footer-->
</body>
<!--end::Body-->

</html>

<script type="text/javascript">
	function validateNepaliMobile(mobile) {
		var mobileRegex = /^(98|97)\d{8}$/;
		return mobileRegex.test(mobile);
	}
	// handle form submission
	$('#submit').click(function() {
	var mobile = $('#contactnumber').val();
	if (validateNepaliMobile(mobile)) {
		// Nepali mobile number is valid
		alert('Nepali mobile number is valid');
		// continue with form submission
		// e.g. $('#myform').submit();
	} else {
		// Nepali mobile number is invalid
		alert('Please enter a valid Nepali mobile number starting with 98 or 97 and length 10');
	}
	});

	$(".btn-refresh").click(function() {
		$.ajax({
			type: 'GET',
			url: '/refresh_captcha',
			success: function(data) {

				$(".captcha span").html(data);
			}
		});
	});

	$("#confirmpassword").keyup(function() {

		var newpassword = $("#newpassword").val();
		var confirmpassword = $("#confirmpassword").val();
		if (newpassword == confirmpassword) {
			$("#matchpassword").text("Confirm Password Match with New Passsword").css("color", "green");
		} else {
			$("#matchpassword").text("Confirm Password Does Not Match with New Passsword").css("color", "#B94A48");
		}
	});
</script>


<link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css') }}">


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"> </script>

<script>
@if(session('flash_message'))
toastr.success("{{ Session::get('flash_message') }}");
@endif

@if(session('flash_check'))
toastr.info("{{ Session::get('flash_check') }}");
@endif

@if(session('flash_error'))
toastr.warning("{{ Session::get('flash_error') }}");
@endif

@if(session('flash_delete'))
toastr.error("{{ Session::get('flash_delete') }}");
@endif
</script>
