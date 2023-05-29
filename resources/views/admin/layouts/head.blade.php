<head>
	{{-- <title>@yield('siteTitle')- {{ config('app.name') }}</title> --}}
	<title>@yield('siteTitle')- नागरिक लगानी कोष | अनलाईन आवेदन प्रणाली</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />    
  
    <link rel="shortcut icon" href="{{asset('adminAssets/assets/images/favicon.ico')}}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('adminAssets/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
   
    <link href="{{asset('adminAssets/assets/css/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/css/bootstrap/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('adminAssets/assets/css/bootstrap/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
 
    <link href="{{asset('adminAssets/assets/css/layout.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('adminAssets/assets/css/bootstrap/css/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/css/jquery.timepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/css/nepali.datepicker.v2.2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/css/select2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/css/main.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('adminAssets/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('adminAssets/assets/css/main.scss')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('adminAssets/assets/css/main.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('adminAssets/assets/css/cropper.min.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
		integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('adminAssets/assets/js/jquery/jquery.min.js') }}"></script>
      
    <style>

        .active a{
            background: #3C2784;
            color: white;
        }
    .notifyjs-corner{
        z-index: 9999999 !important;
    }

        .successColor {
            color: green;
        }

        .errorColor {
            color: red;
        }
        .error {
            color: red !important;
            border: none !important;
        }
        .applicantCommonInfo ul {
            display: flex;
            list-style: none;
            margin-bottom: 1px;
        }
        .registerInfo {
            background-color: #cde0f4;
            color: black;
        }
        .registerInfo li {
            margin-right: 35px;
            padding: 3px 10px;
        }

        .applyDetailInfo {
            background-color: #ddf3fd;
            margin: 0px 25px;
            width: 95%;
        }
        .applyDetailInfo li {
            margin-right: 35px;
            padding: 3px 10px;
        }

        .applicantCommonInfo{
            border: 1px solid #d8d8e6;
            /* padding: 5px; */
        }
        #appliedVacancyTable {
            margin: 0px 25px;
            margin-right: 30px;
            width: 95%;
        }

        .head {
            /* background-color: #e9daf2; */
            color: #0b0b53;
        }
        #admit-btn{
            position: absolute;
            right: -10px;
        }
        #admit-btn .btn-success{
            background-color:#00b753 !important; 
        }
        #admit-btn .btn-danger{
            background-color:#f70a75 !important; 
        }
        .sample{
            color:#da69ea;
            font-size:32px;
            opacity:10%;
            font-weight: 500;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .sweet-alert h2 {
            font-size: 20px !important;
        }
        .sweet-alert .sa-icon {
                width: 50px !important;
                height: 50px !important;
                margin: auto !important;
        }   
        .sweet-alert .sa-icon.sa-warning .sa-body {
                width: 4px !important;
                height: 20px !important;
        } 
        .sweet-alert .sa-icon.sa-warning .sa-dot {
                width: 5px !important;
                height: 5px !important;
        }
        .sweet-alert button.cancel {
            background-color: red !important;
        }
        .sweet-alert button {
            background-color: #3C2784 !important;
        }

        .showSweetAlert[data-animation="pop"] {
                width: 530px !important;
        }
        div#ndp-nepali-box {
            z-index: 9999999 !important;
        }
        .loader {
            border: 16px solid #F3F3F3;
            border-top: 16px solid #3498DB;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>        
</head>

@yield('css')