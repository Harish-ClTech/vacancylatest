<form id="educationSetupForm" method="post" class="form" enctype="multipart/form-data" action="{{ @$saveurl }}">
    <input type="hidden" value="{{ @$previousData->personalid }}" name="personalid" />
    <input type="hidden" value="{{ @$previousData->id }}" name="educationdetailid" />
    <!--begin::Heading-->
   
    <div class="mb-13 text-center">
        <!--begin::Title-->
        <h3 class="mb-3" style="color: #3c2784;font-weight: 600;">शैक्षिक विवरण</h1>
        <!--end::Title-->
    </div>
    <!--end::Heading-->
    <div class="custom_form">
    <div class="row g2 mb-2">
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="universityboardname" class="required fs-6 fw-bold mb-2">विश्वविद्यालय / बोर्डको नाम </label>
            <input type="text" class="form-control form_input form-control-solid"
                placeholder="विश्वविद्यालय / बोर्डको नाम राख्नुहोस" id="universityboardname" name="universityboardname"
                value="{{ @$previousData->universityboardname }}" />
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="educationaltype" class="required fs-6 fw-bold mb-2"> शैक्षिक संस्थाको प्रकार</label>
            <select class="form-select form_input select2 form-select-solid" id="educationaltype" name="educationaltype"
                style="padding: 4px;">
                <option value="" selected>शैक्षिक संस्थाको प्रकार छान्नुहोस्</option>
                <option value="Government" {{ @$previousData->educationaltype == 'Government' ? 'selected' : '' }}>
                    Government</option>
                <option value="Private" {{ @$previousData->educationaltype == 'Private' ? 'selected' : '' }}>Private
                </option>
                <option value="Other" {{ @$previousData->educationaltype == 'Other' ? 'selected' : '' }}>Other
                </option>
            </select>

        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="educationinstitution" class="required fs-6 fw-bold mb-2">शिक्षण संस्थाको नाम</label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="शिक्षण संस्थाको नाम राख्नुहोस"
                id="educationinstitution" name="educationinstitution"
                value="{{ @$previousData->educationinstitution }}">

        </div>
        <!--end::Col-->
        
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="educationlevel" class="required fs-6 fw-bold mb-2"> शैक्षिक उपाधि</label>
            <select class="" id="educationlevel" name="educationlevel"
            style="color: #5e6278; padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important; height:32px">
                <option value="" selected>शैक्षिक उपाधि छान्नुहोस्</option>
                @foreach ($academics as $academic)
                    <option value="{{ @$academic->id }}" {{ $academic->id==@$previousData->educationlevel ? "selected" : " "}}>{{ @$academic->name }}</option>
                @endforeach
            </select>

        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="educationfaculty" class="required fs-6 fw-bold mb-2"> शैक्षिक संकाय</label>
            <input type="text" class="form-control form_input form-control-solid" placeholder=" शैक्षिक संकाय"
                id="educationfaculty" name="educationfaculty" value="{{ @$previousData->educationfaculty }}" />

        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="devisiongradepercentage" class="required fs-6 fw-bold mb-2">श्रेणि/ग्रेड/प्रतिशत</label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="श्रेणि/ग्रेड/प्रतिशत "
                id="devisiongradepercentage" name="devisiongradepercentage"
                value="{{ @$previousData->devisiongradepercentage }}" />

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 fv-row">
            <label for="qulificationawardeddetails" class="fs-6 fw-bold mb-2">शैक्षिक योग्यताको उपाधि विवरण</label>
            <textarea type="text" class="form-control form-control-solid" placeholder="शैक्षिक योग्यताको उपाधि विवरण राख्नुहोस"
                id="qulificationawardeddetails" name="qulificationawardeddetails"
                value="">{!! @$previousData->qulificationawardeddetails !!}</textarea>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-6 fv-row">
            <label for="mejorsubject" class="required fs-6 fw-bold mb-2">मूल विषयहरू</label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="प्रमुख विषयहरू comma ले छुट्याउनुहोला ।" id="mejorsubject"
                name="mejorsubject" value="{{ @$previousData->mejorsubject }}" />

        </div>
        <!--end::Col-->
        
        <!--end::Col-->
        <div class="col-md-3 fv-row">
            <label for="passoutdatebs" class="required fs-6 fw-bold mb-2">पास गरेको साल(B.S) </label>
            <input type="text" class="form-control form_input form-control-solid"
                placeholder="वि.स. मा पास गरेको साल" id="passoutdatebs" name="passoutdatebs" value="{{@$previousData->passoutdatebs}}" />

        </div>
        <!--end::Col-->
        <div class="col-md-3 fv-row">
            <label for="passoutdataad" class="required fs-6 fw-bold mb-2">पास गरेको साल(A.D) </label>
            <input type="text" class="form-control form_input form-control-solid " placeholder="ई.स. मा पास गरेको साल"
                id="passoutdatead" name="passoutdatead" value="{{@$previousData->passoutdatead}}" />

        </div>
        <!--end::Col-->
        <!--end::Col-->
        <div class="col-md-6 fv-row">
            <label for="academicdocument" class="required fs-6 fw-bold mb-2">शैक्षिक प्रमाणपत्रहरु (jpg/png/pdf, 1mb भन्दा कम)</label>
            <input type="hidden" name="back_academicdocument" value="{{@$previousData->academicdocument}}">
            <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" class="form-control form_input form-control-solid"
                placeholder="Name your Document Name-CerfitifacteName" id="academicdocument" name="academicdocument[]" multiple />

        </div>
        <!--end::Col-->
        <div class="col-md- 12 fv-row">
            <label for="equivalentdocument" class="fs-6 fw-bold mb-2">Equivalent Document (jpg/png/pdf, 1mb भन्दा कम)</label>
            <input type="hidden" name="back_equivalentdocument" value="{{@$previousData->equivalentdocument}}">
            <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" class="form-control form_input form-control-solid"
                placeholder="Equivalent Document if any,Name-Equivalent" id="equivalentdocument" name="equivalentdocument" />

        </div>
        <!--end::Col-->

    </div>
</div>
   <p style="color:red; margin-top: 15px;">Note: तपाई ले multiple file upload गर्दा एकै चोटी select गरेर भर्नुहोला।</p>

    <!--end::Input group-->

</form>
<script>
    $('.nepali-calendar').nepaliDatePicker({
        npdMonth: true,
        npdYear: true,
        language: 'nepali',
        unicodeDate: true,
        npdYearCount: 100 // Options | Number of years to show
    });
</script>
