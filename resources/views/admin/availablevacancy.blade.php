@extends('admin.layouts.admin_designs')

@section('siteTitle')विज्ञापन@endsection
<link href="{{asset('adminAssets/assets/css/common/applicantprofile.css')}}" rel="stylesheet" type="text/css" />


@section('content')
      <div class="card" style="margin-top:5px;">
            <!--begin::Card body-->
            <div class="card-body py-4">
                  <h4 style="color:#3C2784; font-weight:600"><u>हाल विज्ञापन भएका पदहरुको सूची</u></h4>
                  <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-responsive">
                              <table class="table-bordered table-striped table-condensed cf" id="vacancyListTable"
                                    width="100%">
                                    <thead class="cf">
                                          <tr>
                                                <th>क्रम संख्या </th>
                                                <th>विज्ञापन नं.</th>
                                                <th>तह</th>
                                                <th>पद </th> 
                                                <th>योग्यता</th>
                                                <th>सेवा/समूह</th>
                                                <th>खुला र समावेशी</th>
                                                <th>आ.प्र</th>
                                                <th>पद संख्या</th>
                                                <th>प्रकाशित मिति </th>
                                                <th>अन्तिम मिति  </th>
                                                <th>दोब्बर दस्तुर मिति  </th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                         
                                    </tbody>
                              </table>
                        </div>
                  </div>
            </div>
            <!--end::Card body-->				
      </div>
@endsection

@section('scripts')
<script>
      var vacancyListTable;
      $(document).ready(function() {
            vacancyListTable = $('#vacancyListTable').dataTable({
                  "sPaginationType": "full_numbers",
                  "bSearchable": false,
                  "lengthMenu": [
                        [5,10, 30, 50, 70, 90, -1],
                        [5,10, 30, 50, 70, 90, "All"]
                  ],
                  'iDisplayLength': 5,
                  "sDom": 'ltipr',
                  "bAutoWidth": false,
                  "aaSorting": [
                        [0, 'desc']
                  ],
                  // "bSort": false,
                  "bProcessing": true,
                  "bServerSide": true,
                  "sAjaxSource": baseUrl + "/availablevacancylist",
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
                              "data": "vacancynumber"
                        },
                        {
                              "data": "labelname"
                        },
                        {
                              "data": "designation"
                        },
                        {
                              "data": "academic"
                        },
                        {
                              "data": "servicegroupname"
                        },
                        {
                              "data": "jobcategoryname"
                        },
                        {
                              "data": "isinternalvacancy"
                        },
                        {
                              "data": "numberofvacancy"
                        },
                        {
                              "data": "vacancypublishdate"
                        },
                        {
                              "data": "vacancyenddate"
                        },
                        {
                              "data": "extendeddate"
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
                              type: "text"
                        },
                        {
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
@endsection
            