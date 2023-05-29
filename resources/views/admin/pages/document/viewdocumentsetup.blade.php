<style>
    .bx_box {
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2);
    }

    .bx_box .sc_img img {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }

    ul {
        list-style: none;
        color: #3C2784;
        padding-inline: 20px;
    }
</style>
<div class="doc_form">
    {{-- {{dd($previousData)}} --}}

    <div class="container-xxl p-0">
        <div class="row_form" id="kt_post">
            <form id="documentSetupForm" method="post" class="form" enctype="multipart/form-data" action="{{ route('documentStore') }}">
                <input type="hidden" value="{{ @$previousData->userid }}" name="userid" />
                <input type="hidden" value="{{ @$previousData->id }}" name="documentdetailid" />


                <div class="row row-wrapper mb-3">
                    <div class="col-md-6 p-3 ">
                        <div class="rows">
                            <div class="inside_wrapper d-flex justify-content-between" style="box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.25);padding: 10px;border-radius: 5px;">
                                <div class="cols">
                                    <input type="hidden" value="{{@$document->photography}}" name="back_photographys" />
                                    <label for="photographys" class=" fs-6 fw-bold mb-2">आफ्नो हालसालै खिचिएको फोटो अपलोड गर्नुहोस्</label>
                                    <span><p style="color: red">Photo must be smaller than 1Mb in image format JPEG/JPG
                                            <a href="javascript:;" class="imageInfoBtn" data-image_type="photograph"><i class="fa-solid fa-lightbulb" style="color: yellowgreen;font-size:18px;"></i></a>
                                        </p>
                                        <span>
                                            <input type='file' onchange="readURL(this,1);" name="photographys" />


                                </div>
                                <div class="cols">
                                    @if(!empty($document->photography))
                                    <img id="preview1" src="{{ asset('uploads/document/photography').'/'.@$document->photography }}" alt="Scanned Photograph" style="max-width: 100px;height: 100px;object-fit: cover;" />
                                    @else
                                    <img id="preview1" src="{{ asset('adminAssets/assets/images/no_image.png') }}" alt="Scanned Photograph" style="max-width: 100px;height: 100px;object-fit: cover;" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- {{dd($document)}} --}}
                    <div class="col-md-6 p-3 ">
                        <div class="rows">
                            <div class="inside_wrapper d-flex justify-content-between" style="box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.25);padding: 10px;border-radius: 5px;">
                                <div class="cols">
                                    <label for="signatures" class=" fs-6 fw-bold mb-2">Upload your Scanned Signature </label>
                                    <span>Signature अपलोड गर्नुहोस्
                                        <p style="color: red">Photo must be smaller than 1Mb in image format JPEG/JPG
                                            <a href="javascript:;" class="imageInfoBtn" data-image_type="signature"><i class="fa-solid fa-lightbulb" style="color: yellowgreen;font-size:18px;"></i></a>
                                        </p></i></a>
                                        </p><span>
                                            <input type='file' onchange="readURL(this,9);" name="signatures" />
                                            <input type="hidden" value="{{@$document->signature}}" name="back_signatures" />

                                </div>
                                <div class="cols">
                                    @if(!empty($document->signature))
                                    <img id="preview9" src="{{ asset('uploads/document/signature').'/'.@$document->signature }}" alt="Scanned Signature" style="max-width: 100px;height: 100px;object-fit: cover;" />
                                    @else
                                    <img id="preview9" src="{{ asset('adminAssets/assets/images/no_image.png') }}" alt="Scanned Signature" style="max-width: 100px;height: 100px;object-fit: cover;" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-wrapper mb-3">
                    <div class="col-md-6 p-3 ">
                        <div class="rows">
                            <div class="inside_wrapper d-flex justify-content-between" style="box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.25);padding: 10px;border-radius: 5px;">
                                <div class="cols">
                                    <label for="citizenshipfronts" class=" fs-6 fw-bold mb-2">Upload your Scanned Citizenship
                                        Front</label>
                                    <span>आफ्नो नागरिकता(Front) अपलोड गर्नुहोस्
                                        <p style="color: red">Photo must be smaller than 1Mb in image format JPEG/JPG
                                            <a href="javascript:;" class="imageInfoBtn" data-image_type="citizenship_front"><i class="fa-solid fa-lightbulb" style="color: yellowgreen;font-size:18px;"></i></a>
                                        </p></i></a>
                                        </p><span>
                                            <input type='file' onchange="readURL(this,2);" name="citizenshipfronts" />
                                            <input type="hidden" value="{{@$document->citizenshipfront}}" name="back_citizenshipfronts" />

                                </div>
                                <div class="cols">
                                    @if(!empty($document->citizenshipfront))
                                    <img id="preview2" src="{{ asset('uploads/document/citizenshipfront').'/'.@$document->citizenshipfront }}" alt="Citizeship Front" style="max-width: 100px;height: 100px;object-fit: cover;" />
                                    @else
                                    <img id="preview2" src="{{ asset('adminAssets/assets/images/no_image.png') }}" alt="Citizeship Front" style="    max-width: 100px;height: 100px;object-fit: cover;" />
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 p-3 ">
                        <div class="rows">
                            <div class="inside_wrapper d-flex justify-content-between" style="box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.25);padding: 10px;border-radius: 5px;">
                                <div class="cols">
                                    <label for="citizenshipbacks" class=" fs-6 fw-bold mb-2">Upload your Scanned Citizenship
                                        Back</label>
                                    <span>आफ्नो नागरिकता(Back) अपलोड गर्नुहोस्
                                        <p style="color: red">Photo must be smaller than 1Mb in image format JPEG/JPG
                                            <a href="javascript:;" class="imageInfoBtn" data-image_type="citizenship_back"><i class="fa-solid fa-lightbulb" style="color: yellowgreen;font-size:18px;"></i></a>
                                        </p></i></a>
                                        </p><span>
                                            <input type='file' onchange="readURL(this,3);" name="citizenshipbacks" />
                                            <input type="hidden" value="{{@$document->citizenshipback}}" name="back_citizenshipbacks" />

                                </div>
                                <div class="cols">
                                    @if(!empty($document->citizenshipback))
                                    <img id="preview3" src="{{ asset('uploads/document/citizenshipback').'/'.@$document->citizenshipback }}" alt="Citizeship Back" style="    max-width: 100px;height: 100px;object-fit: cover;" />
                                    @else
                                    <img id="preview3" src="{{ asset('adminAssets/assets/images/no_image.png') }}" alt="Citizeship Back" style="    max-width: 100px;height: 100px;object-fit: cover;" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-wrapper mb-3 ">
                    <div class="col-md-6 p-3 ">
                        <div class="rows">
                            <div class="inside_wrapper d-flex justify-content-between" style="box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.25);padding: 10px;border-radius: 5px;">
                                <div class="cols">
                                    <label for="inclusiongroupcertificateadibashi" class=" fs-6 fw-bold mb-2">Upload your Scanned
                                        Inclusion Group </label>
                                    <span>अदिवासिको क्षेत्र समूह प्रमाणपत्र अपलोड गर्नुहोस्<p style="color: red">
                                            Photo
                                            must be smaller than 1Mb in image format JPEG/JPG</p><span>
                                            <input type='file' onchange="readURL(this,4);" name="inclusiongroupcertificateadibashi" />
                                            <input type="hidden" value="{{@$document->inclusiongroupcertificateadibashi}}" name="back_inclusiongroupcertificateadibashi" />

                                </div>
                                <div class="cols">
                                    @if(!empty($document->inclusiongroupcertificateadibashi))
                                    <img id="preview4" src="{{ asset('uploads/document/inclusiongroupcertificate').'/'.@$document->inclusiongroupcertificateadibashi }}" alt="Inclusion Group" style="max-width: 100px;height: 100px;object-fit: cover;" />
                                    @else
                                    <img id="preview4" src="{{ asset('adminAssets/assets/images/no_image.png') }}" alt="Inclusion Group" style="max-width: 100px;height: 100px;object-fit: cover;" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-3 ">
                        <div class="rows">
                            <div class="inside_wrapper d-flex justify-content-between" style="box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.25);padding: 10px;border-radius: 5px;">
                                <div class="cols">
                                    <label for="inclusiongroupcertificatejanajati" class=" fs-6 fw-bold mb-2">Upload your Scanned
                                        Inclusion Group </label>
                                    <span>जनजातिको क्षेत्र समूह प्रमाणपत्र अपलोड गर्नुहोस्<p style="color: red">
                                            Photo
                                            must be smaller than 1Mb in image format JPEG/JPG</p><span>
                                            <input type='file' onchange="readURL(this,5);" name="inclusiongroupcertificatejanajati" />
                                            <input type="hidden" value="{{@$document->inclusiongroupcertificatejanajati}}" name="back_inclusiongroupcertificatejanajati" />

                                </div>
                                <div class="cols">
                                    @if(!empty($document->inclusiongroupcertificatejanajati))
                                    <img id="preview5" src="{{ asset('uploads/document/inclusiongroupcertificate').'/'.@$document->inclusiongroupcertificatejanajati }}" alt="Inclusion Group" style="max-width: 100px;height: 100px;object-fit: cover;" />
                                    @else
                                    <img id="preview5" src="{{ asset('adminAssets/assets/images/no_image.png') }}" alt="Inclusion Group" style="max-width: 100px;height: 100px;object-fit: cover;" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-wrapper mb-3">
                    <div class="col-md-6 p-3 ">
                        <div class="rows">
                        <div class="inside_wrapper d-flex justify-content-between" style="box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.25);padding: 10px;border-radius: 5px;">
                            <div class="cols">
                                <label for="inclusiongroupcertificatepixadiyeko" class=" fs-6 fw-bold mb-2">Upload your Scanned
                                    Inclusion Group </label>
                                <span>पिछडियेको क्षेत्र समूह प्रमाणपत्र अपलोड गर्नुहोस्<p style="color: red">
                                        Photo
                                        must be smaller than 1Mb in image format JPEG/JPG</p><span>
                                        <input type='file' onchange="readURL(this,7);" name="inclusiongroupcertificatepixadiyeko" />
                                        <input type="hidden" value="{{@$document->inclusiongroupcertificatepixadiyeko}}" name="back_inclusiongroupcertificatepixadiyeko" />
                            </div>
                            <div class="cols">
                                @if(!empty($document->inclusiongroupcertificatepixadiyeko))
                                <img id="preview7" src="{{ asset('uploads/document/inclusiongroupcertificate').'/'.@$document->inclusiongroupcertificatepixadiyeko }}" alt="Inclusion Group" style="max-width: 100px;height: 100px;object-fit: cover;" />
                                @else
                                <img id="preview7" src="{{ asset('adminAssets/assets/images/no_image.png') }}" alt="Inclusion Group" style="max-width: 100px;height: 100px;object-fit: cover;" />
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-3 ">
                        <div class="rows">
                        <div class="inside_wrapper d-flex justify-content-between" style="box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.25);padding: 10px;border-radius: 5px;">
                            <div class="cols">
                                <label for="inclusiongroupcertificatedalit" class=" fs-6 fw-bold mb-2">Upload your Scanned Inclusion
                                    Group </label>
                                <span>दलितको क्षेत्र समूह प्रमाणपत्र अपलोड गर्नुहोस्<p style="color: red">
                                        Photo
                                        must be smaller than 1Mb in image format JPEG/JPG</p><span>
                                        <input type='file' onchange="readURL(this,6);" name="inclusiongroupcertificatedalit" />
                                        <input type="hidden" value="{{@$document->inclusiongroupcertificatedalit}}" name="back_inclusiongroupcertificatedalit" />

                            </div>
                            <div class="cols -md-2">
                                @if(!empty($document->inclusiongroupcertificatedalit))
                                <img id="preview6" src="{{ asset('uploads/document/inclusiongroupcertificate').'/'.@$document->inclusiongroupcertificatedalit }}" alt="Inclusion Group" style="    max-width: 100px;height: 100px;object-fit: cover;" />
                                @else
                                <img id="preview6" src="{{ asset('adminAssets/assets/images/no_image.png') }}" alt="Inclusion Group" style="    max-width: 100px;height: 100px;object-fit: cover;" />
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="row row-wrapper mb-3">
                    <div class="col-md-6 p-3 ">
                        <div class="rows">
                            <div class="inside_wrapper d-flex justify-content-between" style="box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.25);padding: 10px;border-radius: 5px;">
                                <div class="cols">
                                    <label for="inclusiongroupcertificatemadesi" class=" fs-6 fw-bold mb-2">Upload your Scanned
                                        Inclusion Group </label>
                                    <span>मधेसी समूह प्रमाणपत्र अपलोड गर्नुहोस्<p style="color: red">
                                            Photo
                                            must be smaller than 1Mb in image format JPEG/JPG</p><span>
                                            <input type='file' onchange="readURL(this,8);" name="inclusiongroupcertificatemadesi" />
                                            <input type="hidden" value="{{@$document->inclusiongroupcertificatemadesi}}" name="back_inclusiongroupcertificatemadesi" />

                                </div>
                                <div class="cols">
                                    @if(!empty($document->inclusiongroupcertificatemadesi))
                                    <img id="preview8" src="{{ asset('uploads/document/inclusiongroupcertificate').'/'.@$document->inclusiongroupcertificatemadesi }}" alt="Inclusion Group" style="    max-width: 100px;height: 100px;object-fit: cover;" />
                                    @else
                                    <img id="preview8" src="{{ asset('adminAssets/assets/images/no_image.png') }}" alt="Inclusion Group" style="    max-width: 100px;height: 100px;object-fit: cover;" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-3 ">
                        <div class="rows">
                            <div class="inside_wrapper d-flex justify-content-between" style="box-shadow: 0px 0px 12px -2px rgba(0,0,0,0.25);padding: 10px;border-radius: 5px;">
                                <div class="cols">
                                    <label for="inclusiongroupcertificateapanga" class=" fs-6 fw-bold mb-2">Upload your Scanned
                                        Inclusion Group </label>
                                    <span>अपाङ्ग समूह प्रमाणपत्र अपलोड गर्नुहोस्<p style="color: red">
                                            Photo
                                            must be smaller than 1Mb in image format JPEG/JPG</p><span>
                                            <input type='file' onchange="readURL(this,10);" name="inclusiongroupcertificateapanga" />
                                            <input type="hidden" value="{{@$document->disabilitydocument}}" name="back_inclusiongroupcertificateapanga" />

                                </div>
                                <div class="cols">
                                    @if(!empty($document->disabilitydocument))
                                    <img id="preview10" src="{{ asset('uploads/document/inclusiongroupcertificate').'/'.@$document->disabilitydocument }}" alt="Inclusion Group" style="    max-width: 100px;height: 100px;object-fit: cover;" />
                                    @else
                                    <img id="preview10" src="{{ asset('adminAssets/assets/images/no_image.png') }}" alt="Inclusion Group" style="    max-width: 100px;height: 100px;object-fit: cover;" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="rows">
            @if ((auth()->user()->is_submitted == 0) || (auth()->user()->is_submitted == 1 and auth()->user()->document_enabled == 1))
            <div class="col-md-12  ">
                <div class="btn_flx" style="margin: 20px -15px;">
                    {{-- <button class="btn btn-primary" type="button" onclick="navigaterTo('experience')">Previous</button> --}}
                    <button class="btn btn-primary" type="button" id="documentSave" style="float: right">Next</button>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="imageInfoModal" tabindex="-1" role="dialog" aria-labelledby="imageInfoModalLabel" aria-hidden="true" style="z-index: 99999;">
    <div class="modal-dialog" role="document" style="margin:200px auto;">
        <div class="modal-content">
            <div class="modal-header" style="background: #3C2784;border:none">
                <h5 class="modal-title" id="imageInfoModalLabel" style="color:#fff">Modal title</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color:#fff">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
        </div>
    </div>
