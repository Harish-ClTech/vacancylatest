 <!--begin::Post-->
 <div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::details View-->
        <div class="card mb-5 mb-xl-10" id="PasswordChangeData">
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form id="passwordUpdateForm" method="post" action="{{@$saveurl}}" class="form"
                    enctype="multipart/form-data">
                    <input type="hidden" name="userid" value="{{ @$userid }}">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">


                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <div class="col-lg-12">
                                <!--begin::Col-->
                                <div class="col-lg-4 fv-row">
                                    <label class="col-form-label fw-bold fs-6">Current Password</label>

                                    <input type="password" name="currentpassword" id="currentpassword"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="Current Password" value="" autocomplete="off" />
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-lg-4 fv-row">
                                    <label class="col-form-label  fw-bold fs-6">New Password</label>

                                    <input type="password" name="newpassword" id="newpassword"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="New Password" value="" />
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-lg-4 fv-row">
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
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="button" class="btn btn-primary" id="savePassword">Update</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
        </div>
        <!--end::details View-->

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