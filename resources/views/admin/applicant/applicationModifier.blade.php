<style>
    .apply__form .txt_center {
        display: none !important;
        width: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        margin-top: 30px;
    }

    .apply__form .txt_center .head_text {
        z-index: 9999;
    }

    .apply__form .txt_center .head_text .head_side_design {
        position: relative;
    }

    .apply__form .txt_center .head_text .head_side_design:before {
        content: "";
        position: absolute;
        left: -40px;
        bottom: -4px;
        border: 25px solid #03c75e;
        border-left-color: transparent;
        /* border-bottom-color: transparent; */
        /* border-right-color: transparent; */
        /* border-top-color: transparent; */
        z-index: -11;
    }

    .apply__form .txt_center .head_text .head_side_design:after {
        content: "";
        position: absolute;
        right: -40px;
        bottom: -4px;
        border: 25px solid #03c75e;
        /* border-bottom-color: transparent; */
        border-right-color: transparent;
        /* border-top-color: transparent; */
        z-index: -11;
    }

    .apply__form .txt_center .head_text h1 {
        position: relative;
        display: inline-block;
        background: #03c75e;
        padding: 15px 30px;
        color: #fff;
        font-weight: 600;
        font-size: 24px;
        -webkit-box-shadow: 0px 0px 4px rgb(0 0 0 / 20%);
        box-shadow: 0px 0px 4px rgb(0 0 0 / 20%);
    }

    .apply__form .txt_center .head_text h1:before {
        content: "";
        position: absolute;
        left: -10px;
        bottom: -10px;
        border: 10px solid #0000006b;
        border-left-color: transparent;
        border-bottom-color: transparent;
        /* border-right-color: transparent; */
        border-top-color: transparent;
        z-index: -1;
    }

    .apply__form .txt_center .head_text h1:after {
        content: "";
        position: absolute;
        right: -10px;
        bottom: -10px;
        border: 10px solid #0000006b;
        border-bottom-color: transparent;
        border-right-color: transparent;
        border-top-color: transparent;
        z-index: -1;
    }

    .apply__form .app_txt {
        color: #3c2784;
        font-weight: 600 !important;
        font-size: 16px !important;
    }

    .apply__form .app_txt span {
        padding-left: 8px;
        color: ##3592c1;
    }

    .apply__form .bx_content {
        padding: 10px
    }

    .apply__form .bx_content table thead tr th {
        color:#3c2784;
        background:#DFE1E5 ;
        border-color: #ddd;
        border: 1px solid #ddd;
    }

    .apply__form .bx_content table tbody tr td {
        border: 1px solid #ddd;
        padding: 8px;
    }
