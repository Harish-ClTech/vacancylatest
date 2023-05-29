@extends('admin.layouts.admin_designs')

@section('siteTitle')सिम्बोल नम्बर @endsection
<style>
      tbody, td, tfoot, th, thead, tr {
            padding: 10px 5px;
      }
      .title{
            color: #144380;
            font-weight: 700;
            text-decoration: underline;
      }
      thead{
            background-color: #144380;
            color: #fff;
      }
      
      .btn-primary{
            background-color: #144380 !important;
      }

</style>

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Toolbar-->
	<div class="toolbar" id="kt_toolbar" style="padding-top: 0px; background-color: #fff;">
		<!--begin::Container-->
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<!--begin::Page title-->
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend"
				data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
				class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1" style="padding: 4px 15px;">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">ड्यासबोर्ड</a>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">सिम्बोल नम्बर सूची</li>
					<!--end::Item-->
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
		</div>
		<!--end::Container-->
	</div>
	<div class="post d-flex flex-column-fluid" id="kt_post" style="margin-top: 70px !important;">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
                        <div class="container">
                              <h4 class="my-4 title" style="color:#3C2784"><u>सिम्बोल नम्बर जेनेरेट गर्ने  फारम ।</u></h4>
                              <form class="mt-3">
                                    <div class="row">

                                          <div class="form-group col-md-4">
                                                <label for="fiscalyearid">आर्थिक बर्ष</label>
                                                <select id="fiscalyearid"  name="fiscalyearid" class="form-select">
                                                      <option selected>आर्थिक बर्ष छान्नुहोस्..</option>
                                                      @if(!empty($fiscalyears))
                                                            @foreach ($fiscalyears as $fy)
                                                                  <option value="{{$fy->id}}">{{$fy->fiscalyearname}}</option>
                                                            @endforeach
                                                      @endif
                                                </select>
                                          </div>
      
                                          <div class="form-group col-md-4">
                                                <label for="levelid">विज्ञापन भएको तह</label>
                                                <select id="levelid"  name="levelid" class="form-select">
                                                      <option selected>तह छान्नुहोस्..</option>
                                                   
                                                </select>
                                          </div>
                                          <div class="form-group col-md-4" id="designationDiv">
                                                <label for="designationid">विज्ञापन भएको पद</label>
                                                <select id="designationid"  name="designationid" class="form-select">
                                                      <option selected>पद छान्नुहोस्..</option>
                                                   
                                                </select>
                                          </div>
                                    </div>
                                    <div class="row" id="messageDiv" style="display: none; background-color: #f9e1e1; margin:0px -4px; padding: 10px 5px;">
                                          <div class="col-md-9">
                                                <p class="text-danger mt-3" id="message"></p>
                                          </div>
                                          <div class="col-md-3 text-right" id="btnDiv">
                                                <button type="button" id="generateSymbolNumberBtn" class="btn btn-primary pull-right">
                                                      <i class="fa fa-shuffle"></i> सिम्बोल नम्बर जेनेरेट गर्नुहोस् ।
                                                </button>
                                          </div>
                                    </div>
                              </form>
                        </div>
				<!--begin::Card body-->
				<div class="card-body py-4" id="symbolTable" style="display: none;">
                             
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
</div>

