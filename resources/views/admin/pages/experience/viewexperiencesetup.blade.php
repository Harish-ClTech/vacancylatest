<div class="p-0 m-0">
    <div class="row_form">
        <div class="post flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="col-md-12">
                <!--begin::Card-->
                <div class="card_form">
                    <div class="card-body py-4">
                        <div class="row g2 mb-2 title_add">
                        
                            <div class="alert alert-danger" style="color: #0D4A71;    background-color: #83cef72e;" role="alert">
                                            NOTE :- ........
                                            {{-- <p>नागरिक लगानी कोष, नागरिक लगानी कोष शर्त नियमावली, २०७८ को नियम १३ को उपनियम (४) को स्पष्टीकरण
                                            खण्डमा “संगठित संस्था”भन्नाले देहाय बमोजिम सम्झनु पर्छ भन्ने उल्लेख भएकोले सोही बमोजिमको संगठित
                                            संस्थामा कार्य गरेको भए मात्र कार्य अनुभव सम्बन्धी विवरण भरी आवश्यक कागजातहरु अपलोड गर्नुहुन सम्बन्धित
                                            सबै आवेदकहरुलाई अनुरोध गरिन्छ ।</p>

                                            <p>“स्पष्टीकरण : “संगठित संस्था”भन्नाले पचास प्रतिशत वा सो भन्दा बढी शेयर वा जायजेथामा नेपाल सरकारको
                                            स्वामित्व वा नियन्त्रण भएको संस्थान, कम्पनी, बैंक, समिति वा संघीय कानून बमोजिम स्थापित वा नेपाल
                                            सरकारद्वारा गठित आयोग, संस्थान, प्राधिकरण, बोर्ड, केन्द्र, परिषद् र यस्तै प्रकृतिका अन्य संगठित संस्थालाई
                                            सम्झनु पर्छ ।”</p> --}}
                
                            </div>
                            <div class="d-flex justify-content-end">

                                <button type="button" id="addExperienceSetup"   style="background: #3C2784; color: #fff;border: none;padding: 10px 20px;font-weight: 600;border-radius: 3px;" data-toggle="modal"
                                    data-target="#modal_boxx" class="pull-right">
                                    <i class="fa fa-plus"></i>
                                    सिर्जना गर्नुहोस्
                                </button>
                            </div>

                        </div>
			            <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table class="table-bordered table-striped table-condensed cf"
                                    id="experienceDetailTable" width="100%">

                                    <thead class="cf">

                                        <tr>
                                            <th>क्रम संख्या </th>
                                            <th>कार्यालयको नाम</th>
                                            <th>कार्यालय ठेगाना</th>
                                            <th>रोजगारी प्रकार </th>
                                            <th>पद</th>
                                            <th>तह/श्रेणी</th>
                                            <th>रोजगारी तह</th>
                                            <th>रोजगारी अवस्था</th>
                                            <th>अवधि देखि </th>
                                            <th>अवधि सम्म</th>
                                            <th>Document</th>
                                            <th width="10%">Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </div>
    <div class="row mx-1">
        <div class="col-md-12  ">
			@if ((auth()->user()->is_submitted == 0) || (auth()->user()->is_submitted == 1 and auth()->user()->experience_enabled == 1))
            <div class="btn_flx">
                {{-- <button class="btn btn-primary float-left" type="button" onclick="navigaterTo('training')">Previous</button> --}}
                <button class="" type="button" id="nextExperience" style="float: right">Next</button>
            </div>
            @endif

        </div>
    </div>
</div>


