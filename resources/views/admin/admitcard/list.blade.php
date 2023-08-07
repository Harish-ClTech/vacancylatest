@extends('admin.layouts.admin_designs')

@section('siteTitle')
    प्रवेश पत्र
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
                        <li class="breadcrumb-item text-muted">प्रवेश पत्र सूची</li>
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
                @include('admin.layouts.alert')
                <div class="card">
                    <div class="row p-3">
                        {{-- <div class="col-md-3 fv-row">
                            <label for="year" class="required fs-6 fw-bold mb-2">वर्ष </label>
                            <select class="form-select form_input  select2 form-select-solid" id="year"
                                name="year" style="padding: 4px;">
                                <option value="" selected>वर्ष छान्नुहोस्</option>
                                <option value="2022">
                                    2022</option>
                                <option value="2023">
                                    2023</option>
                                <option value="2024">
                                    2024</option>
                                <option value="2025">
                                    2025</option>
                                <option value="2026">
                                    2026</option>
                            </select>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label for="level" class="required fs-6 fw-bold mb-2"> तह </label>
                            <select class="form-select form_input select2 form-select-solid" id="level" name="level"
                                style="padding: 4px;">
                                <option value="">तह छान्नुहोस्</option>
                                @foreach ($levels as $level)
                                <option value="{{ @$level->id }}" {{ $level->id==@$previousData->level ? "selected" : " "}}>
                                    {{ @$level->labelname }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="col-md-4 fv-row">
                            <label for="designation" class="required fs-6  mb-2" style="color:#3C2784;font-weight:600;">पद </label>
                            <select class="form-select form_input  select2 form-select-solid" id="designation"
                                name="designation" style="padding: 4px;">
                                <option value="" selected>पद छान्नुहोस्</option>
                                @foreach ($designations as $designation)
                                    <option value="{{ @$designation->id }}"
                                        {{ $designation->id==@$previousData->designation ? "selected" : " "}}>{{ @$designation->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 fv-row" id="vacancytypeDiv">
                            <label for="vacancytype" class="required fs-6  mb-2" style="color:#3C2784;font-weight:600;"">विज्ञापन प्रकार</label>
                            <select id="vacancytype"  name="vacancytype" class="form-select form_input  select2 form-select-solid" style="padding: 4px;">
                                <option value="" selected>विज्ञापन प्रकार छान्नुहोस्</option>
                                <option value="N">खुला प्र.</option>
                                <option value="Y">आ.प्र.</option>
                            </select>
                        </div>           
                        <div class="col-md-2 fv-row">
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" id="viewAdmitCard" class="pull-right" style="background: #3C2784;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-weight: 600;
    border-radius: 3px;
    float: right; ">
                                    <i class="fa fa-refresh"></i> लोड गर्नुहोस्
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--begin::Card body-->
                    <div class="card-body py-4 usertList">

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $(document).off('click', '#viewAdmitCard');
            $(document).on('click', '#viewAdmitCard', function() {

                // var levelid = $('#level').val();
                //  var yearid = $('#year').val();
                var designationid = $('#designation').val();
                var vacancytype = $('#vacancytype').val();
                if(!designationid || !vacancytype){
                    $.notify('अनिवार्य क्षेत्रहरू छान्नुहोस् ।', 'error');
                    return false;
                }

                var url = baseUrl + '/getadmitcartusers';
                var infoData = {
                    // yearid: yearid,
                    designationid: designationid,
                    vacancytype: vacancytype,
                    // levelid: levelid
                };
                $.post(url, infoData, function(response) {
                    $('.usertList').html(response);
                });
            });

            
            $(document).off('click',  '.printAdmit');
            $(document).on('click', '.printAdmit',function() {
                // var levelid = $('#level').val();
                // var yearid = $('#year').val();
                var designationid = $('#designation').val();
                var vacancytype = $('#vacancytype').val();
                var url = baseUrl + '/admit-card/print';
        
                window.open(url + "?designationid=" + designationid + '&isinternalvacancy=' + vacancytype);             
            });

            $(document).off('click',  '.printAdmitCard');
            $(document).on('click', '.printAdmitCard',function() {
                // var levelid = $('#level').val();
                // var yearid = $('#year').val();
                var userid = $(this).data('userid');
                var designationid = $(this).data('designationid');
                var isinternalvacancy = $(this).data('isinternalvacancy');
                var url = baseUrl + '/admit-card/print';
        
                window.open(url + "?userid="+userid+"&designationid=" + designationid+"&isinternalvacancy=" + isinternalvacancy);             
            });
           
        });
    </script>

@endsection