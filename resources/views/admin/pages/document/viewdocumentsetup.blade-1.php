<head>
    <style>
        .bx_box{
            box-shadow: 0px 0px 4px rgba(0,0,0,0.2);
        }
        .bx_box .sc_img img{
width: 100px;
height: 100px;
object-fit: contain;
        }
    </style>
</head>
<div class="doc_form">
<div class="container-xxl p-0">
    <div class="row">
        <form id="documentSetupForm" method="post" class="form" enctype="multipart/form-data"
            action="{{ route('documentStore') }}">
            <input type="hidden" value="{{ @$previousData->userid }}" name="userid" />
            <input type="hidden" value="{{ @$previousData->id }}" name="documentdetailid" />
            <!--begin::Heading-->
            <div class="txt_center">
				<div class="mb-13 text-center head_text">
					<!--begin::Title-->
					<div class="head_side_design">
						<h1>कागजात फारम</h1>
					</div>

					<!--end::Title-->
				</div>
			</div>
            <!--end::Heading-->
            <div class="wrapper">
                <div class="row g2 mb-6 bx_box">
                <div class="col-md-10 fv-row py-2">
                    <input type="hidden" value="{{@$document->photography}}" name="back_photographys" />

                    <label for="photographys" class=" fs-6 fw-bold mb-2">Upload your Scanned Photograph</label>
                    <span>आफ्नो हालसालै खिचियको फोटो अपलोड गर्नुहोस्<p style="color: red">Photo must be smaller than 1Mb
                            in
                            image format JPEG/JPG</p><span>
                            <input type='file' onchange="readURL(this,1);" name="photographys" />

                </div>
                <div class="col-md-2 sc_img fv-row py-2">
                    <img id="preview1" src="{{ asset('uploads/document/photography').'/'.@$document->photography }}" alt="Scanned Photograph"
                        style="max-width:180px;" />
                </div>

                </div>
                <div class="row g2 mb-6 bx_box">
                    <div class="col-md-10 fv-row py-2">
                    <label for="citizenshipfronts" class=" fs-6 fw-bold mb-2">Upload your Scanned Citizenship
                        Front</label>
                    <span>आफ्नो नागरिकता(Front) अपलोड गर्नुहोस्<p style="color: red">Photo must be smaller than 1Mb in
                            image
                            format JPEG/JPG</p><span>
                            <input type='file' onchange="readURL(this,2);" name="citizenshipfronts" />
                            <input type="hidden" value="{{@$document->citizenshipfront}}" name="back_citizenshipfronts" />

                    </div>
                    <div class="col-md-2 sc_img fv-row py-2">
                    <img id="preview2" src="{{ asset('uploads/document/citizenshipfront').'/'.@$document->citizenshipfront }}" alt="Citizeship Front" style="max-width:180px;" />
                    </div>
                </div>
            </div>
           
            <div class="row g2 mb-6 bx_box">
                <div class="col-md-10 fv-row py-2">
                    <label for="citizenshipbacks" class=" fs-6 fw-bold mb-2">Upload your Scanned Citizenship
                        Back</label>
                    <span>आफ्नो नागरिकता(Back) अपलोड गर्नुहोस्<p style="color: red">Photo must be smaller than 1Mb in
                            image
                            format JPEG/JPG</p><span>
                            <input type='file' onchange="readURL(this,3);" name="citizenshipbacks" />
                            <input type="hidden" value="{{@$document->citizenshipback}}" name="back_citizenshipbacks" />

                </div>
                <div class="col-md-2 sc_img fv-row py-2">
                    <img id="preview3" src="{{ asset('uploads/document/citizenshipback').'/'.@$document->citizenshipback }}" alt="Citizeship Back" style="max-width:180px;" />
                </div>

            </div>
            <div class="row g2 mb-6 bx_box">
                <div class="col-md-10 fv-row py-2">
                    <label for="inclusiongroupcertificateadibashi" class=" fs-6 fw-bold mb-2">Upload your Scanned
                        Inclusion Group </label>
                    <span>अदिवासिको क्षेत्र समूह प्रमाणपत्र अपलोड गर्नुहोस्<p style="color: red">
                            Photo
                            must be smaller than 1Mb in image format JPEG/JPG</p><span>
                            <input type='file' onchange="readURL(this,4);"
                                name="inclusiongroupcertificateadibashi" />
                            <input type="hidden" value="{{@$document->inclusiongroupcertificateadibashi}}" name="back_inclusiongroupcertificateadibashi" />

                </div>
                <div class="col-md-2 sc_img fv-row py-2">
                    <img id="preview4" src="{{ asset('uploads/document/inclusiongroupcertificate').'/'.@$document->inclusiongroupcertificateadibashi }}" alt="Inclusion Group" style="max-width:180px;" />
                </div>

            </div>
            <div class="row g2 mb-6 bx_box">
                <div class="col-md-10 fv-row py-2">
                    <label for="inclusiongroupcertificatejanajati" class=" fs-6 fw-bold mb-2">Upload your Scanned
                        Inclusion Group </label>
                    <span>जनजातिको क्षेत्र समूह प्रमाणपत्र अपलोड गर्नुहोस्<p style="color: red">
                            Photo
                            must be smaller than 1Mb in image format JPEG/JPG</p><span>
                            <input type='file' onchange="readURL(this,5);"
                                name="inclusiongroupcertificatejanajati" />
                            <input type="hidden" value="{{@$document->inclusiongroupcertificatejanajati}}" name="back_inclusiongroupcertificatejanajati" />

                </div>
                <div class="col-md-2 sc_img fv-row py-2">
                    <img id="preview5" src="{{ asset('uploads/document/inclusiongroupcertificate').'/'.@$document->inclusiongroupcertificatejanajati }}" alt="Inclusion Group" style="max-width:180px;" />
                </div>

            </div>
            <div class="row g2 mb-6 bx_box">
                <div class="col-md-10 fv-row py-2">
                    <label for="inclusiongroupcertificatedalit" class=" fs-6 fw-bold mb-2">Upload your Scanned Inclusion
                        Group </label>
                    <span>दलितको क्षेत्र समूह प्रमाणपत्र अपलोड गर्नुहोस्<p style="color: red">
                            Photo
                            must be smaller than 1Mb in image format JPEG/JPG</p><span>
                            <input type='file' onchange="readURL(this,6);" name="inclusiongroupcertificatedalit" />
                            <input type="hidden" value="{{@$document->inclusiongroupcertificatedalit}}" name="back_inclusiongroupcertificatedalit" />

                </div>
                <div class="col-md-2 sc_img fv-row py-2">
                    <img id="preview6" src="{{ asset('uploads/document/inclusiongroupcertificate').'/'.@$document->inclusiongroupcertificatedalit }}" alt="Inclusion Group" style="max-width:180px;" />
                </div>

            </div>
            <div class="row g2 mb-6 bx_box">
                <div class="col-md-10 fv-row py-2">
                    <label for="inclusiongroupcertificatepixadiyeko" class=" fs-6 fw-bold mb-2">Upload your Scanned
                        Inclusion Group </label>
                    <span>पिछडियेको क्षेत्र समूह प्रमाणपत्र अपलोड गर्नुहोस्<p style="color: red">
                            Photo
                            must be smaller than 1Mb in image format JPEG/JPG</p><span>
                            <input type='file' onchange="readURL(this,7);"
                                name="inclusiongroupcertificatepixadiyeko" />
                            <input type="hidden" value="{{@$document->inclusiongroupcertificatepixadiyeko}}" name="back_inclusiongroupcertificatepixadiyeko" />

                </div>
                <div class="col-md-2 sc_img fv-row py-2">
                    <img id="preview7" src="{{ asset('uploads/document/inclusiongroupcertificate').'/'.@$document->inclusiongroupcertificatepixadiyeko }}" alt="Inclusion Group" style="max-width:180px;" />
                </div>

            </div>
            <div class="row g2 mb-6 bx_box">
                <div class="col-md-10 fv-row py-2">
                    <label for="inclusiongroupcertificatemadesi" class=" fs-6 fw-bold mb-2">Upload your Scanned
                        Inclusion Group </label>
                    <span>मधेसी समूह प्रमाणपत्र अपलोड गर्नुहोस्<p style="color: red">
                            Photo
                            must be smaller than 1Mb in image format JPEG/JPG</p><span>
                            <input type='file' onchange="readURL(this,7);"
                                name="inclusiongroupcertificatemadesi" />
                            <input type="hidden" value="{{@$document->inclusiongroupcertificatemadesi}}" name="back_inclusiongroupcertificatemadesi" />

                </div>
                <div class="col-md-2 sc_img fv-row py-2">
                    <img id="preview7" src="{{ asset('uploads/document/inclusiongroupcertificate').'/'.@$document->inclusiongroupcertificatemadesi }}" alt="Inclusion Group" style="max-width:180px;" />
                </div>

            </div>
            <div class="row g2 mb-6 bx_box">
                <div class="col-md-10 fv-row py-2">
                    <label for="signatures" class=" fs-6 fw-bold mb-2">Upload your Scanned Signature </label>
                    <span>Signature अपलोड गर्नुहोस्<p style="color: red">Photo must be smaller than 1Mb in image format
                            JPEG/JPG</p><span>
                            <input type='file' onchange="readURL(this,8);" name="signatures" />
                            <input type="hidden" value="{{@$document->signature}}" name="back_signatures" />

                </div>
                <div class="col-md-2 sc_img fv-row py-2">
                    <img id="preview8" src="{{ asset('uploads/document/signature').'/'.@$document->signatures }}" alt="Scanned Signature"
                        style="max-width:180px;" />
                </div>

            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12  ">
            <div class="btn_flx" style="    margin: 20px -15px;">
            <button class="btn btn-primary" type="button"
                onclick="navigaterTo('experience')">Previous</button>
            <button class="btn btn-primary" type="button" id="documentSave">Next</button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
$(document).off('click', '#documentSave');
$(document).on('click', '#documentSave', function() {
	$('#documentSetupForm').ajaxSubmit({
		dataType: 'json',
		success: function(response) {
			if (response.type == 'success') {
				navigaterTo('preview');
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
</script>


<script>
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


})

$(document).ready(function() {
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


})
</script>