</style>
<div class="apply__form">
    <form id="appplicantModifyForm" method="post" class="form" enctype="multipart/form-data"
        action="{{ route('storeModifiedForm') }}">
        <div class="txt_center">
            <div class="mb-13 text-center head_text">
                <!--begin::Title-->
                <!-- <div class="head_side_design">
                    <h1>Apply / View</h1>
                </div> -->
                <!--end::Title-->
            </div>
        </div>
        <!--end::Heading-->
        <div class="bx_content">
            <div class="row g2 mb-5
            " style="border-bottom:1px solid rgba(0,0,0,0.125);">
                <!--begin::Col-->
                <div class="col-md-4 fv-row" >
                    <p class="fs-6 fw-bold mb-2 app_txt">पद :
                        <span>{{ @$vacancy['data'][0]->title }}</span>
                        <input type="hidden" id="designationId" value="{{ @$vacancy['data'][0]->designationid }}" />
                    </p>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <p class="fs-6 fw-bold mb-2 app_txt">सेवा / समूह:
                        <span>{{ @$vacancy['data'][0]->servicegroupname }}</span>
                        <input type="hidden" id="servicegroupId" value="{{ @$vacancy['data'][0]->servicegroupid }}" />
                    </p>
                </div>
                <!--end::Col-->
                <div class="col-md-2 fv-row">
                    <p class="fs-6 fw-bold mb-2 app_txt">तह : <span>{{ @$vacancy['data'][0]->level }} </span>
                </div>
                <div class="col-md-2 fv-row">
                    <p class="fs-6 fw-bold mb-2 app_txt">User ID : <span>{{ @$userid }} </span>
                        <input type="hidden" value="{{ @$userid }}" id="userid">
                </div>
                <input type="hidden" id="jobdetailsencoded"
                    value="{{ @$vacancy['data'][0]->level . '-' . @$vacancy['data'][0]->servicegroupname . '-' . @$vacancy['data'][0]->title . '-' . @$userid }}">

            </div>
            <!--end::Col-->
            <div class="row g2 mb-2">
                <div class="col-md-8 col-sm-12">
                    <table style="width: 100%" style="border:1px solid black" id="availableJobs">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>विज्ञापन नं</th>
                                <th>खुला र समावेशी </th>
                                <th>दस्तुर </th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <input type="hidden" id="high" value="{{ @$vacancy['high'] }}">
                            <input type="hidden" id="low" value="{{ @$vacancy['low'] }}">
                            <input type="hidden" id="allvacancies" value="{{ json_encode(@$vacancy['data']) }}">
                            @if (!empty($vacancy['data']))
                                @foreach (@$vacancy['data'] as $vacant)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vacant->vacancynumber }}</td>
                                        <td>{{ $vacant->name }}({{ $vacant->numberofvacancy }})</td>
                                        <td>{{ $vacant->vacancyrate }}</td>
                                        <td>
                                            <?php if(empty($vacant->jobpostid)){ ?>
                                            <input type="checkbox" class="vacancycheck checkcandedited"
                                                onclick="addVacancy('{{ $vacant->name }}','{{ $vacant->jobcategory }}', '{{ $vacant->id }}')"
                                                id="{{ $vacant->name }}" data-vacancyrate="{{ $vacant->vacancyrate }}"
                                                value="{{ $vacant->vacancyrate }}" data-vacantid="{{ $vacant->id }}"
                                                {{-- onclick="appliedVacancy('{{ $vacant->vacancynumber }}')" --}} />
                                            <?php } else {?>
                                            <span style="color: green;">Already Applied</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div style="font-size: 24px; text-align: center; color:#3c2784;">जम्मा दस्तुर: <span
                            id="totalamount" style="color:red;"></span> /-</div>
                    <input type="hidden" id="internetpayment" value="">
                </div>
            </div>
           
	    <div class="row g2 mt-4">
                <div class="col-md-4 col-sm-12">
                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="paymentMethod">Perform Payment With</label>
                        </div>
                        <select class="custom-select" id="paymentMethod" name="paymentMethod">
                            <option selected hidden>Choose...</option>
                            <option value="eSewa">Esewa</option>
                            <option value="Khalti">Khalti</option>
                            <option value="ConnectIPS">ConnectIPS</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <input type="text" id="transactionID" name="transactionID" value="" class="form-control" placeholder="Transaction ID (Case Sensitive)">
                </div>

                <div class="col-md-4 col-sm-12">
                    <label for="isdouble" style="color:red;"> Is double amount?</label>
                    <input type="checkbox" id="double" name="double" value="Y" class="isdouble"> 
                </div>                
            </div>

	    <div class="row g2 mt-4">
                <div class="col-12 ">
                    <button type="button" class="btn btn-success align-right" id="savedetails" >Save Details</a>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var appliedlist = [];
    var appliedJobdetails = [];
    var jobDetails = $("#jobdetailsencoded").val();
    var designationId = $("#designationId").val();
    var servicegroupId = $("#servicegroupId").val();
    var jobArray = jobDetails.split('-');
    var tmp = [];
    var totalcount = 0;
    var tmp = [];
    var checkCate = false;

    async function addVacancy(name, category, id) {
        var isChecked = $("#" + name).is(":checked");
        var high = $("#high").val();
        var low = $("#low").val();
        await $.ajax({
            url: "{{ url('checkVacancyif/') }}" + '/' + id,
            type: 'POST',
            data: {
                userid: $("#userid").val()
            },
            dataType: 'json', // added data type
            success: function(res) {
                if (res.success == false) {
                    toastr.error(res.message);
                    $("#" + name).prop("checked", false);
                    isChecked = false
                }
                if (isChecked == true) {
                    tmp.push(id);
                    totalcount += 1;
                } else {
                    var index = tmp.indexOf(id);
                    if (index != '-1') {
                        tmp.splice(index, 1);
                        totalcount -= 1;
                    }
                }
            }
        });
        selectedlength = totalcount;
        totalamount = 0;
        if (selectedlength < 2) {
            var totalamount = parseInt(selectedlength) * parseInt(high);
        } else {
            var totalamount = parseInt(high) + parseInt((low * (selectedlength - 1)));
        }
        $('#totalamount').html(totalamount);
        $('#internetpayment').val(totalamount);

        sumCalculator(totalamount, tmp);
    }

    function sumCalculator(totalamount, vacancylist) {
        sums = 0
        appliedlist = []
        $("#appendTrTd > tr ").each(function() {
            sums = sums + parseInt($(this).find('td').last().text());
        });
        $("#checkedAmt").text(sums);
        appliedJobdetails = {
            level: jobArray[0],
            group: jobArray[1],
            designation: jobArray[2],
            userid: jobArray[3],
            appliedVacancyNo: vacancylist,
            totalsum: parseFloat(totalamount),
            servicegroupId: servicegroupId,
            designationId: designationId
        }
    }
</script>
<script>
    $('#savedetails').on('click', function(e){
        e.preventDefault();
        saveJobDetails();
    })
    function saveJobDetails() {
        var data = {
            response: appliedJobdetails,
            paymentsource: $("#paymentMethod").val(),
            transactionId: $("#transactionID").val(),
	    isdoubleamount: $("#double:checked").val(),
            vacancyid: tmp,
            "_token": "{{ csrf_token() }}",
        };
        console.log(data);
        $('#appplicantModifyForm').ajaxSubmit({
			dataType: 'json',
            data:data,
			success: function(res) {
                
                if (res.success == false) {
                    toastr.error(res.message);
                }else{
                    toastr.success(res.message);
                    $("#vacancydetailModal").modal('show');
                }
            }
				
		});
    }

	
    $('#double').on('click', function(e){
        var totalvalue = $('#totalamount').text();
    
        if($(this).is(':checked')) {
            $('#totalamount').text(totalvalue*2);
        } else {
            $('#totalamount').text(totalvalue/2);
        }
    });

</script>
