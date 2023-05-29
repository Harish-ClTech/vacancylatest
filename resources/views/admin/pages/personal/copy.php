@extends('admin.layouts.admin_designs')

@section('siteTitle')
    पालिका सेटअप
@endsection

@section('content')
<div class="m-12">
    <form id="personalSetupForm" method="post" class="form" enctype="multipart/form-data" action="{{ @$saveurl }}">
        <input type="hidden" value="{{ @$previousData->userid }}" name="userid" />
        <input type="hidden" value="{{ @$previousData->id }}" name="personaldetailid" />
        <!--begin::Heading-->
        <div class="mb-13 text-center">
            <!--begin::Title-->
            <h1 class="mb-3">व्यक्तिगत विवरण फारम</h1>
            <!--end::Title-->
        </div>
        <!--end::Heading-->
        <div class="row g2 mb-2">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label for="fullnameindevenagarik" class="fs-6 fw-bold mb-2">नाम थर (देवनागरीमा)</label>
                <input type="text" class="form-control form-control-solid" placeholder="नाम थर देवनागरीमा राख्नुहोस"
                    id="fullnameindevenagarik" name="fullnameindevenagarik" value="{{ @$previousData->fullnameindevenagarik }}" />
    
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label for="fullnameinenglish" class="fs-6 fw-bold mb-2">नाम थर (अङ्ग्रेजी) </label>
                <input type="text" class="form-control form-control-solid" placeholder="नाम थर (अङ्ग्रेजी) राख्नुहोस"
                    id="fullnameinenglish" name="fullnameinenglish" value="{{ @$previousData->fullnameinenglish }}" />
    
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
    
        <!--begin::Input group-->
        <div class="row g2 mb-2">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label for="dateofbirth" class=" fs-6 fw-bold mb-2">जन्म मिती (वि.स.) मा </label>
                <input type="text" class="form-control form-control-solid" placeholder="जन्म मिती (वि.स.)मा राख्नुहोस"
                    id="dateofbirth" name="dateofbirth" value="{{ @$previousData->dateofbirth }}" />
    
            </div>
            <!--end::Col-->
    
        </div>
        <!--end::Input group-->
    
        <!--begin::Input group-->
        <div class="row g2 mb-2">
    
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label for="language" class="required fs-6 fw-bold mb-2">मातृभाषा</label>
                <input type="text" class="form-control form-control-solid" placeholder="मातृभाषा राख्नुहोस"
                    id="language" name="language" value="{{ @$previousData->language }}" />
    
            </div>
            <!--end::Col-->
    
        </div>
    
        <!--end::Input group-->
        <!--begin::Input group-->
    
        <div class="row g2 mb-2">
            <!--begin::Col-->
            <div class="col-md-3  fv-row">
                <label for="citizenshipnumber" class=" fs-6 fw-bold mb-2">नागरिकता नं </label>
                <input type="text" class="form-control form-control-solid" placeholder="नागरिकता नं राख्नुहोस"
                    id="citizenshipnumber" name="citizenshipnumber" value="{{ @$previousData->citizenshipnumber }}" />

    
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-3  fv-row">
                <label for="citizenshipissuedistrictid" class=" fs-6 fw-bold mb-2">जारी जिल्ला </label>
                <select class="form-select  select2 form-select-solid" id="citizenshipissuedistrictid" name="citizenshipissuedistrictid" style="padding: 4px;">
                        <option value="">जिल्ला छान्नुहोस्</option>
                        @foreach ($districts as $district)
                            <option value="{{ @$district->id }}" {{ $district->id==@$previousData->citizenshipissuedistrictid ? "selected" : " "}}>{{ @$district->districtname }}</option>
                        @endforeach
                </select>
    
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6  fv-row">
                <label for="citizenshipissuedate" class=" fs-6 fw-bold mb-2">जारी मिती </label>
                <input type="text" class="form-control form-control-solid" placeholder="नागरिकता जारी मिती राख्नुहोस"
                    id="citizenshipissuedate" name="citizenshipissuedate"
                    value="{{ @$previousData->citizenshipissuedate }}" />
    
            </div>
            <!--end::Col-->
    
        </div>
        <div class="row g2 mb-2">
            <span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">स्थायी ठेगाना </span>
        </div>
        <div class="row g2 mb-2">
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="provinceid" class=" fs-6 fw-bold mb-2">प्रदेश </label>
                <select class="form-select form-select-solid" id="provinceid" name="provinceid" style="padding: 4px;">
                    <option value="">प्रदेश छान्नुहोस्</option>
                    @foreach ($provinces as $province)
                        <option value="{{ @$province->id }}" {{ $province->id==@$previousData->provinceid ? "selected" : " "}}>{{ @$province->provincename }}</option>
                    @endforeach
                </select>
    
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="districtid" class=" fs-6 fw-bold mb-2">स्थायी जिल्ला </label>
                <select class="form-select districtdata form-select-solid" id="districtid" name="districtid"
                style="padding: 4px;" data-districtid="{{@$previousData->districtid}}">
                <option value="" selected>जिल्ला छान्नुहोस्</option>
            </select>
            </div>
            <!--end::Col-->
            <div class="col-md-4  fv-row">
                <label for="municipalityid" class=" fs-6 fw-bold mb-2"> नगरपालिका </label>
                <select class="form-select vdcormunicipalitydata form-select-solid" id="municipalityid"
                name="municipalityid" style="padding: 4px;" data-municipalityid="{{@$previousData->municipalityid}}">
                <option value="" selected>पालिकाको नाम छान्नुहोस्</option>
            </select>
    
            </div>
          
    
    
        </div>
        <div class="row g2 mb-2">
           
              <!--end::Col-->
              <div class="col-md-4  fv-row">

                <label for="wordnumber" class=" fs-6 fw-bold mb-2">वार्ड नं </label>
                <input type="text" class="form-control form-control-solid" placeholder=" वार्ड नं   राख्नुहोस"
                    id="wordnumber" name="wordnumber" value="{{ @$previousData->wordnumber }}" />

            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="tole" class=" fs-6 fw-bold mb-2">टोल </label>
                <input type="text" class="form-control form-control-solid" placeholder=" टोल  राख्नुहोस"
                    id="tole" name="tole" value="{{ @$previousData->tole }}" />
            </div>
        </div>
        <div class="row g2 mb-2">
            <span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">पत्राचार गर्ने ठेगाना </span>
        </div>
        <div class="row g2 mb-2">
            <div class="col-md-4  fv-row">
                <label for="mailingprovinceid" class=" fs-6 fw-bold mb-2">प्रदेश </label>
                    <select class="form-select form-select-solid" id="mailingprovinceid" name="mailingprovinceid" style="padding: 4px;">
                        <option value="">प्रदेश छान्नुहोस्</option>
                        @foreach ($provinces as $province)
                            <option value="{{ @$province->id }}" {{ $province->id==@$previousData->mailingprovinceid ? "selected" : " "}}>{{ @$province->provincename }}</option>
                        @endforeach
                    </select>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="contactdistrict" class=" fs-6 fw-bold mb-2"> जिल्ला </label>
                <select class="form-select mailingdistrictdata form-select-solid" id="mailingdistrictid" name="mailingdistrictid"
                style="padding: 4px;" data-mailingdistrictid="{{@$previousData->mailingdistrictid}}">
                <option value="" selected>जिल्ला छान्नुहोस्</option>
            </select>
    
            </div>
            <!--end::Col-->
            <div class="col-md-4  fv-row">
                <label for="contactvdc" class=" fs-6 fw-bold mb-2"> नगरपालिका </label>
                <select class="form-select mailingvdcormunicipalitydata form-select-solid" id="mailingmunicipalityid"
                name="mailingmunicipalityid" style="padding: 4px;" data-mailingmunicipalityid="{{@$previousData->mailingmunicipalityid}}">
                <option value="" selected>पालिकाको नाम छान्नुहोस्</option>
            </select>
    
            </div>
            <!--end::Col-->

    
    
        </div>
        <div class="row g2 mb-2">
            <div class="col-md-4  fv-row">

                <label for="mailingword" class=" fs-6 fw-bold mb-2">वार्ड नं </label>
                <input type="text" class="form-control form-control-solid"
                    placeholder="पत्राचार गर्ने वार्ड नं   राख्नुहोस" id="mailingword" name="mailingword"
                    value="{{ @$previousData->mailingword }}" />

            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="mailingtole" class=" fs-6 fw-bold mb-2">टोल </label>
                <input type="text" class="form-control form-control-solid" placeholder="पत्राचार गर्ने टोल  राख्नुहोस"
                    id="mailingtole" name="mailingtole" value="{{ @$previousData->mailingtole }}" />
    
            </div>
        </div>
    
        <div class="row g2 mb-2">
            <!--begin::Col-->
            <div class="col-md-4  fv-row">
                <label for="phonenumber" class=" fs-6 fw-bold mb-2"> फोन नं  </label>
                <input type="text" class="form-control form-control-solid"
                    placeholder=" पत्राचार गर्ने फोन नं राख्नुहोस" id="phonenumber" name="phonenumber"
                    value="{{ @$previousData->phonenumber }}" />
    
            </div>
            <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4  fv-row">
                        <label for="mobilenumber" class=" fs-6 fw-bold mb-2"> मोबाईल नं  </label>
                        <input type="text" class="form-control form-control-solid"
                            placeholder=" पत्राचार गर्ने मोबाईल नं राख्नुहोस" id="mobilenumber" name="mobilenumber"
                            value="{{ @$previousData->mobilenumber }}" />
            
                    </div>
                    <!--end::Col-->
            <div class="col-md-4  fv-row">
                <label for="email" class=" fs-6 fw-bold mb-2"> ईमेल </label>
                <input type="text" class="form-control form-control-solid"
                    placeholder="पत्राचार गर्ने ईमेल  राख्नुहोस" id="email" name="email"
                    value="{{ @$previousData->email }}" />
    
            </div>
    
        </div>
        <div class="row g2 mb-2">
            <!--begin::Col-->
            <div class="col-md-6  fv-row">
                <label for="motherfullname" class=" fs-6 fw-bold mb-2"> आमा को नाम थर  </label>
                <input type="text" class="form-control form-control-solid"
                    placeholder=" आमाको नाम थर  राख्नुहोस" id="motherfullname" name="motherfullname"
                    value="{{ @$previousData->motherfullname }}" />
    
            </div>
            <!--end::Col-->
            <div class="col-md-6  fv-row">
                <label for="mohtercitizenshipnumber" class=" fs-6 fw-bold mb-2"> नागरिता नं </label>
                <input type="text" class="form-control form-control-solid"
                    placeholder="आमाको नागरिता नं राख्नुहोस" id="mohtercitizenshipnumber" name="mohtercitizenshipnumber"
                    value="{{ @$previousData->mohtercitizenshipnumber }}" />
    
            </div>
    
        </div>
        <div class="row g2 mb-2">
            <!--begin::Col-->
            <div class="col-md-6  fv-row">
                <label for="fatherfullname" class=" fs-6 fw-bold mb-2"> बाबु को नाम थर  </label>
                <input type="text" class="form-control form-control-solid"
                    placeholder=" बाबुको नाम थर  राख्नुहोस" id="fatherfullname" name="fatherfullname"
                    value="{{ @$previousData->fatherfullname }}" />
    
            </div>
            <!--end::Col-->
            <div class="col-md-6  fv-row">
                <label for="fathercitizenshipnumber" class=" fs-6 fw-bold mb-2"> नागरिता नं </label>
                <input type="text" class="form-control form-control-solid"
                    placeholder="बाबुको नागरिता नं राख्नुहोस" id="fathercitizenshipnumber" name="fathercitizenshipnumber"
                    value="{{ @$previousData->fathercitizenshipnumber }}" />
    
            </div>
    
        </div>
        <div class="row g2 mb-2">
            <!--begin::Col-->
            <div class="col-md-6  fv-row">
                <label for="grandfatherfullname" class=" fs-6 fw-bold mb-2"> बाजे को नाम थर  </label>
                <input type="text" class="form-control form-control-solid"
                    placeholder=" बाजेको नाम थर  राख्नुहोस" id="grandfatherfullname" name="grandfatherfullname"
                    value="{{ @$previousData->grandfatherfullname }}" />
    
            </div>
            <!--end::Col-->
            <div class="col-md-6  fv-row">
                <label for="grandfathercitizenshipnumber" class=" fs-6 fw-bold mb-2"> नागरिता नं </label>
                <input type="text" class="form-control form-control-solid"
                    placeholder="बाजेको नागरिता नं राख्नुहोस" id="grandfathercitizenshipnumber" name="grandfathercitizenshipnumber"
                    value="{{ @$previousData->grandfathercitizenshipnumber }}" />
    
            </div>
    
        </div>
        <div class="row g2 mb-2">
            <!--begin::Col-->
            <div class="col-md-6  fv-row">
                <label for="husbandorwifefullname" class=" fs-6 fw-bold mb-2"> विवाहित भएमा पति/पत्नी को नाम थर   </label>
                <input type="text" class="form-control form-control-solid"
                    placeholder=" विवाहित भएमा पति/पत्नी को नाम थर  राख्नुहोस" id="husbandorwifefullname" name="husbandorwifefullname"
                    value="{{ @$previousData->husbandorwifefullname }}" />
    
            </div>
            <!--end::Col-->
            <div class="col-md-6  fv-row">
                <label for="husbandorwifecitizenshipnumber" class=" fs-6 fw-bold mb-2"> नागरिता नं </label>
                <input type="text" class="form-control form-control-solid"
                    placeholder="विवाहित भएमा पति/पत्नी को नागरिता नं राख्नुहोस" id="husbandorwifecitizenshipnumber" name="husbandorwifecitizenshipnumber"
                    value="{{ @$previousData->husbandorwifecitizenshipnumber }}" />
    
            </div>
    
        </div>

        <div class="row g2 mb-4">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
            </div>
            <div class="col-md-6 fv-row">
                <button class="btn btn-primary float-right" type="button" name="submit" id="savePersonalDetail">Save</button>
            </div>
        </div>


    </form>
</div>

@endsection

@section('scripts')
    <script>

        $(document).ready(function() {
            $(document).off('click', '#savePersonalDetail');
            $(document).on('click', '#savePersonalDetail', function() {

                $('#personalSetupForm').ajaxSubmit({
                    dataType: 'json',
                    success: function(response) {
                        if (response.type == 'success') {
                            $.notify(response.message, 'success');
                        } else {
                            $.notify(response.message, 'error');



                        }
                    }
                });
            })
        })
    </script>


    <script>
        $(document).ready(function() {
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


        })

        $(document).ready(function() {
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


        })
    </script>
@endsection
