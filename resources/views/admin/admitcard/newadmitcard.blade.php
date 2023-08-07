<!DOCTYPE html>
<html>
<head>
      <title>प्रवेश पत्र</title>
      <link rel="stylesheet" href="{{asset('adminAssets/assets/css/bootstrap/css/bootstrap.min.css')}}">

      <style>
            .sanchaya_admit_card {
                  padding: 30px;
                  height: 1400px;
                  max-height: 100%;
                  margin-bottom: 35px;
                  page-break-inside: avoid;
                  /* border: 1px solid; */
            }

            .sanchaya_admit_card .top_header {
            overflow: hidden;
            margin-bottom: 15px;
            }

            .sanchaya_admit_card .top_header .card_logo {
            width: 25%;
            margin: 0px auto;
            float: left;
            }

            .sanchaya_admit_card .top_header .card_logo img {
            width: 80px;
            }

            .sanchaya_admit_card .top_header .head_txt {
            width: 50%;
            float: left;
            text-align: center;
            /* margin-top: 15px; */
            }

            .sanchaya_admit_card .top_header .head_txt h4 {
            font-size: 30px;
            color: #000;
            -webkit-text-stroke: 1px;
            margin-top: 0px;
            margin-bottom: 6px;
            }

            .sanchaya_admit_card .top_header .head_txt h5 {
            /* font-size: 30px; */
            color: #000;
            -webkit-text-stroke: 1px;
            margin-top: 0px;
            margin-bottom: 6px;
            }

            .sanchaya_admit_card .top_header .head_txt h4:nth-last-child(1) {
            margin-bottom: 0px;
            }

            .sanchaya_admit_card .top_header .rt_img_wrapper {
            float: left !important;
            width: 25%;
            position: relative;
            }

            .sanchaya_admit_card .top_header .rt_img_wrapper .signature {
            position: absolute;
            left: 0px;
            bottom: 0px;
            width: 50%;
            }

            .sanchaya_admit_card .top_header .rt_img_wrapper .signature h5 {
            /* border-bottom: 1px dotted #000; */
            padding-top: 30px;
            }

            .sanchaya_admit_card .top_header .rt_img_wrapper .signature img {
            width: 120px;
            position: absolute;
            top: -50px;
            left: 00%;
            border: 1px solid #ddd;
            min-height: 30px;
            }

            .sanchaya_admit_card .top_header .rt_img_wrapper .user_img {
            overflow: hidden;
            float: right;
            width: 50%;
            padding-left: 30px;
            }

            .sanchaya_admit_card .top_header .rt_img_wrapper .user_img img {
            float: right;
            width: 100px;
            border: 1px solid #ddd;
            height: 100px;
            }

            .sanchaya_admit_card .card_content_wrapper .card_flx {
            overflow: hidden;
            }

            .sanchaya_admit_card .card_content_wrapper .card_flx .lt_ct {
            width: 48%;
            float: left;
            }

            .sanchaya_admit_card .card_content_wrapper .card_flx .rt_ct {
            width: 48%;
            float: right;
            }

            .sanchaya_admit_card .ct_flx {
            overflow: hidden;
            }

            .sanchaya_admit_card .ct_flx .citizenship_card {
            margin-top: 0px;
            margin-bottom: 15px;
            width: 48%;
            float: left;
            border: 1px solid #ddd;
            }

            .sanchaya_admit_card .ct_flx .citizenship_card img {
            width: 100%;
            float: right;
            -o-object-fit: contain;
            object-fit: contain;
            height: 200px;
            }

            .sanchaya_admit_card .ct_flx .lt_float img {
            float: left;
            }

            .sanchaya_admit_card .ct_flx .rt_float {
            float: right !important;
            }

            .sanchaya_admit_card .official_use .official_box h4 {
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
            display: inline-block;
            margin: 0px;
            color: #000;
            }

            .sanchaya_admit_card .official_use .official_box p {
            margin-bottom: 8px;
            font-size: 16px;
            color: #000;
            }

            .sanchaya_admit_card .official_use .off_details {
            width: 100%;
            overflow: hidden;
            margin-top: 10px;
            }

            .sanchaya_admit_card .official_use .off_details .lt_dt h4 {
            font-size: 16px;
            font-weight: 500;
            margin: 0px;
            color: #000;
            }

            .sanchaya_admit_card .official_use .off_details .lt_dt h4 span {
            color: #000;
            font-weight: 600;
            font-weight: 14px;
            }

            .sanchaya_admit_card .official_use .off_details .rt_dt {
            padding: 5px 0px;
            text-align: right;
            margin-top: 15px;
            }

            .sanchaya_admit_card .official_use .off_details .rt_dt .txt_cntr {
            display: inline-block;
            text-align: left;
            }

            .sanchaya_admit_card .official_use .off_details .rt_dt .txt_cntr h5 {
            font-size: 16px;
            font-weight: 500;
            text-align: left;
            margin-top: 5px;
            margin-bottom: 5px;
            color: #000;
            }

            .sanchaya_admit_card .rules_list h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            display: inline-block;
            border-bottom: 2px solid #000;
            }

            .sanchaya_admit_card .rules_list ul {
            padding-left: 0px;
            }

            .sanchaya_admit_card .rules_list ul li {
            font-size: 16px;
            list-style: none;
            overflow: hidden;
            width: 100%;
            font-weight: 500;
            color: #000;
            line-height: 20px;
            }

            .sanchaya_admit_card .rules_list ul li .numbering {
            padding-right: 15px;
            float: left;
            }

            .sanchaya_admit_card .rules_list ul li .list_text {
            width: 90%;
            float: left;
            }

            .sanchaya_admit_card table th {}

            .sanchaya_admit_card table td,
            th {
            padding: 0px 15px !important;
            font-size: 16px;
            height: 30px;
            vertical-align: middle !important;
            }

            .sanchaya_admit_card .signature_official img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            
            
            }
            
            /*# sourceMappingURL=main.css.map */
            @font-face {
            font-family: 'Mukta';
            src: url(data:font/truetype;charset=utf-8;base64,{{base64_encode(file_get_contents(public_path('fonts/Mukta-Regular.ttf'))) }}) format('truetype');
            font-weight:normal;
            }
            
            body {
            font-family: Mukta !important;
            }
            
      </style>
      <script>
            window.onload = function() {
                  window.print();
            };
      </script>
</head>
<body>
      @foreach($data as $row)
            <page size="A4">
                  {{$row}}
            </page>
      @endforeach
   
</body>
</html>