<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
@include('admin.layouts.head')
<!-- 03c75e green -->
<!-- #06c blue -->

<head>
	<style>

	</style>
</head>


<body id="kt_body" class="bg-dark">
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
			style="background-image: url(assets/media/illustrations/sketchy-1/14-dark.png">
			<div class="d-flex flex-center log_flx">
				<div class="log_img">
					<img src="<?php echo url('/') . '/adminAssets/assets/images/log_bk.png'; ?>" alt="">
				</div>
				<div class="bg-body shadow-sm log_form">
					<form class="form w-100" method="post" novalidate="novalidate" id="loginForm"
						action="{{route('verifyRegisterUserOtp')}}">
						@csrf
						<div class="text-center mb-10 log_text_heading">
							<h1 class="head_txt">नागरिक लगानी कोष</h1>

						</div>
						<div class="text-center">
							@if(session()->has('failure'))
								<p class="mb-3 errorColor">{{ (session()->get('failure')) }}</p>
							@endif
							<div class="row otpsent" style='display:none'>
								<p class="mb-3 successColor">{{$message}}</p>
							</div>
						</div>
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>

						@endif
						<div class="form_grouping">
							<div class="fv-row mb-10 form_group">
								<div class="log_icons">
									<i class="fa-solid fa-user"></i>
								</div>
                                <input type="hidden" name="registeredemail" id="registeredemail" value="{{ $email }}">
								<label for="otp" class="form-label fs-6 fw-bolder text-dark">Enter your OTP</label>
								<input class="form_input form-control form-control-lg form-control-solid" type="text"
									id="otp" name="otp" autocomplete="off" />
							</div>
                            <div class="text-center">
								<button type="submit" class="btn btn-lg log_btn">
									<span>Verify</span>
								</button>

							</div>
						</div>


					</form>

				</div>

			</div>
		</div>
	</div>

	<!--begin::Javascript-->
	@include('admin.layouts.scripts')
	<!--end::Javascript-->

	<script>
		$(document).ready(function () {
			$('.otpsent').show().delay(5000).fade();
		});
	</script>
</body>
<!--end::Body-->

</html>
