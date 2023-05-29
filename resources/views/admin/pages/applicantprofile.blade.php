@extends('admin.layouts.admin_designs')

@section('siteTitle')प्रोफाईल@endsection
<link href="{{asset('adminAssets/assets/css/common/applicantprofile.css')}}" rel="stylesheet" type="text/css" />


@section('content')
      <section class="applicant_profile_section">
            <div id="main_container">
                  <div class="two_container">
                  <div class="profile_flex">

                        {{-- @php 
                              $personalU = !empty(session()->get('personalid'))? 1: 0;
                              $otherdetailU = !empty(session()->get('otherdetailid'))? 1: 0;
                              $contactU = !empty(session()->get('contactid'))? 1: 0;
                              $educationU = !empty(session()->get('educationid'))? 1: 0;
                              $experienceU = !empty(session()->get('experiencelid'))? 1: 0;
                              $documentU = !empty(session()->get('documentid'))? 1: 0;
                              $trainingU = !empty(session()->get('trainingid'))? 1: 0;
                        @endphp --}}
                        {{-- {{dd($personalIds)}} --}}
                        <div class="second_col">
                              <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation" >
                                          <a class="nav-link personal-tab" id="personal" aria-controls="personal" role="tab" data-next="otherdetail" data-toggle="tab" >
                                          <i class="fa fa-user" aria-hidden="true"></i>व्यक्तिगत विवरण
                                          </a>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                          <a class="nav-link tabStatus otherdetail-tab {{empty($personalIds->personalid)? 'disabled': ''}}" id="otherdetail" aria-controls="otherdetail" data-prev="personal"  data-next="contact" role="tab"  data-toggle="tab">
                                          <i class="fa fa-credit-card" aria-hidden="true"></i>अन्य विवरण
                                          </a>
                                    </li>
                                    
                                    <li class="nav-item" role="presentation">
                                          <a class="nav-link tabStatus contact-tab {{empty($personalIds->otherdetailid)? 'disabled': ''}}" id="contact" aria-controls="contact" data-prev="otherdetail"  data-next="education" role="tab"  data-toggle="tab">
                                          <i class="fa fa-file-text" aria-hidden="true"></i>सम्पर्क विवरण
                                          </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                          <a class="nav-link tabStatus education-tab {{empty($personalIds->contactid)? 'disabled': ''}}" id="education" aria-controls="education"  data-prev="contact"  data-next="experience" role="tab" data-toggle="tab">
                                          <i class="fa fa-fax" aria-hidden="true"></i>शैक्षिक विवरण
                                          </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                          <a class="nav-link tabStatus experience-tab {{empty($personalIds->contactid)? 'disabled': ''}}" id="experience" aria-controls="experience"  data-prev="education"  data-next="document" role="tab"  data-toggle="tab">
                                          <i class="fa fa-star" aria-hidden="true"></i>अनुभव सम्बन्धि विवरण
                                          </a>
                                    </li>
                                   
                                    <li class="nav-item" role="presentation">
                                          <a class="nav-link tabStatus training-tab {{empty($personalIds->contactid)? 'disabled': ''}}" id="training" aria-controls="training" data-prev="experience"  data-next="document" role="tab"  data-toggle="tab">
                                          <i class="fa fa-line-chart" aria-hidden="true"></i>तालिम सम्बन्धि विवरण
                                          </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                          <a class="nav-link tabStatus document-tab {{empty($personalIds->educationid)? 'disabled': ''}}" id="document" aria-controls="document" data-prev="training"  data-next="preview" role="tab" data-toggle="tab">
                                          <i class="fa fa-file-text" aria-hidden="true"></i>कागजात
                                          </a>
                                    </li>
                  
                                    <li class="nav-item" role="presentation">
                                          <a class="nav-link tabStatus preview-tab {{empty($personalIds->documentid)? 'disabled': ''}}"  id="preview" aria-controls="preview" data-prev="document"  data-next="submit" role="tab" data-toggle="tab">
                                          <i class="fa fa-eye" aria-hidden="true"></i>पुनरावलोकन
                                          </a>
                                    </li>
                                    <li class="nav-item contact-tab" role="presentation">
                                          <a class="nav-link tabStatus  submit-tab {{empty($personalIds->documentid)? 'disabled': ''}}" id="submit" aria-controls="submit"role="tab" data-toggle="tab">
                                          <i class="fa fa-paper-plane" aria-hidden="true"></i>आवेदन दिने
                                          </a>
                                    </li>
                              </ul>
                              <!-- Tab panes -->
                              <div class="tab-content" id="nav-tabContent" style="box-shadow: none;">
                              </div>
                        </div>
                  </div>      
                  </div>
            </div>
      </section>
