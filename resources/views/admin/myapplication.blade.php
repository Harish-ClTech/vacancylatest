@extends('admin.layouts.admin_designs')

@section('siteTitle') मेरो आवेदन@endsection
<link href="{{asset('adminAssets/assets/css/common/applicantprofile.css')}}" rel="stylesheet" type="text/css" />


@section('content')
      <div class="card" style="margin-top:5px;">
            <!--begin::Card body-->
            <div class="card-body py-4">
                  <!--begin::Table-->
                  <h4 style="color: #3C2784;font-weight: 600;"><u>आवेदनहरुको सूची</u></h4>
                  @if (!empty($appliedData))
                        <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                              <div class="table-responsive applicantCommonInfo">
                                    @foreach ($appliedData as $akey=>$aval)
                                          <ul class="registerInfo" style="color:#3C2784;">
                                                <li>
                                                      <p>दर्ता न‌.: <b>{{!empty($aval['registrationnumber'])?$aval['registrationnumber']:''}}</b></p>
                                                </li>
                                                <li>
                                                      <p>आव‌ेदन मिति.: <b>{{!empty($aval['applieddatead'])?$aval['applieddatead']:''}}</b></p>
                                                </li>
                                                <li>
                                                      <p>रिसद न‌.: <b>{{!empty($aval['receipnumber'])?$aval['receipnumber']:''}}</b></p>
                                                </li>
                                                <li>
                                                      <p>रकम.: <b>{{!empty($aval['applyamount'])?$aval['applyamount']:''}}</b></p>
                                                </li>
                                                <li>
                                                      <p>रकम भुक्तानीको श्रोत.: <b>{{!empty($aval['paymentsource'])?$aval['paymentsource']:''}}</b></p>
                                                </li>
                                          </ul>
                                          @if(!empty($aval['applyDetails'] ))
                                                @foreach($aval['applyDetails'] as $newkey=>$newval)
                                                      <ul class="applyDetailInfo">
                                                            <li>
                                                                  <p>पद.: <b>{{$newkey}}</b></p>
                                                            </li>
                                                            <li>
                                                                  <p>स्थिति.: <b>
                                                                        @if($newval['appliedstatus'] == 'Incomplete')
                                                                              <span class="badge rounded-pill bg-danger">{{$newval['appliedstatus']}}</span>
                                                                        @elseif($newval['appliedstatus'] == 'Rejected')
                                                                              <span class="badge rounded-pill bg-danger">{{$newval['appliedstatus']}}</span>
                                                                        @elseif($newval['appliedstatus'] == 'Pending')
                                                                              <span class="badge rounded-pill bg-warning">{{$newval['appliedstatus']}}</span>
                                                                        @elseif($newval['appliedstatus'] == 'Verified')
                                                                              <span class="badge rounded-pill bg-success">{{$newval['appliedstatus']}}</span>
                                                                        @endif
                                                                        </b></p>
                                                            </li>
                                                            <li>
                                                                  <p>टिप्पणी.: <b>{{$newval['remarks']}}</b></p>
                                                            </li>
                                                            <li>
                                                                  <p>प्रतिकृया.: <b>{{$newval['feedback']}}</b></p>
                                                            </li>
                                                            @if($newval['appliedstatus'] == 'Verified' && $newval['vacancycanceled'] != 'Y')
                                                                  <li id="admit-btn">
                                                                        @if(!empty($newval['symbolnumber']))
                                                                              <button class="btn btn-success btn-sm viewAdmitCardBtn" data-degid="{{ $newval['designationid'] }}"><i class="fa fa-id-card" aria-hidden="true"></i> &nbsp;प्रवेश पत्र</button>
                                                                        @else
                                                                              <button class="btn btn-danger btn-sm viewAdmitCardBtn" data-degid="{{ $newval['designationid'] }}"><i class="fa fa-id-card" aria-hidden="true"></i> &nbsp;SAMPLE प्रवेश पत्र</button>
                                                                        @endif
                                                                  </li>
                                                            @endif
                                                      </ul>

                                                      <table class="table-bordered table-striped table-condensed cf" id="appliedVacancyTable"width="100%" style="margin-bottom: 20px;">
                                                            <thead class="cf">
                                                                  <tr class="head">
                                                                        <th>क्रम संख्या</th>
                                                                        <th>विज्ञापन नं.</th> 
                                                                        <th>खुला र समावेशी</th>
                                                                        <th>स्थिति</th>
                                                                        <th>टिप्पणी</th>
                                                                  </tr>
                                                            </thead>
                                                            <tbody>
                                                                  @foreach($newval['jobCategories'] as $lastkey=>$lastval)
                                                                        <tr style="font-weight:normal;">
                                                                              <td>{{$loop->iteration }}</td>
                                                                              <td>{{$lastval['vacancynumber']}}</</td> 
                                                                              <td>{{$lastkey}}</td> 
                                                                              <td>
                                                                                    @if($newval['vacancycanceled'] == 'Y')
                                                                                          <span class="badge rounded-pill bg-danger">अस्वीकृत</span>
                                                                                    @endif
                                                                              <td>{{$lastval['vacancycanceledremarks']}}</td>
                                                                        </tr>
                                                                  @endforeach
                                                            </tbody>
                                                      </table>
                                                @endforeach
                                          @endif
                                    @endforeach	
                              </div>
                        </div>
                  @else
                        <p class="alert alert-danger mt-3">हाल सम्म कुनै पनि विज्ञापनमा आवेदन दिएको भेटिएन । </p>
                  @endif
                  <!--end::Table-->
            </div>
            <!--end::Card body-->
            <!--- start::admitcard popup ---->
                  
                  <!-- Modal -->
                  <div class="modal fade" id="admitCardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="admitCardModalLabel" aria-hidden="true">
                        
                  </div>
            <!--- End::admitcard popup ---->

          			
      </div>
            
      <script>
            function getAdmitcardDetails(degid) {
                  var url = "{{ route('applicantadmitcard') }}";
                  var data = {degid:degid, viewAdmitCard:true};
                  $.post(url, data, function (response) {
                        $('#admitCardModal .modal-body').html(response);
                        // $('#admitCardModal .print_btn_wrap').html('<a href="javascript:;" id="printAdmitCardBtn" data-data="'+degid+'" class="btn btn-danger"> <i class="fa fa-print" aria-hidden="true"></i> Print</a>');	

                  });
            }

            function previewAdmitCard(degid) {
                  var url = "{{ route('getadmitcardholder') }}";
                  var infoData = {degid:degid, viewAdmitCard:true};
                  $.post(url, infoData, function(response) {
                        $('#admitCardModal').html(response);
                        // $('#admitCardModal .modal-body').html(response);
                        $('#admitCardModal').modal('show');
                        getAdmitcardDetails(degid);
                  });
            }
            $('.viewAdmitCardBtn').on('click', function(e){
                  e.preventDefault();
                  var degid = $(this).data('degid');
                  previewAdmitCard(degid);	
            });
      </script>
@endsection
