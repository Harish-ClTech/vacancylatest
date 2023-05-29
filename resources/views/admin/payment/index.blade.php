@extends('admin.layouts.admin_designs')

@section('siteTitle')
  Payment
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-body">
                       
                            <!--begin::Heading-->
                            <div class="mb-13 text-center">
                                <!--begin::Title-->
                                <h1 class="mb-3">Payment</h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <div class="row g-12 mb-12">
                                <!--begin::Col-->
                                <div class="col-md-3 fv-row">
                                    <label for="payment" class="required fs-6 fw-bold mb-2">Payment</label>
                                    <select class="form-select form-select-solid" id="payment" name="payment"
                                        style="padding: 4px;" >
                                        <option value="">Select </option>
                                        <option value="khalti">Khalti</option>
                                        <!-- <option value="esewa">E-sewa</option> -->


                                    </select>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="KhaltiDetial" hidden="true">
                            <div class="row g-12 mb-12">
                                <!--begin::Col-->
                                <div class="col-md-3 fv-row">
                                    <label for="amount" class="required fs-6 fw-bold mb-2">Amount</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Amount" id="amount" name="amount"
                                        value="" />
                                        <p id="error-amount" style="color: red;"></p>
                                </div>

                                <!--end::Col-->
                            </div>
                             <button id="payment-button">Pay with Khalti</button>

                        </div>

                        </div>
                        <div class="esewaDetial" hidden="true">

                        <form action="https://uat.esewa.com.np/epay/main" method="POST">
                            <input value="100" name="tAmt" type="hidden">
                            <input value="90" name="amt" type="hidden">
                            <input value="5" name="txAmt" type="hidden">
                            <input value="2" name="psc" type="hidden">
                            <input value="3" name="pdc" type="hidden">
                            <input value="EPAYTEST" name="scd" type="hidden">
                            <input value="ee2c3ca1-696b-4cc5-a6be-2c40d929d453" name="pid" type="hidden">
                            <input value="http://merchant.com.np/page/esewa_payment_success?q=su" type="hidden" name="su">
                            <input value="http://merchant.com.np/page/esewa_payment_failed?q=fu" type="hidden" name="fu">
                            <input value="Pay with E-sewa" type="submit" target="_blank">
                            </form>
                        </div>

                    </div>
                    <!--end::Card header-->

                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </div>
@endsection


@section('scripts')
<script>
    $(document).ready(function(){
        $('#payment').click(function(){
            var paymentValue= $(this).find('option:selected').val();
            if(paymentValue=='khalti'){
                $('.KhaltiDetial').removeAttr('hidden');
                $('.esewaDetial').attr('hidden', 'true');

            }else if(paymentValue=='esewa'){
                $('.esewaDetial').removeAttr('hidden');
                $('.KhaltiDetial').attr('hidden', 'true');

            }

        })


    })
</script>
<script>
    var config = {
        // replace the publicKey with yours
        "publicKey": "{{config('app.khalti_public_key')}}",
        "productIdentity": "1234567890",
        "productName": "Dragon",
        "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
        "paymentPreference": [
            "KHALTI",
            "EBANKING",
            "MOBILE_BANKING",
            "CONNECT_IPS",
            "SCT",
            ],
        "eventHandler": {
            onSuccess (payload) {
                console.log(payload);
                    let url = "{{url('/')}}"
                    $.ajax({
                        type: 'POST',
                        url: url + '/khalti/verify/payment',
                        data: {
                            token: payload.token,
                            idx: payload.idx,
                            prodcutid: payload.product_identity,
                            productname: payload.product_name,
                            amount: payload.amount,
                            "_token": "{{csrf_token()}}"
                        },
                        success: function(response) {
                            console.log(response);
                            // debugger;
                            $.ajax({
                                type: 'POST',
                                url: url + '/khalti/store_payment',
                                data: {
                                    response: response,
                                    "_token": "{{csrf_token()}}"
                                }
                            })
                        }
                    })
                },
            onError (error) {
                console.log(error);
            },
            onClose () {
                console.log('widget is closing');
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function () {
        var amount= $('#amount').val(); 
        var finalAmount = parseFloat(amount) ;       
        // if (amount < 1000) {
        // 		$('#error-amount').text('Please Enter amount  Rs 1000 !!')
        // 		return false;
        // 	}
        // minimum transaction amount must be 10, i.e 1000 in paisa.
        checkout.show({amount: finalAmount});
    }
</script>

@endsection
