<style>
    #trainingDetailsForm {
  margin-top: 40px;
}
    </style>
<form id="trainingDetailsForm" method="post" class="form" enctype="multipart/form-data" action="{{ @$saveurl }}">
    <input type="hidden" value="{{ @$previousData->personalid }}" name="personalid" />
    <input type="hidden" value="{{ @$previousData->id }}" name="trainingdetailid" />
    <!--begin::Heading-->
    <div class="mb-13 text-center">
        <!--begin::Title-->
        <h3 class="mb-3" style="color: #3C2784;font-weight: 600;">तालिम सेटअप फारम</h3>
        <!--end::Title-->
    </div>
    <!--end::Heading-->
    <div class="custom_form">
    <div class="row g2 mb-2">
        <!--begin::Col-->
        <div class="col-md-5 fv-row">
            <label for="trainingproviderinstitutionalname" class="fs-6 fw-bold mb-2">तालिम प्रदायकको नाम</label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="तालिम प्रदायकको नाम"
                id="trainingproviderinstitutionalname" name="trainingproviderinstitutionalname" value="{{ @$previousData->trainingproviderinstitutionalname }}" />

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label for="trainingname" class="fs-6 fw-bold mb-2">तालिमको नाम </label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="तालिमको नाम राख्नुहोस"
                id="trainingname" name="trainingname" value="{{ @$previousData->trainingname }}" />

        </div>
        <!--end::Col-->
         <!--begin::Col-->
         <div class="col-md-3 fv-row">
            <label for="gradedivisionpercent" class=" fs-6 fw-bold mb-2">ग्रेड/प्रतिशत </label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="ग्रेड /प्रतिशतराख्नुहोस"
                id="gradedivisionpercent" name="gradedivisionpercent" value="{{ @$previousData->gradedivisionpercent }}" />

        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row g2 mb-2">
        <!--end::Col-->
        <div class="col-md-3 fv-row">
            <label for="fromdatebs" class=" fs-6 fw-bold mb-2">तालिम अवधि देखि (B.S) </label>
            <input type="text" class="form-control form_input form-control-solid nepali-calendar ndp-nepali-calendar"
                placeholder="YYYY-MM-DD" id="fromdatebs" name="fromdatebs" value="{{@$previousData->fromdatebs}}" />

        </div>
        <!--end::Col-->
         <!--end::Col-->
         <div class="col-md-3 fv-row">
            <label for="enddatebs" class=" fs-6 fw-bold mb-2">तालिम अवधि सम्म (B. S)</label>
            <input type="text" class="form-control form_input form-control-solid nepali-calendar ndp-nepali-calendar"
                placeholder="YYYY-MM-DD" id="enddatebs" name="enddatebs" value="{{@$previousData->enddatebs}}" />

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 fv-row">
            <label for="document" class=" fs-6 fw-bold mb-2">तालिमको प्रमाणपत्र (jpg/png/pdf, 1mb भन्दा कम)</label>
            <input type="hidden" name="back_document" value="{{@$previousData->document}}">
            <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf"  class="form-control form_input form-control-solid" placeholder="तालिम प्रमाणपत्र (कागजात jpg/pdf)"
                id="document" name="document[]" multiple />

        </div>
        <!--end::Col-->


    </div>
    <!--end::Input group-->



</div>
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
