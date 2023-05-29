<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
@include('admin.layouts.head')


<head>
	<style>
		.fg_pw_btn button:hover:before{
			opacity: 1;


		}
		.fg_pw_btn button:before{
			position: absolute;
			content: "";
			background-color:  #3C2784;
			bottom: 0px;
			left: 0px;
			width: 100%;
			height: 3px;
			border-radius: 10px;
			opacity: 0;
			transition: .3s ease;
		}
		.fg_pw_btn button{
			position: relative;
			padding: 5px !important;
			border-radius: 0px;
margin: 0px 12px;
transition: .4s ease;
/* border-bottom: 4px solid #08c !important; */
		}

		/* .fg_pw_btn:nth-child(2) a button{
			margin-right: 0px;
			border: none !important;
		} */
		.fg_pw_btn button:after{

		}
		.after_css:after{
			content: "";
			position: absolute;
    top: 8px;
    right: -16px;
    width: 2px;
    height: 20px;
    background-color: #ddd;
    transform: rotate(20deg);
		}
	</style>
</head>
<body id="kt_body" class="bg-dark">
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
			style="background-image: url(assets/media/illustrations/sketchy-1/14-dark.png">
			<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

				<div class="w-lg-500px bg-body rounded shadow-sm mx-auto" style = "height: 75%;">
					<form id="passwordResetForm" method="post" class="form" enctype="multipart/form-data"
						action="{{ route('forgotPassword') }}">
						@csrf
						<div class="text-center mb-10">
							<h1 class="text-dark mb-3" style="padding: 15px 30px; font-size: 28px; font-weight: 600; background:#3C2784; color: #fff !important;">नागरिक लगानी कोष</h1>
						</div>
						<div class="text-center">
							<p class="mb-3 successColor" id="echomsg"></p>
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
						<div class="fv-row mb-6" style="padding: 15px 40px;">
							<label for="email" class="form-label fs-6 fw-bolder text-dark">Email / Username</label>
							<input class="form-control form-control-lg form-control-solid" type="text" id="email"
								name="email" autocomplete="off" />
						</div>

						<div class="text-center" style="padding: 0px 40px;">
							<button style="width: 100%; border-radius: 5px; border:0;color:#fff;background:#3C2784;padding:10px" type="button" id="forgotSubmit" class="" >
								<span>Request New Password</span>
							</button>

						</div>
<div class="if_option">
	<h5 style="text-align: center; margin-top: 15px; font-weight: 600; color: green;">or</h5>
</div>
					</form>
					<div class="text-center fg_pw_btn">
						<a href="{{ route('login') }}"><button type="button" class="btn btn-lg btn-primary after_css"
								style="    background-color: transparent !important; color: #3C2784; font-weight: 600; margin-top: 10px;">
								<span>Login</span>
							</button></a>
						<a href="{{ route('userRegister') }}"><button type="button" class="btn btn-lg btn-primary"
								style="    background-color: transparent !important; color:  #3C2784; font-weight: 600; margin-top: 10px;">
								<span>Register</span>
							</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--begin::Javascript-->
	@include('admin.layouts.scripts')
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>

<script>
$(document).ready(function() {
    $(document).off('click', '#forgotSubmit');
    $(document).on('click', '#forgotSubmit', function() {
        $('#passwordResetForm').ajaxSubmit({
		dataType: 'json',
		beforeSend: function () {
            $('#forgotSubmit').attr('disabled', 'disabled');
        },
        complete: function () {
            $('#forgotSubmit').removeAttr('disabled');
        },
        success: function(response) {
			$("#echomsg").html();
			$("#echomsg").removeClass('d-none');
			if (response.type == 'error') {
				$("#echomsg").removeClass('successColor');
				$("#echomsg").addClass('errorColor');
                $("#echomsg").html(response.message);
			} else if (response.type == 'success') {
                $("#echomsg").removeClass('errorColor');
				$("#echomsg").addClass('successColor');
                $("#echomsg").html(response.message);
            }
		}
	});
    });

});
</script>
