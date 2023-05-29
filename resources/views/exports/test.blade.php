<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hi</title>
    <link rel="stylesheet" href="build/assets/main.css">
    <style>
        body{
             margin: 0;
             padding: 0;
        }
    </style>

    <style>
        h4 {
            margin: 0px;
        }

        .billing_wrapper {
            position: relative;
            width: 100%;
            height: 4in;
        }

        .billing_wrapper .bill_img {
            width: 100%;
        }

        .billing_wrapper .billing_input {}

        .billing_wrapper .billing_input h4 {
            position: absolute;
            margin: 0px;
            margin-bottom: 0px;
            line-height: 1;
            font-size: 14px;
        }

        .billing_wrapper .billing_input h4:nth-child(1) {
            left: 80px;
            top: 65px;
        }

        .billing_wrapper .billing_input h4:nth-child(2) {
            left: 80px;
            top: 105px;
        }

        .billing_wrapper .billing_input h4:nth-child(3) {
            left: 80px;
            top: 158px;
        }

        .billing_wrapper .billing_input h4:nth-child(4) {
            left: 80px;
            top: 208px;
        }

        .billing_wrapper .billing_input h4:nth-child(5) {
            left: 80px;
            top: 252px;
        }

        .billing_wrapper .billing_input h4:nth-child(6) {
            left: 80px;
            top: 298px;
        }

        .billing_wrapper .billing_input h4:nth-child(7) {
            left: 80px;
            top: 335px;
        }


        .billing_wrapper .date_wrapper {
            position: absolute;
            top: 0px;
            right: 0px;
        }

        .billing_wrapper .date_wrapper h4 {
            position: absolute;
            font-size: 14px;
            margin: 0px;

        }

        .billing_wrapper .date_wrapper h4:nth-child(1) {

            right: 260px;
            top: 0px;
        }

        .billing_wrapper .date_wrapper h4:nth-child(2) {
            right: 0px;
            top: 0px;
        }

        .table_wrapper {}

        .table_wrapper .table_wrap {}

        .table_wrapper h4 {
            font-size: 14px;

            position: absolute;
        }

        .table_wrapper .table_wrap h4:nth-child(1) {
            top: 35px;
            right: 375px;

        }

        .table_wrapper .table_wrap h4:nth-child(2) {
            top: 35px;
            right: 260px;
        }

        .table_wrapper .table_wrap h4:nth-child(3) {
            top: 35px;
            right: -30px;
        }

        .total_balance {}

        .total_balance h4 {
            position: absolute;
            margin: 0px;
            margin-bottom: 0px;
        }

        .total_balance h4:nth-child(1) {
            bottom: 110px;
            right: 0px;
        }

        .total_balance h4:nth-child(2) {
            bottom: 80px;
            right: 0px;
        }

        .total_balance h4:nth-child(3) {
            bottom: 40px;
            right: 0px;
        }

        .acc_sign {
            position: absolute;
            bottom: 0px;
            right: 20px;
        }

        .acc_sign img {
            width: 80px;
        }

    </style>
</head>

<body>
    <?php
        $title = 'कर्मचारी सञ्चय कोषasd';
        $titleFontSize = titleFontSize($title, 24); 
    ?>

    <page size="A4">
        <h1 style="font-size: <?php echo $titleFontSize; ?>pt;">{{ $title }}</h1>

        <div class="billing_wrapper">
            <!-- <img class="bill_img" src="{{ public_path('build/assets/image/img1.jpg') }}"> -->
            <div class="billing_input">
                <h4>2354876</h4>
                <h4>28937498273998237</h4>
                <h4>Jestha</h4>
                <h4>Sachin Sharma Siwakoti</h4>
                <h4>10</h4>
                <h4>5</h4>
                <h4>Godawari</h4>
            </div>
            <div class="date_wrapper">
                <h4>2075/08/10</h4>
                <h4>2075/08/10</h4>
            </div>
            <div class="table_wrapper">
                <div class="table_wrap">
                    <h4>1.</h4>
                    <h4>Bhadra Fee</h4>
                    <h4>5000</h4>
                </div>
                <div class="table_wrap">
                    <h4>1.</h4>
                    <h4>Bhadra Fee</h4>
                    <h4>5000</h4>
                </div>
            </div>
            <div class="total_balance">
                <h4>5000</h4>
                <h4>5000</h4>
                <h4>5000</h4>
            </div>
            <div class="acc_sign">
                <img src="{{ public_path('build/assets/image/sign.png') }}">

            </div>
        </div>
    </page>

    {{-- @if($link == 'Y')
        <a style="position: absolute; top: 0px; right: 0px;" href="{{ route('generate.pdf-sample') }}"
            target="_blank">View PDF</a>
    @endif --}}
    {{-- <script>
        $(document).ready(function{
            alert('herer');
            console.log('yes !! it\'s working.);

        });
    </script> --}}

</body>

</html>