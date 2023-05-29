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
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        padding: 30px
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
    <form id="applyJobsForm" method="post" class="form" enctype="multipart/form-data"
        action="{{ route('applyJobsForm') }}">
        <div class="txt_center">
            <div class="mb-13 text-center head_text">
                <!--begin::Title-->
                <div class="head_side_design">
                    <h1>Apply / View</h1>
                </div>

                <!--end::Title-->
            </div>
        </div>

        <!--end::Heading-->
        <div class="bx_content">
            <div class="row g2 mb-2" style="    border-bottom: 1px solid #ddd;
        margin-bottom: 20px !important;">
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <p class="fs-6 fw-bold mb-2 app_txt">पद :
                        <span>{{ @$vacancy[0]->title }}</span>
                        <input type="hidden" id="designationId" value="{{ @$vacancy[0]->designationid }}" />

                    </p>

                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 fv-row">
                    <p class="fs-6 fw-bold mb-2 app_txt">सेवा / समूह:
                        <span>{{ @$vacancy[0]->servicegroupname }}</span>
                        <input type="hidden" id="servicegroupId" value="{{ @$vacancy[0]->servicegroupid }}" />

                    </p>

                </div>
                <!--end::Col-->
                <div class="col-md-4 fv-row">
                    <p class="fs-6 fw-bold mb-2 app_txt">तह : <span>{{ @$vacancy[0]->level }} </span>

                </div>
                <!--end::Col-->

                <input type="hidden" id="jobdetailsencoded"
                    value="{{ @$vacancy[0]->level . '-' . @$vacancy[0]->servicegroupname . '-' . @$vacancy[0]->title . '-' . auth()->user()->id }}">

                <input type="hidden" id="jobdetailsencoded"
                    value="{{ @$vacancy[0]->level . '-' . @$vacancy[0]->servicegroupname . '-' . @$vacancy[0]->title . '-' . auth()->user()->id }}">

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
                                <input type="hidden" id="allvacancies" value="{{ json_encode(@$vacancy) }}">
                                @foreach (@$vacancy as $vacant)
                                    @if ($vacant->jobcategory == 1)
                                        <input type="hidden" class="levelKhulla" id="baserate"
                                            data-vancno="{{ $vacant->vacancynumber }}"
                                            value="{{ $vacant->vacancyrate }}">
                                    @endif
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vacant->vacancynumber }}</td>
                                        <td>{{ $vacant->name }}({{ $vacant->numberofvacancy }})</td>
                                        <td>{{ $vacant->vacancyrate }}</td>
                                        <td>
                                            <input type="checkbox" class="vacancycheck"
                                                id="{{ $vacant->vacancynumber }}"
                                                value="{{ $vacant->vacancyrate }}"
                                                onclick="appliedVacancy({{ $vacant->vacancynumber }})" />
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>


                        </table>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <table style="width: 100%" style="border:1px solid black" id="calculateJobs">
                            <thead>
                                <tr>
                                    <th>विज्ञापन नं</th>
                                    <th>दस्तुर </th>
                                </tr>

                            </thead>
                            <tbody id="appendTrTd">

                            </tbody>

                            <tfoot>
                                <td>Total</td>
                                <input type="hidden" id="totalCheckedAmt" value="0">
                                <td id="checkedAmt">0</td>
                            </tfoot>

                        </table>

                    </div>



                </div>

                <div class="row g2 mt-4">

                    <div class="col-md-8 col-sm-12">
                        <div class="input-group mb-3 ">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="paymentMethod" style="font-weight:bold;">Perform Payment With</label>
                            </div>
                            <select class="custom-select" id="paymentMethod" style="height:40px;">
                                <option selected hidden>Choose...</option>
                                <option value="eSewa">Esewa</option>
                                <option value="Khalti">Khalti</option>
                                <option value="ConnectIPS">ConnectIPS</option>
                            </select>
                        </div>
                    </div>
			<div class="col-md-4 col-sm-12">
                    <a class="btn btn-success" id="payment-button" style="background-color: #08c;color: #FFF;font-weight: bold;" >Select Payment Partner</a>
                </div>
                </div>
                



            </div>
        </div>
    </form>
