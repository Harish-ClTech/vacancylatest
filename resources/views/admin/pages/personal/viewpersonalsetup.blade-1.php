<div class="m-12">
    <form id="personalSetupForm" method="post" class="form" enctype="multipart/form-data" action="{{ @$saveurl }}">
        <input type="hidden" value="{{ @$previousData->userid }}" name="userid" />
        <input type="hidden" value="{{ @$previousData->id }}" name="personaldetailid" />
        <div class="form_tab_bk" style="padding:45px !important; margin-top:50px !important;">
            <!--begin::Heading-->
            <div class="txt_center">
                <div class="mb-13 text-center head_text">
                    <!--begin::Title-->
                    <div class="head_side_design">
                        <h1>व्यक्तिगत विवरण फारम</h1>
                    </div>

                    <!--end::Title-->
                </div>
            </div>

            <!--end::Heading-->

            <div class="row g2 mb-4">
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label for="nfirstname" class="fs-6 mb-2">नाम (देवनागरीमा)</label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="नाम देवनागरीमा राख्नुहोस" id="nfirstname" name="nfirstname"
                        value="{{ @$previousData->nfirstname }}" />

                </div>
                <!--end::Col-->
                <div class="col-md-4 fv-row">
                    <label for="nmiddlename" class="fs-6 mb-2">बिच नाम (देवनागरीमा)</label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="बिच नाम देवनागरीमा राख्नुहोस" id="nmiddlename" name="nmiddlename"
                        value="{{ @$previousData->nmiddlename }}" />

                </div>
                <!--end::Col-->
                <div class="col-md-4 fv-row">
                    <label for="nlastname" class="fs-6 mb-2">थर (देवनागरीमा)</label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="थर देवनागरीमा राख्नुहोस" id="nlastname" name="nlastname"
                        value="{{ @$previousData->nlastname }}" />

                </div>
                <!--end::Col-->
            </div>
            <div class="row g2 mb-4">
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label for="efirstname" class="fs-6 mb-2">First Name </label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="नाम (अङ्ग्रेजी) राख्नुहोस" id="efirstname" name="efirstname"
                        value="{{ @$previousData->efirstname }}" />

                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label for="emiddlename" class="fs-6 mb-2">Middle Name </label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="बिच नाम (अङ्ग्रेजी) राख्नुहोस" id="emiddlename" name="emiddlename"
                        value="{{ @$previousData->emiddlename }}" />

                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label for="elastname" class="fs-6 mb-2">Last Name </label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="थर (अङ्ग्रेजी) राख्नुहोस" id="elastname" name="elastname"
                        value="{{ @$previousData->elastname }}" />

                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row g2 mb-4">
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label for="dateofbirthbs" class=" fs-6 mb-2">जन्म मिती (वि.स.) मा </label>
                    <input type="text" class="form-control form_input nepali-calendar form-control-solid"
                        placeholder="जन्म मिती (वि.स.)मा राख्नुहोस" id="dateofbirthbs" name="dateofbirthbs"
                        value="{{ @$previousData->dateofbirthbs }}" />

                </div>
                <!--end::Col-->
                <div class="col-md-4 fv-row">
                    <label for="dateofbirthad" class=" fs-6 mb-2">जन्म मिती (A.D.) मा </label>
                    <input type="date" class="form-control form_input form-control-solid"
                        placeholder="जन्म मिती (A.D)मा राख्नुहोस" id="dateofbirthad" name="dateofbirthad"
                        value="{{ @$previousData->dateofbirthad }}" />

                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label for="gender" class=" fs-6 mb-2">लिङ्ग </label>
                    <select class="form-control form_input form-control-solid" placeholder="लिङ्ग" id="gender"
                        name="gender" value="{{ @$previousData->gender }}">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>

                </div>
                <!--end::Col-->


            </div>
            <!--end::Input group-->



            <!--end::Input group-->
            <!--begin::Input group-->

            <div class="row g2 mb-4">
                <!--begin::Col-->
                <div class="col-md-4  fv-row">
                    <label for="citizenshipnumber" class=" fs-6 mb-2">नागरिकता नं </label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="नागरिकता नं राख्नुहोस" id="citizenshipnumber" name="citizenshipnumber"
                        value="{{ @$previousData->citizenshipnumber }}" />


                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4  fv-row">
                    <label for="citizenshipissuedistrictid" class=" fs-6 mb-2">जारी जिल्ला </label>
                    <select class="form-select  select2 form-select-solid" id="citizenshipissuedistrictid"
                        name="citizenshipissuedistrictid" style="padding: 4px;">
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
                    <label for="citizenshipissuedate" class=" fs-6 mb-2">जारी मिती </label>
                    <input type="text" class="form-control form_input nepali-calendar form-control-solid"
                        placeholder="नागरिकता जारी मिती राख्नुहोस" id="citizenshipissuedate"
                        name="citizenshipissuedate" value="{{ @$previousData->citizenshipissuedate }}" />

                </div>
                <!--end::Col-->

            </div>
            <div class="row g2 mb-4">
                <!--begin::Col-->
                <div class="col-md-4  fv-row">
                    <label for="motherfirstname" class=" fs-6 mb-2"> आमा को नाम (देवनागरीमा) </label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder=" आमाको नाम राख्नुहोस" id="motherfirstname" name="motherfirstname"
                        value="{{ @$previousData->motherfirstname }}" />

                </div>
                <div class="col-md-4  fv-row">
                    <label for="mothermiddlename" class=" fs-6 mb-2"> आमा बिच नाम (देवनागरीमा)</label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder=" आमाको नाम थर  राख्नुहोस" id="mothermiddlename" name="mothermiddlename"
                        value="{{ @$previousData->mothermiddlename }}" />

                </div>
                <!--end::Col-->
                <div class="col-md-4  fv-row">
                    <label for="motherlastname" class=" fs-6 mb-2">आमा थर (देवनागरीमा)</label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="आमाको नागरिता नं राख्नुहोस" id="motherlastname" name="motherlastname"
                        value="{{ @$previousData->motherlastname }}" />

                </div>
            </div>
            <div class="row g2 mb-4">
                <!--begin::Col-->
                <div class="col-md-4  fv-row">
                    <label for="fatherfirstname" class=" fs-6 mb-2"> बाबु को नाम (देवनागरीमा) </label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder=" बाबुको नाम   राख्नुहोस" id="fatherfirstname" name="fatherfirstname"
                        value="{{ @$previousData->fatherfirstname }}" />

                </div>
                <!--end::Col-->
                <div class="col-md-4  fv-row">
                    <label for="fathermiddlename" class=" fs-6 mb-2">बाबु बिच नाम (देवनागरीमा)</label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="बाबुको बिच नाम (देवनागरीमा)" id="fathermiddlename" name="fathermiddlename"
                        value="{{ @$previousData->fathermiddlename }}" />

                </div>
                <div class="col-md-4  fv-row">
                    <label for="fatherlastname" class=" fs-6 mb-2">बाबु थर (देवनागरीमा)</label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="बाबुको थर (देवनागरीमा)" id="fatherlastname" name="fatherlastname"
                        value="{{ @$previousData->fatherlastname }}" />

                </div>

            </div>
            <div class="row g2 mb-4">
                <!--begin::Col-->
                <div class="col-md-4  fv-row">
                    <label for="grandfatherfirstname" class=" fs-6 mb-2"> बाजेको नाम (देवनागरीमा) </label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="बाजेको नाम राख्नुहोस" id="grandfatherfirstname" name="grandfatherfirstname"
                        value="{{ @$previousData->grandfatherfirstname }}" />

                </div>
                <!--end::Col-->
                <div class="col-md-4  fv-row">
                    <label for="grandfathermiddlename" class=" fs-6 mb-2"> बाजे बिच नाम (देवनागरीमा) </label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder=" बाजे बिच नाम (देवनागरीमा)" id="grandfathermiddlename"
                        name="grandfathermiddlename" value="{{ @$previousData->grandfathermiddlename }}" />

                </div>
                <!--end::Col-->
                <div class="col-md-4  fv-row">
                    <label for="grandfatherlastname" class=" fs-6 mb-2"> बाजेको थर (देवनागरीमा)</label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder=" बाजेको नाम थर  राख्नुहोस" id="grandfatherlastname" name="grandfatherlastname"
                        value="{{ @$previousData->grandfatherlastname }}" />

                </div>
                <!--end::Col-->

            </div>
            <div class="row g2 mb-4">
                <div class="col-md-12 fv-row form_btn">
                    <button type="button" name="submit" id="savePersonalDetail" style="float: right">Next</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $('.nepali-calendar').nepaliDatePicker({
        npdMonth: true,
        npdYear: true,
        language: 'nepali',
        unicodeDate: true,
        npdYearCount: 100 // Options | Number of years to show
    });
</script>

<script>
    $(document).ready(function() {
        $(document).off('click', '#savePersonalDetail');
        $(document).on('click', '#savePersonalDetail', function() {

            $('#personalSetupForm').ajaxSubmit({
                dataType: 'json',
                success: function(response) {
                    responseData = response[0];
                    if (responseData.success) {
                        navigaterTo(responseData.redirectUrl);
                        $.notify(responseData.message, 'success');
                    } else {
                        $.notify(responseData.message, 'error');
                    }
                }
            });
        })
    })
</script>


<script>
    $(document).ready(function() {
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
            })
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
            })
        });


    })

    $(document).ready(function() {
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


    })
</script>
