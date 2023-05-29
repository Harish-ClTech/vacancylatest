
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <h3 style="font-weight: 600; color: #3C2784; border-bottom: 5px solid #3C2784;font-size:18px">उपलब्ध विज्ञापन</h3>
                    <label class="text-danger" style="font:24px;color: #0D4A71 !important;background-color: #83cef72e;padding:10px; border-radius: 3px;border:1px solid transparent; border-color: #f5c6cb;">
                        - देहायका विज्ञापनहरुको दरखास्त Apply गर्दा तोकिएको योग्यता र उमेरको हद सुनिश्चित गरी मात्र दरखास्त फाराम भर्नु हुन अनुरोध गरिन्छ । दरखास्त भरेका उम्मेदवारको योग्यता र उमेरको हद विज्ञापन अनुसार तोकिए बमोजिम नभए निजको दरखास्त अस्वीकृत हुनेछ ।<br>
                        {{-- <span class="text-danger">
                            - नोट: विज्ञापन नम्बरको पछाडि राखिएको अङ्क (जस्तै: -1,2,3) खुला/समावेशी लाई चिनाउने प्रयोजनका लागि मात्र राखिएको हो ।
                        </span> --}}
                    </label>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body py-4">
                <div class="row p-0 m-0">
                    <div class="col-12">
                        <table class="w-100" style="border:1px solid black;" id="availableJobs">
                            <tr>
                                <th>SN</th>
                                <th>पद - सेवा÷समूह </th>
                                <th>विज्ञापन नं</th>
                                <th>खुला र समावेशी </th>
                                <th>योग्यता </th>
                                <th>उमेरको हद</th>
                                <th>Action</th>
                            </tr>
                            <?php 
                            $sn = 1; 
                            $checkuser = DB::table('personals')->select('iscitemployee')->where(['userid'=>auth()->user()->id])->first();
                            
                            $isCitEmployee = '';
                            if(!empty($checkuser)){
                                $isCitEmployee = $checkuser->iscitemployee;
                            }
                            // dd($isCitEmployee);
                            ?>
                            @if(!empty($vacancy))
                                @foreach (@$vacancy as $key => $vacant)
                                    @foreach($vacant as $vkey => $vacantpost)
                                    <tr>
                                        <td>{{ en_to_nep($sn) }} </td>
                                        <td>{{ $key }} {{ $vkey }}</td>
                                        <td>{{ implode(", ",$vacantpost['vacancycode']); }}</td>
                                        <td>
                                            {{-- {{ dd($vacantpost['jobcat']) }} --}}
                                            @foreach ($vacantpost['jobcat'] as $keys => $vals)
                                                {{ $keys }}
                                                @php
                                                    $numberofvacancy = 0;
                                                @endphp
                                                @foreach ($vals as $val)
                                                    @php
                                                        $numberofvacancy += $val->numberofvacancy;
                                                    @endphp
                                                @endforeach
                                                ({{en_to_nep($numberofvacancy)}})
                                            @endforeach
                                        </td>
                                        <td>{{$vacantpost['qualification']}}</td>
                                        <td>
                                            @if(!empty($vacantpost['agelimit']))
                                                {{en_to_nep($vacantpost['agelimit'])}} वर्ष
                                            @else 
                                                -
                                            @endif
                                        </td>
                                        <?php 
                                        /* Vacancy Start Date Calculation */
                                        $vacancyPublishDate = $vacantpost['vacancypublishdate'];
                                        $vacancyPublishDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$vacancyPublishDate);
                                        $vacancyPublishDate = $vacancyPublishDate->format('Y-m-d');
                                        $vacancyPublishDateAD = \BsDate::nep_to_eng($vacancyPublishDate); 
                                        /* Vacancy Start Date Calculation */

                                        /* Vacancy Extended End Date Calculation, plus add 1 days to check current date less than the respective date */
                                        $vacancyExtendEndDate = $vacantpost['extendeddate'];
                                        $vacancyExtendEndDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$vacancyExtendEndDate);
                                        $vacancyExtendEndDate = $vacancyExtendEndDate->addDays(1);
                                        $vacancyExtendEndDate = $vacancyExtendEndDate->format('Y-m-d');
                                        $vacancyExtendEndDateAD = \BsDate::nep_to_eng($vacancyExtendEndDate); 
                                        /* Vacancy Extended End Date Calculation, plus add 1 days to check current date less than the respective date */

                                        /* Current Date AD */
                                        $currentDate = date('Y-m-d');
                                        /* Current Date AD */

                                        /* Check Condition Whether to Show or not Apply Btn */
                                        $applyBtnStatus = 'E';
                                        if($currentDate < $vacancyPublishDateAD){
                                            $applyBtnStatus = 'N';
                                        }

                                        if($currentDate == $vacancyPublishDateAD){
                                            $applyBtnStatus = 'A';
                                        }

                                        if($currentDate > $vacancyPublishDateAD && $currentDate < $vacancyExtendEndDateAD){
                                            $applyBtnStatus = 'A';
                                        }
                                        
                                        if($currentDate > $vacancyPublishDateAD && $currentDate >= $vacancyExtendEndDateAD){
                                            $applyBtnStatus = 'E';
                                        }
                                        /* Check Condition Whether to Show or not Apply Btn */

                                        // dd($vacancyPublishDate,$vacancyPublishDateAD, $vacancyExtendEndDate,$vacancyExtendEndDateAD);
                                        ?>
                                        <td>
                                            <?php 
                                            $ifjobforcitemployee = 0;    
                                            if($vkey == '(आ.प्र)'){
                                                $ifjobforcitemployee = 1;    
                                            }
                                            ?>
                                            @if($applyBtnStatus == 'A')
                                                @if($vkey == '(आ.प्र)')
                                                    @if($isCitEmployee == 'Y')
                                                        <button type="button" class="" style="background:#3C2784;color:#fff;font-size: 13px;" onclick="advertPop({{ $vacantpost['designation'] }},{{ $vacantpost['servicesgroup'] }},{{ $ifjobforcitemployee }})"> Apply </button>
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    <button type="button" class="" style="background:#3C2784;color:#fff;font-size: 13px;" onclick="advertPop({{ $vacantpost['designation'] }},{{ $vacantpost['servicesgroup'] }},{{ $ifjobforcitemployee }})"> Apply </button>
                                                @endif
                                            @elseif($applyBtnStatus == 'E')
                                                <span class="text-red text-bold text-center">EXPIRED</span>
                                            @else 
                                                <span class="text-red text-bold text-center">UPCOMING</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $sn++; ?>
                                    @endforeach
                                @endforeach
                            @endif
                        </table>

                    </div>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<div class="modal fade" id="vacancydetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" style="margin: 70px 0 0 100px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="color:#3C2784!important;font-weight:600!important"></h5>
                <button type="button" id="closedmodal" class="close  pull-right" value="vacancydetailModal"
                    data-dismiss="modal">&times;</button>
                {{-- <span aria-hidden="true">&times;</span> --}}
                </button>
            </div>
            <div class="modal-body" id="vacancydetails">
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="" style="    background-color: #3c2784;
                color: #fff;
                border: none;
                padding: 8px 30px;
                font-size: 18px;
                font-weight: 600;
                border-radius: 3px;">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
