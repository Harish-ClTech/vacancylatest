<form id="PaalikaSetupForm" method="post" class="form" enctype="multipart/form-data" action="{{ @$saveurl }}">
    <input type="hidden" value="{{ @$previousData->userid }}" name="userid" />
    <input type="hidden" value="{{ @$previousData->profileid }}" name="profileid" />
    <input type="hidden" value="{{ @$previousData->id }}" name="paalikasetupid" />
    <!--begin::Heading-->
    <div class="mb-13 text-center">
        <!--begin::Title-->
        <h1 class="mb-3">कागजात फारम</h1>
        <!--end::Title-->
    </div>
    <!--end::Heading-->
    <div class="row g2 mb-2">
        <label for="photograph" class=" fs-6 fw-bold mb-2">जन्म मिती (वि.स.) मा </label>
        <input type='file' onchange="readURL(this);" name="photograph" />
        <img id="blah" src="http://placehold.it/180" alt="your image" />
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row g2 mb-2">
        <!--begin::Col-->
        <div class="col-md-6 fv-row">
            <label for="dob" class=" fs-6 fw-bold mb-2">जन्म मिती (वि.स.) मा </label>
            <input type="text" class="form-control form-control-solid" placeholder="जन्म मिती (वि.स.)मा राख्नुहोस"
                id="dob" name="dob" value="{{ @$previousData->dob }}" />

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 fv-row">
            <label for="age" class=" fs-6 fw-bold mb-2">दरखास्त दिने अन्तिम मितिमा हुने उमेर </label>
            <input type="text" class="form-control form-control-solid"
                placeholder="दरखास्त दिने अन्तिम मितिमा हुने उमेर " id="age" name="age"
                value="{{ @$previousData->age }}" readonly />

        </div>
        <!--end::Col-->

    </div>
    <!--end::Input group-->


</form>
