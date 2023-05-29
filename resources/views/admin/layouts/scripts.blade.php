
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('adminAssets/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->

<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Page Vendors Javascript-->

<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('adminAssets/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/custom/apps/chat/chat.js') }}"></script>

<script src="{{ asset('adminAssets/assets/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/custom/apps/projects/settings/settings.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/custom/authentication/sign-in/general.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js"
    integrity="sha512-5qbIAL4qJ/FSsWfIq5Pd0qbqoZpk5NcUVeAAREV2Li4EKzyJDEGlADHhHOSSCw0tHP7z3Q4hNHJXa81P92borQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script src="{{ asset('adminAssets/assets/js/jquery/jquery.validate.min.js') }}"></script>

<script src="{{ asset('adminAssets/assets/js/jquery/notify.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/jquery/notify.min.js') }}"></script>

{{-- datatables --}}
<script src="{{ asset('adminAssets/assets/js/jquery/jquery.dataTables.columnFilter.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/jquery/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('adminAssets/assets/js/jquery/sweetalert.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/jquery/jquery.sweet-alert.custom.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/jquery.timepicker.min.js') }}"></script>

<script src="{{ asset('adminAssets/assets/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/select2.js') }}"></script>
<script src="{{ asset('adminAssets/assets/css/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/css/bootstrap/js/bootstrap.js') }}"></script>

<script src="{{ asset('adminAssets/assets/css/bootstrap/js/bootstrap.bundle.js') }}"></script>

<script src="{{ asset('adminAssets/assets/js/nepali.datepicker.v2.2.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/cropper.min.js') }}"></script>



<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

<script type="text/javascript">
    var nepaleseMobileNumberRegex = /^(98|97)\d{7}$/;
    var hostUrl = "assets/";
    var baseUrl = "<?= url('/') ?>";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).off('click', '#closedmodal');
    $(document).on('click', '#closedmodal', function() {
        var Mid = $('#closedmodal').val();
        $(`#${Mid}`).modal('hide');
    });


    $(".toolbar a").click(function(event) {
        event.preventDefault();
    });


    $('.alert').delay(3000).fadeOut();
    

</script>


<script type="text/javascript">
    // function advertPop(designationid, servicesgroupid) {
    //     $("#vacancydetails").html()
    //     var data = {
    //         designationid: designationid,
    //         servicesgroupid: servicesgroupid,
    //     };
    //     var url = "{{ route('getjobdetails') }}";
    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         data: data,
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(response) {
    //             $("#vacancydetails").html(response);
    //             $('#vacancydetailModal').modal('show');
    //         }
    //     });
    // }

</script>

@yield('scripts')