<style>
    th {
        color:#3C2784;
        background-color: #dfe1e5;
        border: 1px solid #ddd;
        text-align: center;
        padding: 8px;
    }
    .apply__form .bx_content table thead tr th {
    background-color: #dfe1e5;
    border-color: #ddd;
    border: 1px solid #ddd;
}
    td{
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    .cl_btn{
        border: none;
        padding: 6px 25px;
        font-size: 14px;
        font-weight: 600;
    }
    .apply__form .app_txt {
    color: #3C2784;
    font-weight: 600 !important;
    font-size: 16px !important;
}
.apply__form .app_txt span {
    padding-left: 8px;
    color: #3C2784;
}
.apply__form .bx_content{
    border: 0 !important;
}
</style>
<script>
    function advertPop(designationid, servicesgroupid, ifjobforcitemployee, academicid) {
        $("#vacancydetails").html()
        var data = {
            designationid: designationid,
            servicesgroupid: servicesgroupid,
            ifjobforcitemployee: ifjobforcitemployee,
            academicid: academicid
        };
        var url = "{{ route('getjobdetails') }}";
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // $("#vacancydetails").html(response);
                // jQuery.noConflict();
                // $('#vacancydetailModal').modal('show');
                $("#vacancydetails").html(response)
                $("#vacancydetailModal").modal('show');
            }
        });

    }
</script>
