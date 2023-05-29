@extends('admin.layouts.admin_designs')

@section('siteTitle')
    विद्यालय सेटअप
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-body">
                        <form id="schoolSetupForm" method="post" class="form" enctype="multipart/form-data"
    action="{">
    <input type="hidden" class="lastschoolid" value="" name="schoolid" />
    <!--begin::Heading-->
    <div class="mb-13 text-center">
        <!--begin::Title-->
        <h1 class="mb-3">विद्यालय सेटअप फारम</h1>
        <!--end::Title-->
    </div>
    <!--end::Heading-->
    <div class="row g-12 mb-12">
        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="province" class="required fs-6 fw-bold mb-2">प्रदेश</label>
            <select class="form-select form-select-solid" id="province" name="provinceid" style="padding: 4px;" disabled>
                
            </select>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-2 fv-row">
            <label for="districtid" class="required fs-6 fw-bold mb-2">जिल्ला </label>
            <select class="form-select districtdata form-select-solid" id="districtid" name="districtid"
                style="padding: 4px;"  >
                <option value="" selected>जिल्ला छान्नुहोस्</option>
                
            </select>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="vdcormunicipality" class="required fs-6 fw-bold mb-2">पालिकाको नाम </label>
            <select class="form-select vdcormunicipalitydata form-select-solid" id="vdcormunicipality"
                name="municipalityid" style="padding: 4px;" >
                <option value="" selected>पालिकाको नाम छान्नुहोस्</option>
               
            </select>
        </div>
        <!--end::Col-->
        <!--begin::Col-->

        <div class="col-md-2 fv-row">
            <label for="wardnumber" class="required fs-6 fw-bold mb-2">वार्ड</label>
            <input type="text" class="form-control form-control-solid" placeholder="वार्ड राख्नुहोस" id="wardnumber"
                name="wardnumber" value="" />

        </div>
        <!--end::Col-->
        <!--begin::Col-->

        <div class="col-md-2 fv-row">
            <label for="tole" class="required fs-6 fw-bold mb-2">टोल</label>
            <input type="text" class="form-control form-control-solid" placeholder="टोल राख्नुहोस" id="tole" name="tole"
                value="" />

        </div>
        <!--end::Col-->

    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row g-12 mb-12">
        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="schoolname" class=" required fs-6 fw-bold mb-2">विद्यालयको नाम</label>
            <input type="text" class="form-control form-control-solid" placeholder="विद्यालयको नाम राख्नुहोस"
                id="schoolname" name="schoolname" value="" />

        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="schooltype" class=" fs-6 fw-bold mb-2">विद्यालयको प्रकार</label>
            <select class="form-select schooltype form-select-solid" id="schooltype" name="schooltype"
                style="padding: 4px;">
                <option value="" selected>विद्यालयको प्रकार छान्नुहोस्</option>



            </select>

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-2 fv-row">
            <label for="schoolcode" class=" fs-6 fw-bold mb-2">विद्यालयको कोड</label>
            <input type="text" class="form-control form-control-solid" placeholder="विद्यालयको कोड राख्नुहोस"
                id="schoolcode" name="schoolcode" value="" />

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-2 fv-row">
            <label for="schoolphonenumber" class="required fs-6 fw-bold mb-2">सम्पर्क नम्बर </label>
            <input type="text" class="form-control form-control-solid" placeholder="सम्पर्क नम्बर राख्नुहोस"
                id="schoolphonenumber" name="schoolphonenumber" value="" />

        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-2 fv-row">
            <label for="schoolemail" class="required fs-6 fw-bold mb-2">इमेल</label>
            <input type="email" class="form-control form-control-solid" placeholder="इमेल राख्नुहोस" id="schoolemail"
                name="schoolemail" value="" />

        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row g-12 mb-12">
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="principalfullname" class=" required fs-6 fw-bold mb-2">प्र.अ. नाम</label>
            <input type="text" class="form-control form-control-solid" placeholder="प्र.अ.को नाम राख्नुहोस"
                id="principalfullname" name="principalfullname" value="{" />

        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="principalmobilenumber" class="required fs-6 fw-bold mb-2"> प्र.अ. सम्पर्क नम्बर </label>
            <input type="text" class="form-control form-control-solid" placeholder="सम्पर्क नम्बर राख्नुहोस"
                id="principalmobilenumber" name="principalmobilenumber"
                value="" />

        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="principalemail" class=" fs-6 fw-bold mb-2"> प्र.अ. इमेल</label>
            <input type="email" class="form-control form-control-solid" placeholder="इमेल राख्नुहोस" id="principalemail"
                name="principalemail" value="" />

        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row g-12 mb-12">
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="chairpersionfullname" class=" required fs-6 fw-bold mb-2">वि.व्य.स. (अध्यक्षको) नाम</label>
            <input type="text" class="form-control form-control-solid" placeholder="वि.व्य.स.को नाम राख्नुहोस"
                id="chairpersionfullname" name="chairpersionfullname"
                value="" />

        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="chairpersionmobilenumber" class="required fs-6 fw-bold mb-2"> वि.व्य.स. (अध्यक्षको) सम्पर्क
                नम्बर </label>
            <input type="text" class="form-control form-control-solid" placeholder="सम्पर्क नम्बर राख्नुहोस"
                id="chairpersionmobilenumber" name="chairpersionmobilenumber"
                value="" />

        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="chairpersionemail" class=" fs-6 fw-bold mb-2"> वि.व्य.स. (अध्यक्षको) इमेल</label>
            <input type="email" class="form-control form-control-solid" placeholder="इमेल राख्नुहोस"
                id="chairpersionemail" name="chairpersionemail" value="" />

        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row g-12 mb-12">
        <div class="col-md-3 fv-row">
            <label for="bankname" class=" required fs-6 fw-bold mb-2">बैंक नाम</label>
            <input type="text" class="form-control form-control-solid" placeholder="बैंक नाम राख्नुहोस" id="bankname"
                name="bankname" value="" />

        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="bankaccountnumber" class="required fs-6 fw-bold mb-2"> बैंक खाता नम्बर </label>
            <input type="text" class="form-control form-control-solid" placeholder="बैंक खाता नम्बर राख्नुहोस"
                id="bankaccountnumber" name="bankaccountnumber" value="" />

        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="bankbranch" class="required fs-6 fw-bold mb-2"> बैंक शाखा </label>
            <input type="text" class="form-control form-control-solid" placeholder="बैंक शाखा राख्नुहोस" id="bankbranch"
                name="bankbranch" value=" "/>

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="logo" class=" fs-6 fw-bold mb-2">लोगो</label>

            <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
            <input type="hidden" name="currentlogo" value="" />
        </div>
        <!--end::Col-->

    </div>
</form>
                    </div>
                    <!--end::Card header-->

                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </div>
   
@endsection
@section('css')
    <style>
        .modalwidth {
            max-width: 1200px;
        }
    </style>
@endsection

@section('scripts')
  
@endsection