@endsection
@section('scripts')
      <script>
            var personalUpdated;
            var otherdetailUpdated;
            var contactUpdated;
            var educationUpdated;
            var experienceUpdated;
            var documentUpdated;
            var trainingUpdated;
            
            function getProfileID()
            {
                  var url = "{{ route('getprofileid') }}";
                  $.ajax({
                        url:url, 
                        async: false, 
                        type:'get', 
                        success:function (response) {
                              personalUpdated = response.personalid;
                              otherdetailUpdated = response.otherdetailid;
                              contactUpdated = response.contactid;
                              educationUpdated = response.educationid;
                              experienceUpdated = response.experienceid;
                              trainingUpdated = response.trainingid;
                              documentUpdated = response.documentid;
                        }
                  });
            }
            getProfileID();

            $(document).ready(function () {
                  
                  $(document).off('click', '.nav-link');
                  $(document).on('click', '.nav-link', function () {
                        var tabid = $(this).attr('id');
                        if(tabid=='otherdetail'){
                              if(personalUpdated != true){
                                    // $('.tabStatus').addClass('disabled');
                                    $.notify('तपाईले व्यक्तिगत विवरण अपडेट गर्नुभएको छैन ।', 'error');
                              }else{
                                    $('.otherdetail-tab').removeClass('disabled');
                              }                              
                        }else if(tabid=='contact'){
                              if(personalUpdated != true || otherdetailUpdated != true){
                                    // $('.contact-tab, .education-tab, .experience-tab, .document-tab,  .training-tab, .preview-tab').addClass('disabled');
                                    $.notify('तपाईले अन्य विवरण अपडेट गर्नुभएको छैन ।', 'error');
                              }else{
                                    $('.otherdetail-tab, .contact-tab').removeClass('disabled');
                              }     

                        }else if(tabid=='education'){
                              if(personalUpdated != true || otherdetailUpdated != true ||contactUpdated != true){
                                    // $('.education-tab, .experience-tab, .document-tab,  .training-tab, .preview-tab').addClass('disabled');
                                    $.notify('तपाईले सम्पर्क विवरण अपडेट गर्नुभएको छैन ।', 'error');
                              }else{
                                    $('.otherdetail-tab, .contact-tab, .education-tab, .experience-tab, .training-tab, .document-tab').removeClass('disabled');
                              }  

                        }else if(tabid=='experience'){
                              if(personalUpdated != true || otherdetailUpdated != true ||contactUpdated != true){
                                    // $('.experience-tab, .document-tab,  .training-tab, .preview-tab').addClass('disabled');
                                    $.notify('तपाईले शैक्षिक विवरण अपडेट गर्नुभएको छैन ।', 'error');
                              }else{
                                    $('.otherdetail-tab, .contact-tab, .education-tab, .experience-tab, .training-tab, .document-tab').removeClass('disabled');
                              }  

                        }else if(tabid=='training'){
                              if(personalUpdated != true || otherdetailUpdated != true ||contactUpdated != true){
                                    // $('.training-tab, .preview-tab').addClass('disabled');
                                    $.notify('तपाईले आधारभुत विवरण (व्यक्तिगत, सम्पर्क, अन्य, शैक्षिक) अपडेट गर्नुभएको छैन ।', 'error');
                              }else{
                                    $('.otherdetail-tab, .contact-tab, .education-tab,.experience-tab, .document-tab, .training-tab').removeClass('disabled');
                              } 

                        }else if(tabid=='document'){
                              if(personalUpdated != true || otherdetailUpdated != true ||contactUpdated != true || educationUpdated != true){
                                    // $('.document-tab,  .training-tab, .preview-tab').addClass('disabled');
                                    $.notify('तपाईले आधारभुत विवरण (व्यक्तिगत, सम्पर्क, अन्य, शैक्षिक) अपडेट गर्नुभएको छैन ।', 'error');
                              }else{
                                    $('.otherdetail-tab, .contact-tab, .education-tab,.experience-tab, .training-tab, .document-tab, .preview-tab').removeClass('disabled');
                              } 

                        }else if(tabid=='preview'){
                              if(personalUpdated != true || otherdetailUpdated != true ||contactUpdated != true ||educationUpdated != true || documentUpdated != true ){
                                    // $('.preview-tab').addClass('disabled');
                                    $.notify('तपाईले आधारभुत विवरण (व्यक्तिगत, सम्पर्क, अन्य, शैक्षिक) अपडेट गर्नुभएको छैन ।', 'error');
                              }else{
                                    $('.otherdetail-tab, .contact-tab, .education-tab,.experience-tab, .document-tab, .training-tab, .preview-tab, .submit-tab').removeClass('disabled');
                              } 
                        }
                        // else if(tabid=='submit'){
                        //       if(personalUpdated != true || otherdetailUpdated != true ||contactUpdated != true ||educationUpdated != true || documentUpdated != true){
                        //             // $('.preview-tab').addClass('disabled');
                        //             $.notify('तपाईले आधारभुत विवरण (व्यक्तिगत, सम्पर्क, अन्य, शैक्षिक) अपडेट गर्नुभएको छैन ।', 'error');
                        //       }else{
                        //             $('.otherdetail-tab, .contact-tab, .education-tab,.experience-tab, .document-tab, .training-tab, .preview-tab,  .submit-tab').removeClass('disabled');
                        //       } 
                        // }
                        $(".nav-item").removeClass('active');
                        $(this).closest(".nav-item").addClass('active');
                        var prev = $(this).data('prev');
                        var next = $(this).data('next');
                        console.log(prev, next);
                        var url = "{{ route('getapplicantprofiledata') }}";
                        var infoData = {
                              tabid: tabid,
                        };
                        $.post(url, infoData, function (response) {
                              $('#nav-tabContent').html(response);
                              getProfileID();
                              $('#'.next).trigger('click');
                        });
                  });
                  $('#personal').trigger('click');
            });

            function gotToTab(tabid)
            {
                  $(tabid).trigger('click');
            }
      </script>
    
@endsection