@endsection
@section('scripts')
	<script>
            var designationCount = 0;
            // $('#designationDiv').hide();
            $('#symbolTable').hide();
            $('#messageDiv').hide();

            $('#fiscalyearid').on('change', function(e){
                  e.preventDefault();
                  $('#messageDiv').hide();
                  var fiscalyearid = $('#fiscalyearid :selected').val();
                  var url = '{{route('getlevels')}}';
                  var infoData = {
                        fiscalyearid:fiscalyearid,
                  };
                  $.post(url, infoData, function (response) {
                        $('#levelid').html("");
                        $('#levelid').html("<option selected>तह छान्नुहोस्..</option>");
                        $.each(response, function(key, val){
                              $('#levelid').append("<option value='"+key+"'>"+key+"</option>");
                        });
                  });
            });
            $('#fiscalyearid').trigger('change');


            $('#levelid').on('change', function(e){
                  e.preventDefault();
                  $('#symbolTable').hide();
                  $('#messageDiv').hide();
                  var levelid = $('#levelid :selected').val();
                  var fiscalyearid = $('#fiscalyearid :selected').val();
                  var url = '{{route('getdesignations')}}';
                  var infoData = {
                        levelid:levelid,
                        fiscalyearid:fiscalyearid,
                  };
                  $.post(url, infoData, function (response) {
                        var result = JSON.parse(response);
                        if(result.type == 'success'){
                              $('#designationid').html("");
                              $('#designationid').html("<option selected>पद छान्नुहोस्..</option>");
                              designationCount = (result.response.designations).length;
                              $.each(result.response.designations, function(dkey, dval){
                                    $('#designationid').append("<option value='"+dval.designationid+"' data-key="+dkey+">"+dval.designationtitle+"</option>");
                              });
                        }
                  });
            });

            $('#designationid').on('change', function(e){
                  e.preventDefault();
                  $('#symbolTable').hide();
                  var levelid = $('#levelid :selected').val();
                  var fiscalyearid = $('#fiscalyearid :selected').val();
                  var designationid = $('#designationid :selected').val();
                  var url = '{{route('get_applicants')}}';
                  var infoData = {
                        levelid:levelid,
                        fiscalyearid:fiscalyearid,
                        designationid:designationid,
                  };
                  $.post(url, infoData, function (response) {
                        var result = JSON.parse(response);
                        if(result.type == 'success'){
                              $('#messageDiv').show();
                              if(result.response.applicantWithNoSymbolCount>0){
                                    $('#btnDiv').show();
                                    $('#message').html('तपाईले छनाैट गर्नु भएको विज्ञापनको <b class="text-success"">'+result.response.designation+' </b> पदका लागि <b class="text-success"">'+result.response.applicantWithNoSymbolCount+'</b> जना परिक्षार्थीको सिम्बोल नम्बर जेनेरेट गर्न बाँकी रहेको छ ।');
                              }else{
                                    $('#btnDiv').hide();
                                    $('#message').html('तपाईले छनाैट गर्नु भएको विज्ञापनको लागि सिम्बोल नम्बर जेनेरेट नगरिएको कुनै पनि परिक्षार्थी भेटिएन ।');
                              }

                              if(result.response.applicantWithSymbolCount>0){
                                    if(result.response.applicantWithNoSymbolCount<1){
                                          $('#messageDiv').hide();
                                    }
                                    $('#symbolTable').html(result.response.table);
                                    $('#symbolTable').show();
                              }else{
                                    $('#symbolTable').hide();
                              }
                        }
                  });
            });

            $('#generateSymbolNumberBtn').on('click', function(e){
                  e.preventDefault();
                  var levelid = $('#levelid :selected').val();
                  var fiscalyearid = $('#fiscalyearid :selected').val();
                  var designationid = $('#designationid :selected').val();
                  var designationserial = $('#designationid :selected').data("key");
                  var url = '{{route('generate_symbol_number')}}';
                  var infoData = {
                        levelid:levelid,
                        fiscalyearid:fiscalyearid,
                        designationid:designationid,
                        designationserial:designationserial,
                        designationcount:designationCount,
                  };
                  swal({
                        title: "के तपाई सिम्बोल नम्बर जेनेरेट गर्न चाहनुहुन्छ ? ",
                        text: "एक पटक सिम्बोल नम्बर जेनेरेट गरिसके पछि पुन: जेनेरेट गर्न सक्नुहुने छैन |",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "रद्द गर्नुहोस् ।",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "ठिक छ ।"
                  },
                  function() {
                        $.post(url, infoData, function(response) {
                              var result = JSON.parse(response);
                              if (result.type == 'success') {
                                    toastr.success(result.message);
                                    $('#designationid').trigger('change');
                              } else {
                                    toastr.error(result.message);
                              }
                        });
                  });


            });

		
	</script>
@endsection