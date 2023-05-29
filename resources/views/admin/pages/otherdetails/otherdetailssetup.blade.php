<div class="content_box">
    <form id="extraDetailsForm" method="post" class="form" enctype="multipart/form-data"
        action="{{ @$saveurl }}">
        <input type="hidden" value="{{ @$previousData->id }}" name="extradetailid" />
        <div class="form_tab_bk"style="padding:45px !important; margin-top:20px !important;">
            
            <div class="row g2 mb-4">
                <!--begin::Col-->

                <div class="col-md-3 fv-row">
                    <label for="cast" class="required fs-6 fw-bold mb-2">जात</label>
                    <select class="" id="cast" name="cast"
                    style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important;     height: 45px;
    color: #5e6278;">
                        <option value="" selected>जात छान्नुहोस्</option>
                        <option value="Brahmin/Chhetrri"
                            {{ @$previousData->cast == 'Brahmin/Chhetrri' ? 'selected' : '' }}>
                            Brahmin/Chhetrri</option>
                        <option value="Janajaati"
                            {{ @$previousData->cast == 'Janajaati' ? 'selected' : '' }}>Janajaati
                        </option>
                        <option value="Dalit" {{ @$previousData->cast == 'Dalit' ? 'selected' : '' }}>
                            Dalit
                        </option>
                            <option value="Others" {{ @$previousData->cast == 'Others' ? 'selected' : '' }}>
                            Others
                        </option>
                    </select>

                </div>
                <!--end::Col-->
                <!--end::Col-->
                <div class="col-md-3 fv-row">
                    <label for="casteother" class="fs-6 fw-bold mb-2">अन्य जात</label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="अन्य जात" id="casteother" name="casteother"
                        value="{{ @$previousData->casteother }}" />

                </div>
                <!--end::Col-->
                <div class="col-md-3 fv-row">
                    <label for="religion" class="required fs-6 fw-bold mb-2">धर्म</label>
                    <select type="select" class="" style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important;     height: 45px;
    color: #5e6278;" id="religion"
                        name="religion">
                        <option value="" selected>धर्म छान्नुहोस्</option>

                        <option value="Hindu"
                            {{ @$previousData->religion == 'Hindu' ? 'selected' : '' }}>
                            Hindu</option>
                            <option value="Buddhist"
                            {{ @$previousData->religion == 'Buddhist' ? 'selected' : '' }}>
                            Buddhist</option>
                        <option value="Muslim"
                            {{ @$previousData->religion == 'Muslim' ? 'selected' : '' }}>
                            Muslim</option>
                        <option value="christian"
                            {{ @$previousData->religion == 'christian' ? 'selected' : '' }}>christian
                        </option>
                        <option value="Others"
                            {{ @$previousData->religion == 'Others' ? 'selected' : '' }}>
                            Others</option>

                    </select>
                </div>
                <!--end::Col-->
                <div class="col-md-3 fv-row">
                    <label for="religionother" class=" fs-6 fw-bold mb-2">अन्य धर्म</label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="अन्य धर्म" id="religionother" name="religionother"
                        value="{{ @$previousData->religionother }}" />

                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <div class="row g2 mb-4">
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label for="motherlanguage" class="required fs-6 fw-bold mb-2">मातृभाषा</label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="मातृभाषा" id="motherlanguage" name="motherlanguage"
                        value="{{ @$previousData->motherlanguage }}" />

                </div>

                <!--end::Col-->
                <div class="col-md-4 fv-row">
                    <label for="employmentstatus" class="required fs-6 fw-bold mb-2">रोजगारी अवस्था </label>
                    <select type="select" class=""style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important;     height: 45px;
    color: #5e6278;"
                        placeholder="रोजगारी अवस्था " id="employmentstatus" name="employmentstatus">
                        <option value="" selected>रोजगारी अवस्था छान्नुहोस्</option>
                        <option value="Employeed"
                            {{ @$previousData->employmentstatus == 'Employeed' ? 'selected' : '' }}>
                            Employeed</option>
                        <option value="Unemployeed"
                            {{ @$previousData->employmentstatus == 'Unemployeed' ? 'selected' : '' }}>
                            Unemployeed</option>
                        <option value="Others"
                            {{ @$previousData->employmentstatus == 'Others' ? 'selected' : '' }}>Others
                        </option>

                    </select>
                </div>
                <!--end::Col-->
                <div class="col-md-4 fv-row">
                    <label for="employmetothers" class="fs-6 fw-bold mb-2">अन्य रोजगारी </label>
                    <input type="text" class="form-control form_input form-control-solid"
                        placeholder="अन्य रोजगारी " id="employmetothers" name="employmetothers"
                        value="{{ @$previousData->employmetothers }}" />

                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row g2 mb-4">

                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label for="maritalstatus" class="required fs-6 fw-bold mb-2">वैवाहिक स्थिति</label>
                    <select type="select" class="" style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important;     height: 45px;
    color: #5e6278;"
                        placeholder="वैवाहिक स्थिति" id="maritalstatus" name="maritalstatus">
                        <option value="" selected>वैवाहिक स्थिति छान्नुहोस्</option>
                        <option value="Married"
                            {{ @$previousData->maritalstatus == 'Married' ? 'selected' : '' }}>Married
                        </option>
                        <option value="Single"
                            {{ @$previousData->maritalstatus == 'Single' ? 'selected' : '' }}>Single
                        </option>
                        <option value="Divorcee"
                            {{ @$previousData->maritalstatus == 'Divorcee' ? 'selected' : '' }}>Divorcee
                        </option>
                    </select>

                </div>                            
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <label for="spousename" class=" fs-6 fw-bold mb-2">विवाहित भएमा पति/पत्नीको नाम थर
                        </label>
                        <input type="text" class="form-control form_input form-control-solid"
                        placeholder="विवाहित भएमा पति/पत्नीको नाम थर" id="spousename" name="spousename"
                        value="{{ @$previousData->spousename }}" />
                </div> 

                <div class="col-md-4 fv-row">
                    <label for="spousecitizen" class="fs-6 fw-bold mb-2">पति/पत्नीको नागरिकता नं.
                        </label>
                        <input type="text" class="form-control form_input form-control-solid"
                        placeholder="पति/पत्नीको नागरिकता नं." id="spousecitizen" name="spousecitizen"
                        value="{{ @$previousData->spousecitizen }}" />
                </div> 
                <!--end::Col-->

            </div>
        </div>
    </form>
    <div class="col-md-12 ">
        @if ((auth()->user()->is_submitted == 0) || (auth()->user()->is_submitted == 1 and auth()->user()->other_enabled == 1))
            <div class="btn_flx" style="justify-content: end;">
                {{-- <button class="btn_prev" type="button" onclick="navigaterTo('personal')">Previous</button> --}}
                <button class="btn_save" type="button" id="saveOtherDetail" style="float: right">Next</button>
            </div>
        @endif
    </div>
  
</div>

<script>
    $(document).ready(function() {

        // save other details
        $(document).off('click', '#saveOtherDetail');
        $(document).on('click', '#saveOtherDetail', function() {
            $('#extraDetailsForm').ajaxSubmit({
                dataType: 'json',
                success: function(response) {
                    responseData = response[0];
                    if (responseData.success) {
                        getProfileID();
                        gotToTab('#contact');
                        $.notify(responseData.message, 'success');
                    } else {
                        $.notify(responseData.message, 'error');
                    }
                }
            });
        });


        // get provinces
        $(document).off('click', '#provinceid');
        $(document).on('click', '#provinceid', function() {

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


        // get mailing provinces
        $(document).off('click', '#mailingprovinceid');
        $(document).on('click', '#mailingprovinceid', function() {

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


        // get districts 
        $(document).off('click', '#districtid');
        $(document).on('click', '#districtid', function() {

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


        // get maailing districts
        $(document).off('click', '#mailingdistrictid');
        $(document).on('click', '#mailingdistrictid', function() {

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
