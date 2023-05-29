<form id="personalSetupForm" method="post" class="form" enctype="multipart/form-data" action="{{ @$saveurl }}">
    <input type="hidden" value="{{ @$previousData->id }}" name="personaldetailid" />
    <div class="form_tab_bk"style="padding:45px !important; margin-top:20px !important;">
       
        <div class="row g2 mb-4">
            <!--begin::Col-->
            <div class="col-md-4 fv-row">
                <label for="nfirstname" class="required fs-6 mb-2">पहिलो नाम (देवनागरीमा)</label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="पहिलो नाम" id="nfirstname" name="nfirstname"
                    value="{{ @$previousData->nfirstname }}" />

            </div>
            <!--end::Col-->
            <div class="col-md-4 fv-row">
                <label for="nmiddlename" class="fs-6 mb-2">बिचको नाम (देवनागरीमा)</label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="बिचको नाम" id="nmiddlename" name="nmiddlename"
                    value="{{ @$previousData->nmiddlename }}" />

            </div>
            <!--end::Col-->
            <div class="col-md-4 fv-row">
                <label for="nlastname" class="required fs-6 mb-2">अन्तिम नाम अर्थात थर (देवनागरीमा)</label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="अन्तिम नाम" id="nlastname" name="nlastname"
                    value="{{ @$previousData->nlastname }}" />

            </div>
            <!--end::Col-->
        </div>
        <div class="row g2 mb-4">
            <!--begin::Col-->
            <div class="col-md-4 fv-row">
                <label for="efirstname" class="required fs-6 mb-2">First Name </label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="First Name" id="efirstname" name="efirstname"
                    value="{{ @$previousData->efirstname }}" />

            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4 fv-row">
                <label for="emiddlename" class="fs-6 mb-2">Middle Name </label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="Middle Name" id="emiddlename" name="emiddlename"
                    value="{{ @$previousData->emiddlename }}" />

            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4 fv-row">
                <label for="elastname" class="required fs-6 mb-2">Last Name </label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="Last Name" id="elastname" name="elastname"
                    value="{{ @$previousData->elastname }}" />

            </div>
            <!--end::Col-->
        </div>
        <div class="row g2 mb-4">
            <div class="col-md-4 fv-row">
                <label for="dateofbirthbs" class="required fs-6 mb-2">जन्म मिति (वि.स.) </label>
                <input type="text" class="form-control form_input nepali-calendar form-control-solid"
                    placeholder="जन्म मिति (वि.स.)YYYY-MM-DD" id="dateofbirthbs" name="dateofbirthbs"
                    value="{{ @$previousData->dateofbirthbs }}" />

            </div>
            <div class="col-md-4 fv-row">
                <label for="dateofbirthad" class="required fs-6 mb-2">जन्म मिति (A.D.) <span style="text-bold">उमेर:</span> <span style="text-bold" id="age"> - </span> बर्ष</label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="जन्म मिति (A.D)YYYY-MM-DD" id="dateofbirthad" name="dateofbirthad"
                    value="{{ @$previousData->dateofbirthad }}" readonly="readonly" />

            </div>
            <div class="col-md-4 fv-row">
                <label for="gender" class="required fs-6 mb-2">लिङ्ग </label>
                <select class="form-control form_input form-control-solid" placeholder="लिङ्ग" id="gender"
                    name="gender" value="{{ @$previousData->gender }}">
                    <option value="Male" {{ (@$previousData->gender == 'Male') ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ (@$previousData->gender == 'Female') ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ (@$previousData->gender == 'Other') ? 'selected' : '' }}>Other</option>
                </select>

            </div>
        </div>
        <div class="row g2 mb-4">
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="citizenshipnumber" class="required fs-6 mb-2">नागरिकता नं. </label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="नागरिकता नं." id="citizenshipnumber" name="citizenshipnumber"
                    value="{{ @$previousData->citizenshipnumber }}" />


            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="citizenshipissuedistrictid" class="required fs-6 mb-2">नागरिकता जारी जिल्ला </label>
                <select class="form-select  select2 form-select-solid" id="citizenshipissuedistrictid"
                    name="citizenshipissuedistrictid" style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important;     height: 45px;
    color: #5e6278;">
                    <option value="">जिल्ला छान्नुहोस्</option>
                    @foreach (@$districts as $district)
                        <option value="{{ @$district->id }}"
                            {{ $district->id == @$previousData->citizenshipissuedistrictid ? 'selected' : ' ' }}>
                            {{ $district->districtname }}</option>
                    @endforeach
                </select>

            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="citizenshipissuedate" class="required fs-6 mb-2">नागरिकता जारी मिति </label>
                <input type="text" class="form-control form_input nepali-calendar form-control-solid"
                    placeholder="नागरिकता जारी मिति" id="citizenshipissuedate"
                    name="citizenshipissuedate" value="{{ @$previousData->citizenshipissuedate }}" />

            </div>
            <!--end::Col-->

        </div>
        <div class="row g2 mb-4">
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="motherfirstname" class="required fs-6 mb-2"> आमाको पहिलो नाम (देवनागरीमा) </label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder=" आमाको पहिलो नाम" id="motherfirstname" name="motherfirstname"
                    value="{{ @$previousData->motherfirstname }}" />

            </div>
            <div class="col-md-4  fv-row">
                <label for="mothermiddlename" class=" fs-6 mb-2"> आमाको बिचको नाम (देवनागरीमा)</label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="आमाको बिचको नाम" id="mothermiddlename" name="mothermiddlename"
                    value="{{ @$previousData->mothermiddlename }}" />

            </div>
            <!--end::Col-->
            <div class="col-md-4  fv-row">
                <label for="motherlastname" class="required fs-6 mb-2">आमाको अन्तिम नाम अर्थात थर (देवनागरीमा)</label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="आमाको अन्तिम नाम अर्थात थर" id="motherlastname" name="motherlastname"
                    value="{{ @$previousData->motherlastname }}" />

            </div>
        </div>
        <div class="row g2 mb-4">
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="fatherfirstname" class="required fs-6 mb-2"> बाबुको पहिलो नाम (देवनागरीमा) </label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="बाबुको पहिलो नाम" id="fatherfirstname" name="fatherfirstname"
                    value="{{ @$previousData->fatherfirstname }}" />

            </div>
            <!--end::Col-->
            <div class="col-md-4  fv-row">
                <label for="fathermiddlename" class=" fs-6 mb-2">बाबुको बिचको नाम (देवनागरीमा)</label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="बाबुको बिचको नाम" id="fathermiddlename" name="fathermiddlename"
                    value="{{ @$previousData->fathermiddlename }}" />

            </div>
            <div class="col-md-4  fv-row">
                <label for="fatherlastname" class="required fs-6 mb-2">बाबुको अन्तिम नाम अर्थात थर (देवनागरीमा)</label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="बाबुको अन्तिम नाम अर्थात थर" id="fatherlastname" name="fatherlastname"
                    value="{{ @$previousData->fatherlastname }}" />

            </div>

        </div>
        <div class="row g2 mb-4">
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="grandfatherfirstname" class="required fs-6 mb-2"> बाजेको पहिलो नाम (देवनागरीमा) </label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="बाजेको पहिलो नाम" id="grandfatherfirstname" name="grandfatherfirstname"
                    value="{{ @$previousData->grandfatherfirstname }}" />

            </div>
            <!--end::Col-->
            <div class="col-md-4  fv-row">
                <label for="grandfathermiddlename" class=" fs-6 mb-2"> बाजेको बिचको नाम (देवनागरीमा) </label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="बाजेको बिचको नाम" id="grandfathermiddlename"
                    name="grandfathermiddlename" value="{{ @$previousData->grandfathermiddlename }}" />

            </div>
            <!--end::Col-->
            <div class="col-md-4  fv-row">
                <label for="grandfatherlastname" class="required fs-6 mb-2"> बाजेको अन्तिम नाम अर्थात थर (देवनागरीमा)</label>
                <input type="text" class="form-control form_input form-control-solid"
                    placeholder="बाजेको अन्तिम नाम अर्थात थर" id="grandfatherlastname" name="grandfatherlastname"
                    value="{{ @$previousData->grandfatherlastname }}" />

            </div>
            <!--end::Col-->
            <div class="col-md-4 fv-row">
				<label for="iscitemployee" class="fs-6 fw-bold mb-2">
					<?php 
					$isInternalEmployee = '';
					if(@$previousData->iscitemployee == 'Y'){
						$isInternalEmployee = 'checked';
					}	
					?>
					<input type="checkbox" name="iscitemployee" id="iscitemployee" class="iscitemployee" {{ $isInternalEmployee }}> नागरिक लगानी कोषको स्थायी कर्मचारी हो ?
				</label>
			</div>

        </div>
        <div class="row g2 mb-4">
            @if ((auth()->user()->is_submitted == 0) || (auth()->user()->is_submitted == 1 && auth()->user()->personal_enabled == 1))
                <div class="col-md-12 fv-row form_btn">
                    <button type="button" name="submit" id="savePersonalDetail" style="float: right">Next</button>
                </div>
            @endif 
        
        </div>
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
                        var dob = new Date(data.datead); // convert the date to a JavaScript Date object
                        var today = new Date(); // create a new Date object for today's date
                        var age = today.getFullYear() - dob.getFullYear(); // calculate the age difference in years
                        // check if the birth month is in the future or not
                        if (dob.getMonth() > today.getMonth() || (dob.getMonth() == today.getMonth() && dob.getDate() > today.getDate())) {
                            age--; // reduce the age by 1 if the birth month is in the future
                        }
                        $('#age').html(age); // set the age value in the input field
                        $('#dateofbirthad').val(data.datead); // set the English date value in the input field
                    } else if (data.type == 'error') {
                        $('#dateofbirthad').val(data.datead);
                    }
                }
            });
        },
        npdYearCount: 100 // Options | Number of years to show
    });


    $(document).ready(function() {

        $(document).off('click', '#savePersonalDetail');
        $(document).on('click', '#savePersonalDetail', function() {

            $('#personalSetupForm').ajaxSubmit({
                dataType: 'json',
                success: function(response) {
                    responseData = response[0];
                    if (responseData.success) {
                        getProfileID();
                        gotToTab('#otherdetail');
                        $.notify(responseData.message, 'success');
                    } else {
                        $.notify(responseData.message, 'error');
                    }
                }
            });
        });


        $(document).off('click', '#provinceid');
        $(document).on('change', '#provinceid', function() {

            var provinceid = $(this).find('option:selected').val();
            var districtid = $('#districtid').data('districtid');
            var url = baseUrl + '/provincewisedistrict';
            var infoData = {
                'provinceid': provinceid,
                'districtid': districtid,
            };
            $.post(url, infoData, function(response) {
                $('.districtdata').html(response);
            });
        });


        $(document).off('click', '#mailingprovinceid');
        $(document).on('change', '#mailingprovinceid', function() {

            var provinceid = $(this).find('option:selected').val();
            var districtid = $('#mailingdistrictid').data('mailingdistrictid');
            var url = baseUrl + '/provincewisedistrict';
            var infoData = {
                'provinceid': provinceid,
                'districtid': districtid,
            };
            $.post(url, infoData, function(response) {
                $('.mailingdistrictdata').html(response);
            });
        });


        $(document).off('click', '#districtid');
        $(document).on('change', '#districtid', function() {

            var districtid = $(this).find('option:selected').val();
            var municipalityid = $('#municipalityid').data('municipalityid');
            var did = $('#districtid').data('districtid');

            var url = baseUrl + '/districtwisevdcormunicipality';
            var infoData = {
                'districtid': districtid,
                'municipalityid': municipalityid,
                'did': did
            };

            $.post(url, infoData, function(response) {
                $('.vdcormunicipalitydata').html(response);

            })
        });


        $(document).off('click', '#mailingdistrictid');
        $(document).on('change', '#mailingdistrictid', function() {

            var districtid = $(this).find('option:selected').val();
            var municipalityid = $('#mailingdistrictid').data('mailingdistrictid');
            var did = $('#mailingdistrictid').data('mailingdistrictid');
            var url = baseUrl + '/districtwisevdcormunicipality';
            var infoData = {
                'districtid': districtid,
                'municipalityid': municipalityid,
                'did': did
            };
            $.post(url, infoData, function(response) {
                $('.mailingvdcormunicipalitydata').html(response);
            })
        });

    });
</script>