<div id="experienceSetupModal" style="z-index: 9999999;" class="modal fade" role="dialog" tabindex="-1"
    aria-labelledby="experienceSetupModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dailog-centered mw-900px" role="document">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <button type="button" id="closedmodal" class="close  pull-right" value="experienceSetupModal"
                    data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body scroll-y px=10 px-lg-15 pt-0 pb-15" style="padding-bottom: 15px !important;"></div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="button" id="saveExperienceDetails" class="" style=" background-color: #3C2784;color: #fff;border: none;padding: 8px 30px;font-size: 18px;font-weight: 600;border-radius: 3px;
			float: right;">
                        <span class="indicator-label"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        var experienceDetailTable;
        $(document).ready(function() {
            experienceDetailTable = $('#experienceDetailTable').dataTable({
                "sPaginationType": "full_numbers",
                "bSearchable": false,
                "lengthMenu": [
                    [10, 30, 50, 70, 90, -1],
                    [10, 30, 50, 70, 90, "All"]
                ],
                'iDisplayLength': 10,
                "sDom": 'ltipr',
                "bAutoWidth": false,
                "aaSorting": [
                    [0, 'desc']
                ],
                // "bSort": false,
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": baseUrl + "/getexperiencedetails",
                "oLanguage": {
                    "sEmptyTable": "<p class='no_data_message'>No data available.</p>"
                },
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, ]
                }],
                "aoColumns": [{
                        "data": "sn"
                    },
                    {
                        "data": "officename"
                    },
                    {
                        "data": "officeaddress"
                    },
                    {
                        "data": "jobtype"
                    },
                    {
                        "data": "designation"
                    },
                    {
                        "data": "ranklabel"
                    },
                    {
                        "data": "workingstatuslabel"
                    }, {
                        "data": "workingstatus"
                    },
                    {
                        "data": "fromdatebs"
                    },
                    {
                        "data": "enddatebs"
                    },
                    {
                        "data": "document"
                    },
                    {
                        "data": "action"
                    },
                ],
            }).columnFilter({
                sPlaceHolder: "head:after",
                aoColumns: [{
                        type: "null"
                    },
                    {
                        type: "text"
                    },
                    {
                        type: "text"
                    },
                    {
                        type: "null"
                    },
                    {
                        type: "null"
                    },
                    {
                        type: "null"
                    },
                    {
                        type: "null"
                    },

                ]
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).off('click', '#addExperienceSetup');
            $(document).on('click', '#addExperienceSetup', function() {
                var url = baseUrl + '/experience/form';

                $.post(url, function(response) {
                    $('.indicator-label').html('Save');

                    $('#experienceSetupModal').modal('show');
                    $('#experienceSetupModal .modal-body').html(response);


                })
            });
        })



        $(document).ready(function() {
            $(document).off('click', '#nextExperience');
            $(document).on('click', '#nextExperience', function() {
                var redirectUrl = 'document';
                getProfileID();
		        gotToTab('#document');

            });
        })

        $(document).ready(function() {
            $(document).off('click', '#saveExperienceDetails');
            $(document).on('click', '#saveExperienceDetails', function() {
                $('#experienceDetailsForm').ajaxSubmit({
                    dataType: 'json',
                    success: function(response) {
                        if (response.type == 'success') {
                            $('#experienceSetupModal').modal('hide');
                            experienceDetailTable.fnDraw();
                            $.notify(response.message, 'success');
                        } else {
                            $.notify(response.message, 'error');



                        }
                    }
                });
            })
        });


        $(document).ready(function() {
            $(document).off('click', '.editExperienceDetail');
            $(document).on('click', '.editExperienceDetail', function() {

                var experiencedetailid = $(this).data('experiencedetail');
                var url = baseUrl + '/experience/form'
                var infoData = {
                    experiencedetailid: experiencedetailid
                }

                $.post(url, infoData, function(response) {
                    if (experiencedetailid) {
                        $('.indicator-label').html('Update');
                    }
                    $('#experienceSetupModal').modal('show');
                    $('#experienceSetupModal .modal-body').html(response);
                })

            });

        })

        $(document).off('click', '.deleteExperienceDetail');
        $(document).on('click', '.deleteExperienceDetail', function() {
            var experiencedetailid = $(this).data('experiencedetail');
            var url = baseUrl + '/experiencedetails/delete'
            var infoData = {
                experiencedetailid: experiencedetailid
            }
            swal({
                    title: "के तपाई यो रेकर्ड हटाउन चाहनुहुन्छ ? ",
                    text: "तपाइँ यो रेकर्ड पुन: प्राप्त गर्न सक्नुहुने छैन |",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "होइन",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "हो"
                },

                function() {

                    $.post(url, infoData, function(response) {
                        var result = JSON.parse(response);
                        if (result.type == 'success') {

                            experienceDetailTable.fnDraw();
                            $.notify(result.message, 'success');
                        } else {
                            alert(result.message);
                        }
                    });
                })

        });
    </script>
