
<head>
    <style>
        .row_custom{
            padding: 0px 15px;
        margin-bottom: 15px !important;
        }
        .row_custom .col-md-12{
            padding: 15px;
        box-shadow: 0px 0px 5px rgb(0 0 0 / 20%);
        }
        table{
            border: none;

        }
        .title_add{
            padding: 0px 15px;
            margin-top: 15px;
            margin-bottom: 8px;
            margin-bottom: 8px;
        }
        .title_add span{
        border-bottom: 1px solid #ddd; color: #3C2784; font-size: 18px; font-weight: 600; display: inline;
        }
        table td span{
            font-weight: 600;
        padding-left: 15px;
        }
        .requestAccess:hover{
            cursor:pointer;
            transition: 0.3s ease-in-out;
            -ms-transform: rotate(5deg);
            transform: rotate(5deg);
        }
    </style>
</head>

<div class="post d-flex flex-column-fluid" style="width:100%;" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Card-->
        <div  style="border: 0; border-radius: 5px;">
            {{-- Begin: NOTICE --}}
            <div class="row g2 mb-2 title_add">
                <div class="alert alert-danger" style="color: #0D4A71;background-color: #83cef72e;" role="alert">
                    NOTE :- यदी तपाईं आफ्नो कुनै विवरणहरु परिवर्तन गर्न चाहनुहुन्छ भने <label class="text-primary">Request Change</label> मा थिच्नुहोस् । परिवर्तन गर्नुभएको विवरणहरु Save गर्न <label class="text-success">Complete</label> मा थिच्नुहोस् ।
                </div>
            </div>
            {{-- End: NOTICE --}}
            {{-- Personal details --}}
            <div class="row g2 mb-2 title_add">
                <span class="mx-0 px-0" style="">ब्यतिगत विवारण </span>
            </div>
            <div class="row g2 mb-2 row_custom" style="width: 20%;  margin: 0px auto;">
                <div class="col-md-12" style="box-shadow: 0px 0px 4px rgba(0,0,0,0.2); display: flex; justify-content: center;">
                    <img src="{{asset('uploads/document/photography').'/'.@$documentImage->photography}}" style="width: 100px;"
                        alt="">
                </div>
            </div>

            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr>
                            <td><strong> नाम देवनगरिमा :</strong><span>{{ @$profile->nfirstname . ' ' . @$profile->nmiddlename . ' ' . @$profile->nlastname ?? "नाम देवनगरिमा"}}</span></td>
                            <td></td>
                            <td><strong> नाम अग्रेजि :</strong><span>{{ @$profile->efirstname . ' ' . @$profile->emiddlename . ' ' . @$profile->elastname ?? "नाम अग्रेजि"  }}</span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong> लिङ्ग :</strong><span>{{ @$profile->gender ?? "Gender" }}</span></td>
                            <td></td>
                            <td><strong> जन्म मिती (B.S.):</strong><span>{{ @$profile->dateofbirthbs ?? "-" }}</span></td>
                            <td><strong> जन्म मिती (A.D.):</strong><span>{{ @$profile->dateofbirthad ?? "-" }}</span></td>
                            <td><strong> उमेर :</strong><span>{{ @$agead ?? "Age" }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr>
                            <td><strong> नागरिकता नं :</strong><span>{{ @$profile->citizenshipnumber}}</span></td>
                            <td><strong> जारी जिल्ला :</strong><span>{{ @$profile->districtname}}</span></td>
                            <td><strong> नागरिकता जारी मिती :</strong><span>{{ @$profile->citizenshipissuedate }}</span></td>
                            <td><strong> मातृभाषा :</strong><span>{{ @$extraDetails->motherlanguage }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr>
                            <td><strong> जात :</strong><span>{{ @$extraDetails->cast }}</span></td>
                            <td><strong> धर्म :</strong><span>{{ @$extraDetails->religion }}</span></td>
                            <td><strong> मातृभाषा :</strong><span>{{ @$extraDetails->motherlanguage }}</span></td>
                            <td><strong> रोजगारी अवस्था :</strong><span>{{ @$extraDetails->employmentstatus }}</span></td>
                        </tr>
                        <tr>
                            <td><strong> वैवाहिक स्थिति :</strong><span>{{ @$extraDetails->maritalstatus }}</span></td>
                            <td><strong> विवाहित भएमा पति/पत्नीको नाम थर :</strong><span>{{ @$extraDetails->spousename }}</span></td>
                            <td><strong> पति/पत्नीको नागरिकता नं. :</strong><span>{{ @$extraDetails->spousecitizen }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>


            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr>
                            <td><strong> बाबुको नाम :</strong><span>{{ @$profile->fatherfirstname . ' ' . @$profile->fathermiddlename . ' ' . @$profile->fatherlastname ??  "-" }}</span></td>
                            <td><strong> आमाको नाम :</strong><span>{{ @$profile->motherfirstname . ' ' . @$profile->mothermiddlename . ' ' . @$profile->motherlastname ?? "-" }}</span></td>
                            <td><strong> बाजेको नाम :</strong><span>{{ @$profile->grandfatherfirstname . ' ' . @$profile->grandfathermiddlename . ' ' . @$profile->grandfatherlastname ?? "-" }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div>
            @if (auth()->user()->is_submitted == 1)
                <label class="text-primary requestAccess" data-field="Personal" data-action="request">Request Change</label> / <label class="text-success requestAccess" data-field="Personal" data-action="verify">Complete</label>
            @endif
            </div>
            {{-- Personal  details End --}}

            <div class="row g2 mb-2 title_add">
                <span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">स्थाई ठेगाना</span>
            </div>
            
            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr>
                            <td><strong> प्रदेश :</strong><span>{{ @$contactDetails->provincename }}</span></td>
                            <td><strong> स्थायी जिल्ला:</strong><span>{{ @$contactDetails->districtname }}</span></td>
                            <td><strong> नगरपालिका:</strong><span>{{ @$contactDetails->vdcormunicipalitiename }}</span></td>
                            <td><strong> वार्ड नं :</strong><span>{{ @$contactDetails->ward }}</span></td>
                        </tr>
                        <tr>
                            <td><strong> टोल :</strong><span>{{ @$contactDetails->tole }}</span></td>
                            <td><strong> मार्ग:</strong><span>{{ @$contactDetails->marga }}</span></td>
                            <td></td>
                            <td><strong> घर नम्बर:</strong><span>{{ @$contactDetails->housenumber }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row g2 mb-2 title_add">
                <span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">अस्थायी ठेगाना</span>
            </div>

            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr>
                            <td><strong> प्रदेश :</strong><span>{{ @$contactDetails->tempprovincename }}</span></td>
                            <td><strong> स्थायी जिल्ला:</strong><span>{{ @$contactDetails->tempdistrictname }}</span></td>
                            <td><strong> नगरपालिका:</strong><span>{{ @$contactDetails->tempvdcormunicipalitiename }}</span></td>
                            <td><strong> वार्ड नं :</strong><span>{{ @$contactDetails->tempoward }}</span></td>
                        </tr>
                        <tr>
                            <td><strong> टोल:</strong><span>{{ @$contactDetails->tempotole }}</span></td>
                            <td><strong> मार्ग</strong><span>{{ @$contactDetails->tempoward }}</span></td>
                            <td><strong> घर नम्बर:</strong><span>{{ @$contactDetails->tempohousenumber }}</span></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr>
                            <td><strong> फोन नम्बर :</strong><span>{{ @$contactDetails->tempophonenumber }}</span></td>
                            <td><strong> मोबाइल नम्बर :</strong><span>{{ @$emailphone->contactnumber }}</span></td>
                            <td><strong> Email :</strong><span>{{ @$emailphone->email }}</span></td>
                            <td></td>
                            <td><strong> पत्राचार ठेगाना :</strong><span>{{ @$contactDetails->maillingaddress }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div>
            @if (auth()->user()->is_submitted == 1)
                <label class="text-primary requestAccess" data-field="Contact" data-action="request">Request Change</label> / <label class="text-success requestAccess" data-field="Contact" data-action="verify">Complete</label>
            @endif
            </div>

            {{-- Educational details --}}
            <div class="row g2 mb-2 title_add">
                <span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">शैक्षिक विवरण</span>
            </div>

            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr style="background: #3C2784; color:#fff;">
                           <th>कलेज/विद्यालय/संस्थाको नाम</th>
                           <th>विश्वविद्यालय / बोर्ड नाम</th>
                           <th>उतिर्ण गरेको परिक्षा/ स्तर</th>
                           <th>संकाय</th>
                           <th>कुल अंक/प्रतिशत/श्रेणि</th>
                           <th>प्रमुख विषयहरू</th>
                        </tr>
                        @foreach(@$educationDetails as $eduval)
                        <tr>
                           <td>{{$eduval->educationinstitution}}</td>
                           <td>{{$eduval->universityboardname}}</td>
                           <td>{{$eduval->name}}</td>
                           <td>{{$eduval->educationfaculty}}</td>
                           <td>{{$eduval->devisiongradepercentage}}</td>
                           <td>{{$eduval->mejorsubject}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div>
            @if (auth()->user()->is_submitted == 1)
                <label class="text-primary requestAccess" data-field="Education" data-action="request">Request Change</label> / <label class="text-success requestAccess" data-field="Education" data-action="verify">Complete</label>
            @endif
            </div>
            {{-- Educational details end --}}

            {{-- Training details --}}
            <div class="row g2 mb-2 title_add">
                <span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">तालिम विवरण</span>
            </div>
            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                    <tr style="background: #3C2784; color:#fff;">
                           <th>तालिम प्रदायकको नाम</th>
                           <th>तालिमको विषय</th>
                           <th>ग्रेड/प्रतिशत </th>
                           <th>अवधि देखि </th>
                            <th>अवधि सम्म </th>
                        </tr>
                        @foreach($trainingDetails as $traval)
                        <tr>
                           <td>{{$traval->trainingproviderinstitutionalname}}</td>
                           <td>{{$traval->trainingname}}</td>
                           <td>{{$traval->gradedivisionpercent}}</td>
                           <td>{{$traval->fromdatebs}}</td>
                           <td>{{$traval->enddatebs}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>
            <div>
            @if (auth()->user()->is_submitted == 1)
                <label class="text-primary requestAccess" data-field="Training" data-action="request">Request Change</label> / <label class="text-success requestAccess" data-field="Training" data-action="verify">Complete</label>
            @endif
            </div>
            {{-- Training details end --}}

            {{-- Experience details --}}
            <div class="row g2 mb-2 title_add">
                <span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">अनुभव विवरण</span>
            </div>
            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                    <tr style="background: #3C2784; color:#fff;">
                           <th>कार्यालय</th>
                           <th>कार्यालय ठेगाना</th>
                           <th>पद</th>
                           <th>तह</th>
                           <th>सेवा/समूह </th>
                           <th>सुरू मिति  </th>
                           <th>अन्त्य मिति</th>
                           <th>कार्य विवरण</th>
                        </tr>
                        @foreach($experienceDetails as $expval)
                        <tr>
                           <td>{{$expval->officename}}</td>
                           <td>{{$expval->officeaddress}}</td>
                           <td>{{$expval->designation}}</td>
                           <td>{{$expval->ranklabel}}</td>
                           <td>{{$expval->service}}/{{$expval->group}}</td>
                           <td>{{$expval->fromdatebs}}</td>
                           <td>{{$expval->enddatebs}}</td>
                           <td>{{$expval->workingstatus}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div>
            @if (auth()->user()->is_submitted == 1)
                <label class="text-primary requestAccess" data-field="Experiences" data-action="request">Request Change</label> / <label class="text-success requestAccess" data-field="Experiences" data-action="verify">Complete</label>
            @endif
            </div>
            {{-- Experience details end --}}

             {{-- Document details --}}
             <div class="row g2 mb-2 title_add">
                <span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">कागजात विवरण</span>
            </div>
            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                    <tr style="background: #3C2784; color:#fff;">
                            <th>नागरिकता (अगाडि)</th>
                            <th>नागरिकता (पछाडि)</th>
                            <th>हस्ताक्षर</th>
                            <th>अपाङ्ग</th>
                            <th>आदिबासी तथा जनजाती </th>
                            <th>दलित</th>
                            <th>पिछडियेको</th>
                            <th>मधेसी</th>
                        </tr>
                        <tr>
                            <td>
                                @if (!empty($documentImage->citizenshipfront))
                                    <a style="padding-left:10px;" title="{{ @$documentImage->citizenshipfront }}"
                                        href="{{ asset('uploads/document/citizenshipfront/' . @$documentImage->citizenshipfront) }}" image target="__blank"><i
                                            class="fa fa-download"></i></a>
                                @endif
                            </td>
                            <td>
                                @if (!empty($documentImage->citizenshipback))
                                    <a style="padding-left:10px;" title="{{ @$documentImage->citizenshipback }}"
                                        href="{{ asset('uploads/document/citizenshipback/' . @$documentImage->citizenshipback) }}" image target="__blank"><i
                                            class="fa fa-download"></i></a>
                                @endif
                            </td>
                            <td>
                                @if (!empty($documentImage->signature))
                                    <a style="padding-left:10px;" title="{{ @$documentImage->signature }}"
                                        href="{{ asset('uploads/document/signature/' . @$documentImage->signature) }}" image target="__blank"><i
                                            class="fa fa-download"></i></a>
                                @endif
                            </td>                            
                            <td>
                                @if (!empty($documentImage->disabilitydocument))
                                    <a style="padding-left:10px;"
                                        title="{{ @$documentImage->disabilitydocument }}"
                                        href="{{ asset('uploads/document/inclusiongroupcertificate/' . @$documentImage->disabilitydocument) }}" image target="__blank"><i
                                            class="fa fa-download"></i></a>
                                @endif
                            </td>
                            <td>
                                @if (!empty($documentImage->inclusiongroupcertificatejanajati))
                                    <a style="padding-left:10px;" title="{{ @$inclusiongroupcertificatejanajati }}"
                                        href="{{ asset('uploads/document/inclusiongroupcertificate/' . @$documentImage->inclusiongroupcertificatejanajati) }}" image target="__blank"><i
                                            class="fa fa-download"></i></a>
                                @endif

                                @if (!empty($documentImage->inclusiongroupcertificateadibashi))
                                    <a style="padding-left:10px;" title="{{ @$inclusiongroupcertificateadibashi }}"
                                        href="{{ asset('uploads/document/inclusiongroupcertificate/' . @$documentImage->inclusiongroupcertificateadibashi) }}" image target="__blank"><i
                                            class="fa fa-download"></i></a>
                                @endif                                
                            </td>
                            <td>
                                @if (!empty($documentImage->inclusiongroupcertificatedalit))
                                    <a style="padding-left:10px;"
                                        title="{{ @$documentImage->inclusiongroupcertificatedalit }}"
                                        href="{{ asset('uploads/document/inclusiongroupcertificate/' . @$documentImage->inclusiongroupcertificatedalit) }}" image target="__blank"><i
                                            class="fa fa-download"></i></a>
                                @endif
                            </td>
                            <td>
                                @if (!empty($documentImage->inclusiongroupcertificatepixadiyeko))
                                    <a style="padding-left:10px;"
                                        title="{{ @$documentImage->inclusiongroupcertificatepixadiyeko }}"
                                        href="{{ asset('uploads/document/inclusiongroupcertificate/' . @$documentImage->inclusiongroupcertificatepixadiyeko) }}" image target="__blank"><i
                                            class="fa fa-download"></i></a>
                                @endif
                            </td>
                            <td>
                                @if (!empty($documentImage->inclusiongroupcertificatemadesi))
                                    <a style="padding-left:10px;"
                                        title="{{ @$documentImage->inclusiongroupcertificatemadesi }}"
                                        href="{{ asset('uploads/document/inclusiongroupcertificate/' . @$documentImage->inclusiongroupcertificatemadesi) }}" image target="__blank"><i
                                            class="fa fa-download"></i></a>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div>
            @if (auth()->user()->is_submitted == 1)
                <label class="text-primary requestAccess" data-field="Document" data-action="request">Request Change</label> / <label class="text-success requestAccess" data-field="Document" data-action="verify">Complete</label>
            @endif
            </div>
            {{-- Document details end --}}
        </div>

        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<script type="text/javascript">

    $(document).ready(function() {
        $('.requestAccess').on('click', function() {
            var field = $(this).data('field');
            var action = $(this).data('action');
            $.ajax({
                type: 'POST',
                url: '{{url("requestAccess")}}',
                data:{
                    field  :field,
                    action :action
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.type == 'success') {
                        toastr.success(data.message);
                    } else if(data.type == 'error') {
                        toastr.error(data.message);
                    }
                }
            });
        });
    });
</script>
