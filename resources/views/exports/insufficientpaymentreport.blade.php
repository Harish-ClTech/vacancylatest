<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <style>
        @font-face { 
            font-family: 'YatraOne';
            src: url(data:font/truetype;charset=utf-8;base64,{{base64_encode(file_get_contents(public_path('fonts/YatraOne.ttf')))}}) format('truetype'); 
            font-weight:normal; 
        }
        @font-face { 
            font-family: 'Khand-Regular';
            src: url(data:font/truetype;charset=utf-8;base64,{{base64_encode(file_get_contents(public_path('fonts/Khand-Regular.ttf')))}}) format('truetype'); 
            font-weight:normal; 
        }
       
        body {
            font-family: YatraOne !important;
        }
        .governo-tables{
            width: 100%;
            padding: 5px;
        }
        /* .custom_info-box_wrapper
        {
            width: max-content;
        } */
        table thead tr {
            background:#70aad4;
            text-align:center;
        }
        table tbody tr {
            margin-top:10px;
        }
        table tbody tr td {
            text-align:left;
        }
        table thead tr:nth-child(1) th
        {
            padding: 5px 15px;
            position:sticky;
            top:0px;
        }
        table thead tr:nth-child(2) th
        {
            padding: 5px 15px;
            position:sticky;
            top:46px;
        }
        table thead tr th
        {
            background:#043150;
            color: white;
            border-top:1px solid white;
        }
        .table-bordered
        {
            /* overflow: auto; */
            width: 100%;
            /* display: block; */
            height:410px;
        }
        /* table {
        border-collapse: collapse;
        overflow-x: auto;
        display: block;
        width: fit-content;
        max-width: 100%;
        box-shadow: 0 0 1px 1px rgba(0, 0, 0, .1);
        } */
        table thead tr th
        {
            white-space: nowrap;
            /* padding:0px !important; */
            text-align:center;
        }
        table tbody tr td
        {
            white-space: nowrap;
            /* padding:0px !important; */
            text-align:left;
        }
        /* table thead tr th
        {
            width: 30%;
        } */
        .tr-head th{
            text-align:center;
            font-size:18px;
        }
        /* .tr-head th:hover{
            color:#572424;
        } */
        tr th:hover{
            color:#572424;
        }
    </style>
    
</head>
<body style='font-family: YatraOne;'>
    <div class="container">
        {{-- {{dd(asset('storage/fonts/yatraone-regular.ttf'))}} --}}
        <div class="card">
            <div class="card-body" style="text-align: center">
                <h1 style="margin-top: 5px;"><u>अपर्याप्त रकम भुक्तानीको विवरण</u></h1>
            </div>
        </div>
        <div class="no-more-tables governo-tables">
            <table class="table-bordered table-responsive table-striped table-condensed cf" id="sdr_table" width="100%">
                <thead class="cf">
                    <tr>
                        <th>क्र.सं.</th>
                        <th>दर्ता नं.</th>
                        <th>आवेदन मिति</th>
                        <th>नाम</th>
                        <th>लिङ्ग</th>
                        <th>इमेल</th>
                        <th>संपर्क नम्बर</th>
                        <th>तह</th>
                        <th>पद</th>
                        <th>खुला/समावेशी</th>
                        <th>विज्ञापनको दर</th>
                        <th>भुक्तानी भएको रकम</th>
                        <th>बाँकी रकम</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $value)
                        <tr>
                            <td>{{ $loop->index+1}}</td>
                            <td>{{ $value->registrationnumber}}</td>
                            <td>{{ $value->applieddatebs}}</td>
                            <td> {{$value->fullname}}</td>
                            <td>  {{$value->gender}}</td>
                            <td>  {{$value->email}}</td>
                            <td>  {{$value->contactnumber}}</td>
                            <td>  {{$value->level}}</td>
                            <td>  {{$value->designation}}</td>
                            <td>  {{$value->jobcategory}}</td>
                            <td>  {{$value->vacancyrate}}</td>
                            <td>  {{$value->paidamount}}</td>
                            <td>  {{$value->vacancyrate-$value->paidamount}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
