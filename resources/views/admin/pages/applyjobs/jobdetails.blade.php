<style>
    .apply__form .txt_center {
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
        color: #08c;
        font-weight: 600 !important;
        font-size: 16px !important;
    }

    .apply__form .app_txt span {
        padding-left: 8px;
        color: #3592c1;
    }

    .apply__form .bx_content {
        padding: 10px;
    }


    .apply__form .bx_content table thead tr th {
        background-color: #f7f7f7;
        border-color: #ddd;
        border: 1px solid #ddd;
    }

    .apply__form .bx_content table tfoot tr td {
        border: 1px solid #ddd;
        padding: 8px;
    }
</style>

<div class="apply__form">
    <form id="applyJobsForm" method="post" class="form" enctype="multipart/form-data" action="{{ route('applyJobsForm') }}">
        {{-- <div class="txt_center">
            <div class="mb-13 text-center head_text">
                <!--begin::Title-->
                <div class="head_side_design">
                    <h1>Apply / View</h1>
                </div>

                <!--end::Title-->
            </div>
        </div> --}}
        {{-- <label class="text-danger" style="font:24px;color: #0D4A71 !important;background-color: #83cef72e;padding:10px; border-radius: 3px;border:1px solid transparent; border-color: #f5c6cb;">
            <span class="text-danger">
                - नोट: विज्ञापन नम्बरको पछाडि राखिएको अङ्क (जस्तै: -1,2,3) खुला/समावेशी लाई चिनाउने प्रयोजनका लागि मात्र राखिएको हो ।
            </span>
        </label> --}}

        <!--end::Heading-->
        <div class="bx_content">
            <div class="row g2 mb-5" style="
                    border-bottom: 1px solid rgba(0,0,0,0.125);">
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
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
                <div class="col-md-4 fv-row">
                    <p class="fs-6 fw-bold mb-2 app_txt">तह : <span>{{ @$vacancy['data'][0]->level }} </span>
                </div>
                <!--end::Col-->

                <input type="hidden" id="jobdetailsencoded" value="{{ @$vacancy['data'][0]->level . '-' . @$vacancy['data'][0]->servicegroupname . '-' . @$vacancy['data'][0]->title . '-' . auth()->user()->id }}">
                <input type="hidden" id="jobdetailsencoded" value="{{ @$vacancy['data'][0]->level . '-' . @$vacancy['data'][0]->servicegroupname . '-' . @$vacancy['data'][0]->title . '-' . auth()->user()->id }}">

            </div>
            <div class="row g2 mb-2">
                    <div class="col-md-8 col-sm-12">
                        <table style="width: 100%" style="border:1px solid black" id="availableJobs">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>विज्ञापन नं</th>
                                    <th>खुला र समावेशी </th>
                                    @if(date("Y-m-d H:i:s") > '2022-08-01 23:59:59')
                                        <th>दोब्बर दस्तुर</th>
                                    @else
                                        <th>दस्तुर</th>
                                    @endif
			    	                <th>Select</th>
                                </tr>

                            </thead>
                            <tbody>
                                {{-- {{dd($vacancy)}} --}}
                                <input type="hidden" id="high" value="{{ @$vacancy['high'] }}">
                                <input type="hidden" id="low" value="{{ @$vacancy['low'] }}">
                                <input type="hidden" id="allvacancies" value="{{ json_encode(@$vacancy['data']) }}">
                                @foreach (@$vacancy['data'] as $vacant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vacant->vacancynumber }}</td>
                                    <td>{{ $vacant->name }}({{ $vacant->numberofvacancy }})</td>
                                    @if($vacancyEndDateAD < $currentDate)
                                        <td>{{ $vacant->vacancyrate*2 }}</td>
                                        <?php $vacancyRate = $vacant->vacancyrate*2; ?>
                                    @else
                                        <td>{{ $vacant->vacancyrate}}</td>
                                        <?php $vacancyRate = $vacant->vacancyrate; ?>
                                    @endif
                                    
				                    <td>
                                        <?php if(empty($vacant->jobpostid)){ ?>
                                        <input type="checkbox" class="vacancycheck checkcandedited" id="{{ $vacant->name }}" onclick="addVacancy('{{ $vacant->name }}','{{ $vacant->jobcategory }}', '{{$vacant->id}}')" id="{{ $vacant->name }}" data-vacancyrate="{{ $vacancyRate }}" value="{{ $vacancyRate }}" data-vacantid="{{$vacant->id}}" {{-- onclick="appliedVacancy('{{ $vacant->vacancynumber }}')" --}} />
                                        <?php } else {?>
                                            <span style="color: green;">Already Applied</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <!-- <table style="width: 100%" style="border:1px solid black" id="calculateJobs">
                            <thead>
                                <tr>
                                    <th>विज्ञापन नं</th>
                                    <th>दस्तुर </th>
                                </tr>
                            </thead>

                            <tbody id="appendTrTd"></tbody>

                            <tfoot>
                                <td>Total</td>
                                <input type="hidden" id="totalCheckedAmt" value="0">
                                <td id="checkedAmt">0</td>
                            </tfoot>
                        </table> -->
                        <div style="font-size: 24px;color:#3C2784; text-align: center;">जम्मा दस्तुर: <span id="totalamount" style="color:red;"></span> /-</div>
                        <input type="hidden" id="internetpayment" value="">
                    </div>
                </div>

                <div class="row g2 mt-4">

                    <div class="col-md-6 col-sm-12">
                        <div class="input-group mb-3 ">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="paymentMethod">Perform Payment With</label>
                            </div>
                            <select class="custom-select" id="paymentMethod">
                                <option selected hidden>Choose...</option>
                                {{-- <option value="Khalti">Khalti</option> --}}
				                <option value="eSewa">Esewa</option>
                                 <option value="ConnectIPS">ConnectIPS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        {{-- <a class="btn" id="payment-button">Select Payment Partner</a> --}}
                        <input form="esewa-form" class="btn paymentbtn" value="Pay with E-sewa" type="submit" target="_blank" style="display:none;" id="pay-with-esewa"><span class="esewamessage"></span>
                        <input form="connectIps-form" class="btn paymentbtn" style="display:none;" target="_blank" type="submit" value="Pay with ConnectIps" id="pay-with-connectips"><span class="connectipsmessage"></span>
                    </div>
                </div>
        </div>
    </form>
    <form action="{{$esewa['payurl'].'epay/main'}}" method="POST" id="esewa-form">
        <input name="tAmt" type="hidden">
        <input name="amt" type="hidden">
        <input name="txAmt" type="hidden">
        <input value="0" name="psc" type="hidden">
        <input value="0" name="pdc" type="hidden">
        <input value="{{$esewa['appid']}}" name="scd" type="hidden">
        <input value="" name="pid" type="hidden">
        <input value="{{url('/verify-esewa/success')}}" type="hidden" name="su">
        <input value="{{url('/verify-esewa/failed')}}" type="hidden" name="fu">
    </form>

    <form action="{{$connectIps['baseurl']}}/connectipswebgw/loginpage" id="connectIps-form" method="post">
        <input type="hidden" name="MERCHANTID" id="MERCHANTID" value="{{$connectIps['merchantid']}}" />
        <input type="hidden" name="APPID" id="APPID" value="{{$connectIps['appid']}}" />
        <input type="hidden" name="APPNAME" id="APPNAME" value="{{$connectIps['appname']}}" />
        <input type="hidden" name="TXNID" id="TXNID" value="" />
        <input type="hidden" name="TXNDATE" id="TXNDATE" value="" /> <br>
        <input type="hidden" name="TXNCRNCY" id="TXNCRNCY" value="NPR" /> <br>
        <input type="hidden" name="TXNAMT" id="TXNAMT" value="" />
        <input type="hidden" name="REFERENCEID" id="REFERENCEID" value="" />
        <input type="hidden" name="REMARKS" id="REMARKS" value="None" />
        <input type="hidden" name="PARTICULARS" id="PARTICULARS" value="" />
        <input type="hidden" name="TOKEN" id="TOKEN" value="">
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



    // $( document ).ready(function() {
    //     var checked = $(this).find('.checkcandedited').val();
    // });

    var totalcount = 0;
    var tmp = [];
	var checkCate = false;
    async function addVacancy(name, category, id) {
        // var name = name.split("/")[0];
        var high = $("#high").val();
        var low = $("#low").val();
        var categoryVerify = false;
        await $.ajax({
	        url: "{{ url('checkVacancy/') }}" + '/' + id,
	        type: 'GET',
	        dataType: 'json', // added data type
	        success: function(res) {
	            if (res.success == false) {
	                toastr.error(res.message);
	                $("#" + name).prop("checked", false);
	            }
		        if ($("#" + name).is(":checked")) {
		            var checked = $('.vacancycheck').data('vacantid');
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
        sumCalculator(totalamount);
    }

    function sumCalculator(totalamount) {
        sums = 0
        appliedlist = []
        $("#appendTrTd > tr ").each(function() {
            sums = sums + parseInt($(this).find('td').last().text());
        });

        $("#checkedAmt").text(sums);
        $('.appliedVacancyClass').each(function() {
            appliedlist.push($(this).first().html());
        });

        appliedJobdetails = {
            level: jobArray[0],
            group: jobArray[1],
            designation: jobArray[2],
            userid: jobArray[3],
            appliedVacancyNo: appliedlist,
            totalsum: parseFloat(totalamount),
            servicegroupId: servicegroupId,
            designationId: designationId
        }

    }

    function initiateEsewa() {
        let url = "{{url('/')}}";
	var amount = $('#internetpayment').val();
	var finalAmount = parseFloat(amount); 
        $.ajax({
            type: 'POST',
            url: url + '/initiate-payment',
            data: {
                vacancyid: tmp,
                designationid: designationId,
		        finalamount: finalAmount,
                usedthrough: 'esewa',
                "_token": "{{csrf_token()}}"
            },
            success: function(response) {       
                let data = JSON.parse(response);
                if(data.type=='success'){
                    $('input[name="tAmt"]').val(data.response.amount);
                    $('input[name="amt"]').val(data.response.amount);
                    $('input[name="txAmt"]').val(0);
                    $('input[name="pid"]').val(data.response.transactioncode);
                    $('#pay-with-esewa').show();
                    $(".esewamessage").html('');
                    $(".connectipsmessage").html('');
                } else {
                    $('#pay-with-esewa').hide();
                    $(".esewamessage").html(data.message);
                    $(".connectipsmessage").html('');
                }
            }
        });
    }

    function initiateConnectIps() {
        let url = "{{url('/')}}";
	    var amount = $('#internetpayment').val();
	    var finalAmount = parseFloat(amount); 
        $.ajax({
            type: 'POST',
            url: url + '/initiate-connectips',
            data: {
                vacancyid: tmp,
                designationid: designationId,
                finalamount: finalAmount,
                usedthrough: 'connectips',
                "_token": "{{csrf_token()}}"
            },
            success: function(response) {
                let data = JSON.parse(response);
                if(data.type=='success'){
                    $('input[name="TXNID"]').val(data.response.txnid);
                    $('input[name="TXNDATE"]').val(data.response.txndate);
                    $('input[name="TXNAMT"]').val(data.response.txnamt);
                    $('input[name="REFERENCEID"]').val(data.response.txnid);
                    $('input[name="REMARKS"]').val(data.response.remarks);
                    $('input[name="PARTICULARS"]').val(data.response.particulars);
                    $('input[name="TOKEN"]').val(data.response.token);
                    $(".esewamessage").html('');
                    $(".connectipsmessage").html();
                    $('#pay-with-connectips').show();
                } else {
                    $('#pay-with-connectips').hide();
                    $(".esewamessage").html('');
                    $(".connectipsmessage").html(data.message);
                }
            }
        })
    }    

    var checkout = '';
    $("#paymentMethod").on('change', function(event) {
        // $("#payment-button").prop('disabled', true);
        $('#pay-with-esewa').hide();
        $('#pay-with-connectips').hide();
        $("#payment-button").html('Unsupported Payment Partner');
        if ($("#paymentMethod").val() == 'Khalti') {
            $(".paymentbtn").removeClass('btn-primary');
            $(".paymentbtn").removeClass('btn-success');
            $(".paymentbtn").addClass('btn-warning');
            $("#payment-button").html('Pay With Khalti').show();
        } else if ($("#paymentMethod").val() == 'eSewa') {
            $(".paymentbtn").removeClass('btn-warning');
            $(".paymentbtn").removeClass('btn-primary');
            $(".paymentbtn").addClass('btn-success');

            $("#payment-button").hide();
            initiateEsewa();
        } else if ($("#paymentMethod").val() == 'ConnectIPS') {
            $(".paymentbtn").removeClass('btn-warning');
            $(".paymentbtn").removeClass('btn-success');
            $(".paymentbtn").addClass('btn-primary');

            $("#payment-button").hide();
            initiateConnectIps();
        }
    });
    
    var config = {
        "publicKey": "{{ config('app.khalti_public_key') }}",
        "productIdentity": '{{$productId}}',
        "productName": 'CIT Vacancy',
        "productUrl": "http://127.0.0.1:8000/dashboard",
        "paymentPreference": [
            "KHALTI",
        ],
        "eventHandler": {
            onSuccess(payload) {
                let url = "{{ url('/') }}"
                $.ajax({
                    type: 'POST',
                    url: url + '/khalti/verify/payment',
                    data: {
                        token: payload.token,
                        idx: payload.idx,
                        prodcutid: payload.product_identity,
                        productname: payload.product_name,
                        amount: payload.amount,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {

                        $.ajax({
                            type: 'POST',
                            url: url + '/khalti/store_payment',
                            data: {
                                response: response,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                $.ajax({
                                    type: 'POST',
                                    url: baseUrl + '/storeApplyJobsDetails',
                                    data: {
                                        response: appliedJobdetails,
                                        idx: payload.idx,
                                        paymentsource: 'Khalti',
                                        vacancyid: tmp,
                                        "_token": "{{ csrf_token() }}",
                                    },
                                    success: function(response) {
                                        toastr.success("Payment has been Successfully.");
                                        $("#vacancydetailModal").modal('hide');
                                        // $.notify(response.message, 'success');
                                    },
                                    error: function(response) {
                                        toastr.error("Please Contact Admin")
                                    }
                                })
                            },
                            error: function(response) {
                                $.notify(response.message, 'error');
                            }
                        })
                    }
                })
            },
            onError(error) {
                console.log(error);
            },
            onClose() {
            }
        }
    };
    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function() {
        var amount = $('#internetpayment').val();
        var finalAmount = parseFloat(amount) * 100;

         if(finalAmount == NaN || finalAmount==0){
             toastr.error('Please try Again');
         }
        checkout.show({
            amount: finalAmount
        });
    }
</script>
