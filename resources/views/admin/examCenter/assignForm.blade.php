<style>
      tbody, td, tfoot, th, thead, tr {
            padding: 10px 5px;
      }
      .title{
            color: #144380;
            font-weight: 700;
            /* text-decoration: underline; */
      }
      .titlevalue{
            color: #2268c1d1;
      }
      thead{
            background-color: #144380;
            color: #fff;
      }
      
      .btn-primary{
            background-color: #144380 !important;
      }

</style>

<div class="card px-4" id="kt_post" style="margin-top: 40px;">
      <form id="examCenterAssignForm" method="post" class="mt-3" action="{{ route('examcenter.assignexamcenter') }}">
            <div class="row"> 
                  <input type="hidden" name="examcenterid" id="examcenterid" value="{{!empty($examcenterid)?$examcenterid:''}}">    
                  <div class="form-group col-md-2">
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

                  <div class="form-group col-md-2">
                        <label for="levelid">विज्ञापन भएको तह</label>
                        <select id="levelid"  name="levelid" class="form-select">
                              <option selected>तह छान्नुहोस्..</option>
                           
                        </select>
                  </div>
                  <div class="form-group col-md-2" id="designationDiv">
                        <label for="designationid">विज्ञापन भएको पद</label>
                        <select id="designationid"  name="designationid" class="form-select">
                              <option selected>पद छान्नुहोस्..</option>
                           
                        </select>
                  </div>
                  <div class="form-group col-md-2" id="designationDiv">
                        <label for="startingsymbolnumber">सुरुको सिम्बोल नम्बर (..देखि)</label>
                        <input class="form-control" type="text" name="startingsymbolnumber" id="startingsymbolnumber" placeholder="यस परिक्षाकेन्द्रमा रहने सुरुको सिम्बोल नम्बर">
                  </div>

                  <div class="form-group col-md-2" id="designationDiv">
                        <label for="lastsymbolnumber">अन्तिम सिम्बोल नम्बर  (..सम्म)</label>
                        <input class="form-control" type="text" name="lastsymbolnumber" id="lastsymbolnumber" placeholder="यस परिक्षाकेन्द्रमा रहने अन्तिम सिम्बोल नम्बर">
                  </div>
                  
                  <div class="col-md-2 text-right" style="margin-top:20px;">
                        <button type="button" id="assignExamCenterBtn" class="btn btn-primary">
                              <span class="indicator-label"><i class="fa fa-save" aria-hidden="true"></i> सेभ गर्नुहोस्</span>
                        </button>
                  </div>
            </div>
      </form>
</div>

<div class="py-4" id="symbolTable" style="display: block;">
      <table class="table-bordered table-striped table-condensed cf" id="examCenterTable" width="100%">
            <thead class="cf">
                  <tr>
                        <th>क्र.सं. </th>
                        <th>पद</th>
                        <th>सुरुको सिम्बोल नम्बर </th>
                        <th>अन्तिम सिम्बोल नम्बर</th>
                        <th>परिक्षार्थी संख्या</th>
                  </tr>
            </thead>
            <tbody>
                  
            </tbody>
      </table>
      
</div>
<script>
      var designationCount = 0;
      getExamCenterData();
      function getExamCenterData(){
            var url = '{{route('getsymbolnumberswithexamcenter')}}';
            var examcenterid = "{{!empty($examcenterid)?$examcenterid:''}}";
            var infoData = {
                  examcenterid:examcenterid,
            };
            $.post(url, infoData, function (response) {
                  var result = JSON.parse(response);
                  if(result.type == 'success'){
                        $('#startingsymbolnumber').val(result.response.startingSymbol);
                        $('#lastsymbolnumber').val(result.response.lastSymbol);
                        $('#symbolTable').html(result.response.table);
                  }
            });
      }

      $('#fiscalyearid').on('change', function(e){
            e.preventDefault();
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
            var levelid = $('#levelid :selected').val();
            var fiscalyearid = $('#fiscalyearid :selected').val();
            var designationid = $('#designationid :selected').val();
            var startingsymbolnumber = $('#startingsymbolnumber');
            var lastsymbolnumber = $('#lastsymbolnumber');

            startingsymbolnumber.val('');
            lastsymbolnumber.val(''); 

            var url = '{{route('get_symbol_numbers')}}';
            var infoData = {
                  levelid:levelid,
                  fiscalyearid:fiscalyearid,
                  designationid:designationid,
            };
            $.post(url, infoData, function (response) {
                  var result = JSON.parse(response);
                  if(result.type == 'success'){
                        if(result.response.startingSymbol>0){
                              startingsymbolnumber.val(result.response.startingSymbol);
                              lastsymbolnumber.val(result.response.lastSymbol); 
                        }else{
                              $.notify('माफ गर्नुहोला ! तपाईले छान्नुभएको पदको लागी परिक्षाकेन्द्र तोक्न बाँकी कुनै पनि सिम्बोल नम्बर भेटिएन ।', 'error');
                        }
                  }else{
                        $.notify(result.message, 'error');
                  }
            });
      });

      var examCenterAssignFormValid = $('#examCenterAssignForm').validate({
            rules: {
                  fiscalyearid: {
                        required: true
                  },
                  designationid: {
                        required: true
                  },
                  startingsymbolnumber: {
                        required: true
                  },
                  lastsymbolnumber: {
                        required: true
                  },
            },
            messages: {
                  fiscalyearid: {
                        required: "कृपया आर्थिक बर्ष छान्नुहोस् ।"
                  },
                  designationid: {
                        required: "कृपया पद छान्नुहोस् ।"
                  },
                  startingsymbolnumber: {
                        required: "कृपया सुरुको सिम्बोल नम्बर प्रविष्ट गर्नुहोस् ।"
                  },
                  lastsymbolnumber: {
                        required: "कृपया अन्तिम सिम्बोल नम्बर प्रविष्ट गर्नुहोस् ।"
                  },
            },
            highlight: function(element) {
                  $(element).addClass('border-danger');
            },
            unhighlight: function(element) {
                  $(element).removeClass('border-danger');
            },
      });

    
</script>