</div>
<script>
    var appliedlist = [];
    var isDisplayed = false;
    var displayedNo = '';
    var appliedJobdetails = '';

    function appliedVacancy(vacancynumber) {
        var joblist = $.parseJSON($("#allvacancies").val());
        var vacancyrate = $('#' + vacancynumber).val();
        var baserate = $('#baserate').val();
        var basevaccno = parseInt($('#baserate').attr('data-vancno'));
        var condition = appliedlist.includes(basevaccno);

        if ($('#' + vacancynumber).is(":checked")) {
            if (isDisplayed) {
                $("#appendTrTd").append('<tr class="displaylist" id="appended' + vacancynumber + '"><td>' +
                    vacancynumber +
                    '</td><td>' + vacancyrate + '</td></tr>');
                if (vacancynumber == basevaccno) {
                    $("#appended" + displayedNo).remove();
                    vacancyrate = $('#' + displayedNo).val();
                    $("#appendTrTd").append('<tr class="displaylist" id="appended' + displayedNo + '"><td>' +
                        displayedNo +
                        '</td><td>' + vacancyrate + '</td></tr>');
                }
            } else {
                $("#appendTrTd").append('<tr class="displaylist" id="appended' + vacancynumber + '"><td>' +
                    vacancynumber +
                    '</td><td>' + baserate + '</td></tr>');
                isDisplayed = true;
                displayedNo = vacancynumber;
            }

            appliedlist.push(vacancynumber);
        } else {
            $('#appended' + vacancynumber).remove();
            var index = appliedlist.indexOf(vacancynumber);
            appliedlist.splice(index, 1);
            if (appliedlist.length == 0) {
                isDisplayed = false;
                displayedNo = '';
            } else if (basevaccno == vacancynumber || displayedNo == vacancynumber) {
                isDisplayed = true;
                var firstEl = $(".displaylist td").first().text();
                $("#appended" + firstEl).remove();
                $("#appendTrTd").append('<tr class="displaylist" id="appended' + firstEl + '"><td>' + firstEl +
                    '</td><td>' + baserate + '</td></tr>');
                displayedNo = firstEl;
            }

        }
        var sums = 0
        $("#appendTrTd > tr ").each(function() {
            sums = sums + parseInt($(this).find('td').last().text());
        });



        var jobDetails = $("#jobdetailsencoded").val();
        var designationId = $("#designationId").val();
        var servicegroupId = $("#servicegroupId").val();

        var jobArray = jobDetails.split('-');

        appliedJobdetails = {
            level: jobArray[0],
            group: jobArray[1],
            designation: jobArray[2],
            userid: jobArray[3],
            appliedVacancyNo: appliedlist,
            totalsum: sums,
            servicegroupId: servicegroupId,
            designationId: designationId
        }
        jobDetails = JSON.stringify(appliedJobdetails);
        $("#checkedAmt").text(sums);

    }
</script>
<script>
    var checkout = '';
    $("#paymentMethod").on('change', function(event) {
        // $("#payment-button").prop('disabled', true);
        $("#payment-button").html('Unsupported Payment Partner');
        if ($("#paymentMethod").val() == 'Khalti') {
            $("#payment-button").html('Pay With Khalti');
        }
    });
    var config = {
        "publicKey": "{{ config('app.khalti_public_key') }}",
        "productIdentity": 'appliedJobdetails.group',
        "productName": 'appliedJobdetails.designation',
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
                        prodcutid: appliedJobdetails.designation,
                        productname: appliedJobdetails.group,
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
                                        "_token": "{{ csrf_token() }}",
                                    },
                                    success: function(response) {
                                        console.log('response done and dusted');
                                        $("#vacancydetailModal").modal('hide');
                                        $.notify(response.message, 'success');
                                    },
                                    error: function(response) {
                                        $.notify('Please Contact Admin',
                                            'error');

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
                console.log('widget is closing');
            }
        }
    };
    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function() {
        var amount = parseFloat(appliedJobdetails.totalsum) * 100;
        checkout.show({
            amount: 1000
        });
    }
</script>
