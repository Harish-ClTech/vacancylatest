<style>
    .row_custom {
        padding: 0px 15px;
        margin-bottom: 15px !important;
    }

    .row_custom .col-md-12 {
        padding: 15px;
        box-shadow: 0px 0px 5px rgb(0 0 0 / 20%);
    }

    table {
        border: none;

    }

    .title_add {
        padding: 0px 15px;
        margin-top: 15px;
        margin-bottom: 8px;
        margin-bottom: 8px;
    }

    .title_add span {
        border-bottom: 1px solid #ddd;
        color: #08c;
        font-size: 18px;
        font-weight: 600;
        display: inline;
    }

    table td span {
        font-weight: 600;
        padding-left: 15px;
    }
</style>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Card-->
        <div class="container" style="border: 1px solid #ddd; border-radius: 5px;">
            {{-- Personal details --}}
            <div class="row g2 mb-2 title_add">
                <input type="hidden" value="{{@$userid}}" id="personalid" name="personalid">
		        <span class="mx-0 px-0" style="">ब्यतिगत विवारण <input type="checkbox" class="accessmodifier" name="personal_enabled" data-field="Personal" value="1" @if($user->personal_enabled) checked @endif /> || Allow Other Details Module Access <input type="checkbox" @if($user->other_enabled) checked @endif class="accessmodifier" data-field="Others" name="other_enabled" value="1"/></span>
		
            </div>
            <div class="row g2 mb-2 row_custom" style="width: 20%;  margin: 0px auto;">
                <div class="col-md-12"
                    style="box-shadow: 0px 0px 4px rgba(0,0,0,0.2); display: flex; justify-content: center;">
                    <img src="{{ asset('uploads/document/photography') . '/' . @$userphoto->photography }}"
                        style="width: 100px;" alt="">
                </div>

            </div>

            <!--BEGIN: Applied Jobs-->
            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12 table-responsive">
                    <strong>आवेदन बिवरन :</strong><br>
                        <u>Receipt No.:</u> <span>{{ @$applied[0]->receipnumber }}</span>&nbsp;&nbsp;
                        <u>Applied Date:</u> <span>{{ @$applied[0]->applieddatead }}</span>&nbsp;&nbsp;
                    	<u>Total Amount:</u> <span>Rs.{{ @$applied[0]->applyamount }}</span>&nbsp;&nbsp;
                        <u>Designation:</u> <span>{{ @$applied[0]->designation }}</span><br><br>
		                <table class="table-bordered table-striped table-condensed cf"  id="experienceDetailTable" width="100%">
                            <thead class="cf">
                                <tr>
                                    <td>क्रम संख्या</td>
                                    <td>विज्ञापन नं.</td>
                                    <td>खुला र समावेशी</td>
                                    <td>कार्य</td>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                if(!empty($applied)){?>
                                @foreach($applied as $key=>$rowdata)
                                <tr>
                                    
                                    <td>{{@$i}} <input type="hidden" name="applydetailid" id="applydetailid" value="{{@$rowdata->jobapplydetailid}}"></td>  
                                    <td class="vacancyno">{{@$rowdata->vacancynumber}}</td>
                                
                                    <td>
                                        <!--begin::Col -->
                                        <div class="col-md-6 fv-row">
                                            <select class="form-select form_input  select2 form-select-solid saveJobCategoryId" id="jobcategory" name="jobcategory"
                                                style="padding: 4px;">
                                                @foreach ($vacancies as $vacancy)
                                                    <option value="{{ @$vacancy->id }}" {{@$vacancy->name == @$rowdata->jobcategoryname ? "selected" : " "}} data-applydetailid="{{@$rowdata->jobapplydetailid}}" data-vacancy="{{@$vacancy->vacancynumber}}">{{ @$vacancy->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                    </td>
                                    <td>
                                        @if($rowdata->vacancycanceled == 'Y')
                                            <span class="badge badge-pill badge-danger">आवेदन अस्वीकृत गरिएको छ ।</span>
                                        @else
                                            @if($rowdata->appliedstatus != 'Verified')
                                                <button type="button" class="btn btn-danger btn-sm cancelApplicationButton" data-toggle="modal" data-target="#cancelApplicationModal" data-userid="{{@$userid}}" data-designation="{{@$applied[0]->designation}}" data-jobcategoryname="{{@$rowdata->jobcategoryname}}" data-applydetailid="{{@$rowdata->jobapplydetailid}}">
                                                    <i class="fa-solid fa-xmark"></i> टिप्पणी सहित अस्वीकृत गर्नुहोस
                                                </button>
                                            @else
                                                <span class="badge badge-pill badge-success">आवेदन स्वीकार गरिएको छ ।</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                <?php } else { ?>
                                    <tr><td>Record not found.</td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                </div>
            </div>
            <!--END: Applied Jobs-->
           
	    <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr>
                            <td><strong> नाम देवनगरिमा :</strong><span>{{ @$profile->nfirstname . ' ' . @$profile->nmiddlename . ' ' . @$profile->nlastname ?? "नाम देवनगरिमा"}}</span></td>
                            <td><strong> नाम अग्रेजि :</strong><span>{{ @$profile->efirstname . ' ' . @$profile->emiddlename . ' ' . @$profile->elastname ?? "नाम अग्रेजि"  }}</span></td>
                            <td><strong> लिङ्ग :</strong><span>{{ @$profile->gender ?? "Gender" }}</span></td>
                        </tr>
                        <tr>
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
                            <td><strong> रोजगारी अवस्था :</strong><span>{{ @$extraDetails->employmentstatus }}</span></td>
                        </tr>
                        <tr>
                            <td><strong> वैवाहिक स्थिति :</strong><span>{{ @$extraDetails->maritalstatus }}</span></td>
                            <td><strong> पति/पत्नीको नाम थर :</strong><span>{{ @$extraDetails->spousename }}</span></td>
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

	    {{-- Personal  details End --}}

            <div class="row g2 mb-2 title_add">
	    	<span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">स्थाई ठेगाना | Allow Contact Details Module Access <input type="checkbox" @if($user->contact_enabled) checked @endif data-field="Contact" class="accessmodifier" name="contact_enabled" value="1"/></span>
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
                            <td><strong> घर नम्बर:</strong><span>{{ @$contactDetails->housenumber }}</span></td>
                            <td></td>
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
                        </tr>
                        <tr>
                            <td><strong> Email :</strong><span>{{ @$emailphone->email }}</span></td>
                            <td><strong> पत्राचार ठेगाना :</strong><span>{{ @$contactDetails->maillingaddress }}</span></td>
                        </tr>                        
                    </table>
                </div>
            </div>

            {{-- Educational details --}}
            <div class="row g2 mb-2 title_add">
            	<span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">शैक्षिक विवरण | Allow Education Module Access <input type="checkbox" @if($user->education_enabled) checked @endif data-field="Education" class="accessmodifier" name="education_enabled" value="1"/></span>
	    </div>
            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr style="background: skyblue">
                            <th>कलेज/विद्यालय/संस्थाको नाम</th>
                            <th>विश्वविद्यालय / बोर्ड नाम</th>
                            <th>उतिर्ण गरेको परिक्षा/ स्तर</th>
                            <th>संकाय</th>
                            <th>कुल अंक/प्रतिशत/श्रेणि</th>
                            <th>प्रमुख विषयहरू</th>
                        </tr>
                        @foreach (@$educationDetails as $eduval)
                            <tr>
                                <td>{{ $eduval->educationinstitution }}</td>
                                <td>{{ $eduval->universityboardname }}</td>
                                <td>{{ $eduval->name }}</td>
                                <td>{{ $eduval->educationfaculty }}</td>
                                <td>{{ $eduval->devisiongradepercentage }}</td>
                                <td>{{ $eduval->mejorsubject }}</td>
                                <td>
                                    @if (!empty($eduval->academicdocument))
                                    @foreach(json_decode(@$eduval->academicdocument) as $docs)
                                        <a style="padding-left:10px;"
                                            title="{{ @$docs }}"
                                            href="{{ asset('uploads/education/' . @$docs) }}"  target="__blank"><i
                                                class="fa fa-download"></i></a>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                   @if (!empty(@$eduval->equivalentdocument))
                                        <a style="padding-left:10px;"
                                            title="{{ @$eduval->equivalentdocument }}"
                                            href="{{ asset('uploads/education/' . @$eduval->equivalentdocument) }}"  target="__blank"><i
                                                class="fa fa-download"></i></a>

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
            {{-- Educational details end --}}

            {{-- Training details --}}
            <div class="row g2 mb-2 title_add">
            	<span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">तालिम विवरण | Allow Training Module Access <input type="checkbox" @if($user->training_enabled) checked @endif data-field="Training" class="accessmodifier" name="training_enabled" value="1"/></span>
	    </div>
            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr style="background: skyblue">
                            <th>तालिम प्रदायकको नाम</th>
                            <th>तालिमको विषय</th>
                            <th>ग्रेड/प्रतिशत </th>
                            <th>अवधि देखि </th>
                            <th>अवधि सम्म </th>
                        </tr>
                        @foreach ($trainingDetails as $traval)
                            <tr>
                                <td>{{ $traval->trainingproviderinstitutionalname }}</td>
                                <td>{{ $traval->trainingname }}</td>
                                <td>{{ $traval->gradedivisionpercent }}</td>
                                <td>{{ $traval->fromdatebs }}</td>
                                <td>{{ $traval->enddatebs }}</td>
                                <td>
                                    @if (!empty(@$traval->document))
                                    @foreach(json_decode(@$traval->document) as $traindocss)

                                        <a style="padding-left:10px;"
                                            title="{{ @$traindocss }}"
                                            href="{{ asset('uploads/training/' . @$traindocss) }}" image target="__blank"><i
                                                class="fa fa-download"></i></a>
                                    @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
            {{-- Training details end --}}

            {{-- Experience details --}}
            <div class="row g2 mb-2 title_add">
            	<span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">अनुभव विवरण | Allow Experience Module Access <input type="checkbox" @if($user->experience_enabled) checked @endif data-field="Experience" class="accessmodifier" name="experience_enabled" value="1"/></span>
	    </div>
            <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr style="background: skyblue">
                            <th>कार्यालय</th>
                            <th>कार्यालय ठेगाना</th>
                            <th>पद</th>
                            <th>तह</th>
                            <th>सेवा/समूह </th>
                            <th>सुरू मिति </th>
                            <th>अन्त्य मिति</th>
                            <th>कार्य विवरण</th>
                        </tr>
                        @foreach ($experienceDetails as $expval)
                            <tr>
                                <td>{{ $expval->officename }}</td>
                                <td>{{ $expval->officeaddress }}</td>
                                <td>{{ $expval->designation }}</td>
                                <td>{{ $expval->ranklabel }}</td>
                                <td>{{ $expval->service }}/{{ $expval->group }}</td>
                                <td>{{ $expval->fromdatebs }}</td>
                                <td>{{ $expval->enddatebs }}</td>
                                <td>{{ $expval->workingstatus }}</td>
                                <td>
                                    @if (!empty(@$expval->document))
                                    @foreach(json_decode(@$expval->document) as $edudocss)

                                        <a style="padding-left:10px;"
                                            title="{{ @$edudocss }}"
                                            href="{{ asset('uploads/experience/' . @$edudocss) }}"  target="__blank"><i
                                                class="fa fa-download"></i></a>
                                    @endforeach

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
            {{-- Experience details end --}}


            {{-- Document details --}}
            <div class="row g2 mb-2 title_add">
            	<span class="mx-0 px-0" style="border-bottom: 1px solid; display: inline;">Document | Allow Document Module Access <input type="checkbox" @if($user->document_enabled) checked @endif data-field="Document" class="accessmodifier" name="document_enabled" value="1"/></span>
	    </div>
            

	     <div class="row g2 mb-2 row_custom">
                <div class="col-md-12">
                    <table class="w-100">
                        <tr style="background: skyblue">
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



	{{-- Document details end --}}

	<div class="row g2 mb-2 row_custom" style="">
                <label>Remarks:</label>
            </div>
            <div class="row g2 mb-2 row_custom" style="color:red; border: 1px solid; margin:0px;">
                <p>{{@$applied[0]->remarks}}<p>
                <p>{{@$applied[0]->feedback}}</p>
            </div>

        </div>

        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
</div>

 <!-- Start: Cancel Application Modal  -->
 <div class="modal fade" id="cancelApplicationModal" tabindex="-1" role="dialog" aria-labelledby="cancelApplicationModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
       
      </div>
    </div>
  </div>
  <!-- Start: Cancel Application Modal  -->


<script>


    $("input[type='checkbox']").click(function(){
        if($(this).prop('checked')==false){
            $(this).val('null')
        }else{
            $(this).val(1);
        }
    });
	$(".accessmodifier").on('click', function(){
        var name=$(this).attr('name');
        var value=$(this).val();
        var field=$(this).data('field');
        $.ajax({
            type: 'get',
            url: '{{url("accessModifier")}}'+'/'+name+'/'+value,
            data:{
                personalid:$("#personalid").val(),
                field:field
            },
            success: function(response) {
                var data = JSON.parse(response);
                    toastr.success(data.message);

            }
        })
    });
    
    // Click cancel application button
    $(document).off('click','.cancelApplicationButton');
    $(document).on('click','.cancelApplicationButton', function(){
        var userid = $(this).data('userid');
        var applydetailid = $(this).data('applydetailid');
        var designation = $(this).data('designation');
        var jobcategoryname = $(this).data('jobcategoryname');
        var url = '{{ route('getCancelApplicationForm') }}';
        var token =  "{{ csrf_token() }}";
        var data = {
            'userid':userid,
            'applydetailid':applydetailid,
            'designation':designation,
            'jobcategoryname':jobcategoryname,
            '_token':token
        };
        $.post(url, data, function(response){
            $('#cancelApplicationModal .modal-content').html(response);
            $('#cancelApplicationModal').show();
        })
    });

    
    $(document).ready(function() {
        $(document).off('change', '.saveJobCategoryId');
        $(document).on('change', '.saveJobCategoryId', function() {

            var applycategoryid = $(this).val();
            var vacancyNumber = $(this).find('option:selected').data('vacancy');
            var applydetailid = $(this).find('option:selected').data('applydetailid');
            var userid = $('#personalid').val();
            var url = baseUrl + '/changeapplyjobpost'
            var infoData = {	
                applydetailid: applydetailid,
                applycategoryid : applycategoryid
            }
            if(confirm("Are you sure you want to change?")){
            $.post(url, infoData, function(response) {
                response=JSON.parse(response)
                applicantDetailTable.fnDraw();
                if (response.type == "success") {
                    applicantDetailTable.fnDraw();
                        toastr.success(response.message);
                //     $('.vacancyno').empty();
                //     $('.vacancyno').html(vacancyNumber);

                    } else {
                        applicantDetailTable.fnDraw();
                        toastr.error(response.message);
                    }

            })
            }
        });
        

    })    
    
</script>