</div>
<script>
    // $(document).off('click', '#imageInfoBtn');
    $('.imageInfoBtn').on('click', function(e) {
        e.preventDefault();
        var image_type = $(this).data('image_type');
        var url = baseUrl + '/document/imageinfo';
        var infoData = {
            'image_type': image_type
        };
        $.post(url, infoData, function(response) {
            $('#imageInfoModal .modal-body').html(response);
            $('#imageInfoModal .modal-title').html('अपलोड गर्दा ध्यान दिनुपर्ने कुराहरु ।');
            $('#imageInfoModal').modal('show');
        });
    });


    $(document).off('click', '#documentSave');
    $(document).on('click', '#documentSave', function() {
        $('#documentSetupForm').ajaxSubmit({
            dataType: 'json',
            success: function(response) {
                if (response.type == 'success') {
                    getProfileID();
                    gotToTab('#preview');
                    $.notify(response.message, 'success');
                } else {
                    $.notify(response.message, 'error');
                }
            }
        });
    });

    function readURL(input, i) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview' + i)
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        $(document).off('click', '#province');
        $(document).on('click', '#province', function() {

            var provinceid = $(this).find('option:selected').val();
            var districtid = $('#districtid').data('districtid');

            var url = baseUrl + '/provincewisedistrict';
            var infoData = {
                'provinceid': provinceid,
                'districtid': districtid,

            };

            $.post(url, infoData, function(response) {
                $('.districtdata').html(response);
            })
        });


        $(document).off('click', '#districtid');
        $(document).on('click', '#districtid', function() {

            var districtid = $(this).find('option:selected').val();
            var municipalityid = $('#vdcormunicipality').data('municipalityid');
            var did = $('#districtid').data('districtid');


            var url = baseUrl + '/districtwisevdcormunicipality';
            var infoData = {
                'districtid': districtid,
                'municipalityid': municipalityid,
                'did': did
            };

            $.post(url, infoData, function(response) {
                $('.vdcormunicipalitydata').html(response);

            })
        });
    });
</script>