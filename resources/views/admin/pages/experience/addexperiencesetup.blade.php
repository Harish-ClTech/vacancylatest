<form id="experienceDetailsForm" method="post" class="form" enctype="multipart/form-data" action="{{ @$saveurl }}">
    <input type="hidden" value="{{ @$previousData->personalid }}" name="personalid" />
    <input type="hidden" value="{{ @$previousData->id }}" name="experiencedetailid" />
    <!--begin::Heading-->
    <div class="mb-13 text-center">
        <!--begin::Title-->
        <h3 class="mb-3" style="color: #3C2784;font-weight: 600;">अनुभव सेटअप फारम</h3>
        <!--end::Title-->
    </div>
    <!--end::Heading-->
    <div class="custom_form">
    <div class="row g2 mb-2">
        <!--begin::Col-->
        <div class="col-md-6 fv-row">
            <label for="officeaddress" class="required fs-6 fw-bold mb-2">कार्यालय ठेगाना</label>
            <textarea type="text" class="form-control form-control-solid" placeholder="कार्यालय ठेगाना राख्नुहोस"
                id="officeaddress" name="officeaddress" value="" >{!! @$previousData->officeaddress !!}</textarea>

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="officename" class="required fs-6 fw-bold mb-2"> कार्यालयको नाम </label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="कार्यालयको नाम"
                id="officename" name="officename" value="{{ @$previousData->officename }}" />

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="jobtype" class="required fs-6 fw-bold mb-2">रोजगारीको प्रकार  </label>
            <select class="" id="jobtype" name="jobtype"
            style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important; height:32px; color: #5e6278;
    opacity: 0.6;">
                <option value="" selected>रोजगारीको प्रकार  छान्नुहोस्</option>
                <option value="Government" {{ @$previousData->jobtype == 'Government' ? 'selected' : '' }}>
                    Government</option>
                <option value="Non-Government" {{ @$previousData->jobtype == 'Non-Government' ? 'selected' : '' }}>Non-Government
                </option>
            </select>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row g2 mb-2">
        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="designation" class="required fs-6 fw-bold mb-2">पद </label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="पद"
                id="designation" name="designation" value="{{ @$previousData->designation }}" />

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="service" class=" fs-6 fw-bold mb-2">सेवा</label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="सेवा"
                id="service" name="service" value="{{ @$previousData->service }}" />

        </div>
        <!--end::Col-->
         <!--begin::Col-->
         <div class="col-md-3 fv-row">
            <label for="group" class=" fs-6 fw-bold mb-2">समूह  </label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="समूह"
                id="group" name="group" value="{{ @$previousData->group }}" />

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="subgroup" class=" fs-6 fw-bold mb-2">उप समूह  </label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="उप समूह "
                id="subgroup" name="subgroup" value="{{ @$previousData->subgroup }}" />

        </div>
        <!--end::Col-->

    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row g2 mb-2">

         <!--begin::Col-->
         <div class="col-md-3 fv-row">
            <label for="ranklabel" class=" fs-6 fw-bold mb-2">तह/श्रेणी  </label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="तह/श्रेणी "
                id="ranklabel" name="ranklabel" value="{{ @$previousData->ranklabel }}" />

        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-3 fv-row">
            <label for="remarks" class=" fs-6 fw-bold mb-2">Remarks </label>
            <input type="text" class="form-control form_input form-control-solid" placeholder="Remarks"
                id="remarks" name="remarks" value="{{ @$previousData->remarks }}" />

        </div>
        <!--end::Col-->
         <!--end::Col-->
         <div class="col-md-3 fv-row">
            <label for="fromdatebs" class="required fs-6 fw-bold mb-2">कार्य अवधि देखि (B.S) </label>
            <input type="text" class="form-control form_input form-control-solid nepali-calendar"
                placeholder="YYYY-MM-DD" id="fromdatebs" name="fromdatebs" value="{{@$previousData->fromdatebs}}" />

        </div>
        <!--end::Col-->
         <!--end::Col-->
         <div class="col-md-3 fv-row">
            <label for="enddatebs" class="required fs-6 fw-bold mb-2">कार्य अवधि सम्म (B. S)</label>
            <input type="text" class="form-control form_input nepali-calendar form-control-solid"
                placeholder="YYYY-MM-DD" id="enddatebs" name="enddatebs" value="{{@$previousData->enddatebs}}" />
        </div>
        <!--end::Col-->


    </div>

    <!--end::Input group-->
    <div class="row g2 mb-2">
         <!--begin::Col-->
         <div class="col-md-3 fv-row">
            <label for="workingstatus" class="required fs-6 fw-bold mb-2"> रोजगारीको अवस्था </label>
            <select class="" id="workingstatus" name="workingstatus"
            style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important; height:32px;     color: #5e6278;
    opacity: 0.6;">
                <option value="" selected>रोजगारीको अवस्था  छान्नुहोस्</option>
                <option value="Working" {{ @$previousData->workingstatus == 'Working' ? 'selected' : '' }}>
                    Working</option>
                <option value="Not Working" {{ @$previousData->workingstatus == 'Not Working' ? 'selected' : '' }}>Not Working
                </option>
                <option value="Transfered" {{ @$previousData->workingstatus == 'Transfered' ? 'selected' : '' }}>Transfered
                </option>
            </select>

        </div>
        <!--end::Col-->

         <!--begin::Col-->
         <div class="col-md-3 fv-row">
            <label for="workingstatuslabel" class="fs-6 fw-bold mb-2"> रोजगारी तह</label>
            <select class="" id="workingstatuslabel" name="workingstatuslabel"
            style=" padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important; height:32px;color: #5e6278;
    opacity: 0.6;">
                <option value="" selected>रोजगारीको तह छान्नुहोस्</option>
                <option value="Permanent" {{ @$previousData->workingstatuslabel == 'Permanent' ? 'selected' : '' }}>
                    Permanent</option>
                <option value="Temporary" {{ @$previousData->workingstatuslabel == 'Temporary' ? 'selected' : '' }}>Temporary
                </option>
                <option value="Rahat" {{ @$previousData->workingstatuslabel == 'Rahat' ? 'selected' : '' }}>Rahat
                </option>
                <option value="Others" {{ @$previousData->workingstatuslabel == 'Others' ? 'selected' : '' }}>Others
                </option>
            </select>

        </div>
        <!--end::Col-->
        <div class="col-md-6 fv-row">
            <label for="document" class=" fs-6 fw-bold mb-2">अनुभवको प्रमाणपत्र (jpg/png/pdf, 1mb भन्दा कम)</label>
            <input type="hidden" name="back_document" value="{{@$previousData->document}}">
            <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" class="form-control form_input form-control-solid" placeholder="अनुभव प्रमाणपत्र "
                id="document" name="document[]" value="{{ @$previousData->document }}" multiple />

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
        onChange: function() {
            var nepalidate = $('.nepali-calendar').val();
            $.ajax({
                url: '{{ route('convertdate') }}',
                type: 'POST',
                data: {date:nepalidate},
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.type == 'success') {
                        $('#dateofbirthad').val(data.datead);
                    } else if (data.type == 'error') {
                        $('#dateofbirthad').val(data.datead);
                    }
                }
            });
        },
        npdYearCount: 100 // Options | Number of years to show
    });

    
</script>
