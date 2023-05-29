@extends('admin.layouts.admin_designs')

@section('siteTitle')
Change Password
@endsection

@section('content')
    <!--begin::Content-->
    <head><style>
		.drop_pw{
			display: none;
			
		}

	</style></head>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
               <!-- <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0"> -->
                    <!--begin::Title-->
                    <!-- <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Change Password</h1> -->
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                   <ul class="drop_pw breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Change Password</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Overview</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                <!-- </div> -->
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::details View-->
                <div class="card mb-5 p-3" id="PasswordChangeData" style="width: 500px;margin: 8em auto;box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.125);">
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="passwordUpdateForm" method="post" action="{{@$saveurl}}" class="form"
                            enctype="multipart/form-data">
                            <input type="hidden" name="userid" value="{{ @$userid }}">
                            <!--begin::Card body-->
                            <div class="card-body border-0 p-0">


                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <div class="col-lg-12">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <label class="col-form-label fw-bold fs-6">Current Password</label>

                                            <input type="password" name="currentpassword" id="currentpassword"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="Current Password" value="" autocomplete="off" />
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col">
                                            <label class="col-form-label  fw-bold fs-6">New Password</label>

                                            <input type="password" name="newpassword" id="newpassword"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="New Password" value="" />
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col">
                                            <label class="col-form-label  fw-bold fs-6">confirm password</label>

                                            <input type="password" name="confirmpassword" id="confirmpassword"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="Confirm Password" value="" />
                                            <p id="matchpassword">

                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-center">
                                <button type="button" class="" style="color: #5e6278; background: #3C2784;color: #fff;border: none;padding: 10px 20px;font-weight: 600;border-radius: 3px;height:32px;" id="savePassword">Update</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!--end::details View-->


            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).off('click', '#savePassword');
            $(document).on('click', '#savePassword', function() {
                $('#passwordUpdateForm').ajaxSubmit({
                    dataType: 'json',
                    success: function(response) {
                        if (response.type == 'success') {
                            $.notify(response.message, 'success');
							location.reload();
                        } else {
                            $.notify(response.message, 'error');
                        }
                    }
                })

            });

        });
    </script>
	<script>
		$("#currentpassword").keyup( function () {
					var current_password = $("#currentpassword").val();
		
					$.ajax({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						type: 'post',
						url: '{{ route('chkUserPassword') }}',
						data: {
							current_password:current_password},
						success: function (resp) {
							if(resp =="true"){
								$("#correct_password").text("Current Password Matches").css("color", "green");
							} else if (resp =="false"){
								$("#correct_password").text("Password Does Not Match").css("color", "#B94A48");
							}
						}, error: function (resp) {
							alert("Error");
						}
		
					});
				});
		</script>
		
		<script>
			$("#confirmpassword").keyup( function () {
						var newpassword = $("#newpassword").val();
						var confirmpassword = $("#confirmpassword").val();
						if(newpassword ==confirmpassword){
									$("#matchpassword").text("Confirm Password Match with New Passsword").css("color", "green");
								} else{
									$("#matchpassword").text("Confirm Password Does Not Match with New Passsword").css("color", "#B94A48");
								}
					});
			</script>
@endsection
