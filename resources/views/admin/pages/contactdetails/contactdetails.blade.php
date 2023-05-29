<form id="saveContactDetailForm" method="post" class="form" enctype="multipart/form-data" action="{{ route('storeContactDetails') }}">
	<input type="hidden" value="{{ @$previousData->id }}" name="contactdetailid" />
	<div class="form_tab_bk"style="padding:45px !important; margin-top:20px !important;">
		<div class="row g2 mb-4">
			<span class="mx-0 px-0 span_custom" style="border-bottom: 1px solid #83cef72e; display: inline;">स्थायी
				ठेगाना
			</span>
		</div>
		<div class="row g2 mb-4">
			<!--begin::Col-->
			<div class="col-md-4  fv-row">
				<label for="provinceid" class="required fs-6 fw-bold mb-2">प्रदेश </label>
				<select class="" id="provinceid" name="provinceid"
				style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important;    height: 45px;
    color: #5e6278;">
					<option value="">प्रदेश छान्नुहोस्</option>
					@foreach ($provinces as $province)
					<option value="{{ @$province->id }}"
						{{ $province->id==@$previousData->provinceid ? "selected" : " "}}>
						{{ @$province->provincename }}</option>
					@endforeach
				</select>
			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-4  fv-row">
				<label for="districtid" class="required fs-6 fw-bold mb-2">स्थायी जिल्ला </label>
				<select class="districtid" id="districtid" name="districtid"
				style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important;     height: 45px;
    color: #5e6278;" data-districtid="{{@$previousData->districtid}}">
					<option value="" selected>जिल्ला छान्नुहोस्</option>
					@if(@$previousData->districtid)
					@foreach ($districts as $district)
					<option value="{{ @$district->id }}"
						{{ $district->id==@$previousData->districtid ? "selected" : " "}}>
						{{ @$district->districtname }}</option>
					@endforeach
					@endif
				</select>
			</div>
			<!--end::Col-->
			<div class="col-md-4  fv-row">
				<label for="municipalityid" class="required fs-6 fw-bold mb-2"> नगरपालिका </label>
				<select class="municipalityid" id="municipalityid"
					name="municipalityid" style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important;    height: 45px;
    color: #5e6278;"
					data-municipalityid="{{@$previousData->municipalityid}}">
					<option value="" selected>पालिकाको नाम छान्नुहोस्</option>
					@if(@$previousData->municipalityid)
					@foreach ($vdcormunicipalities as $vdc)
					<option value="{{ @$vdc->id }}"
						{{ $vdc->id==@$previousData->municipalityid ? "selected" : " "}}>
						{{ @$vdc->vdcormunicipalitiename }}</option>
					@endforeach
					@endif
				</select>
			</div>
		</div>
		<div class="row g2 mb-4">
			<!--end::Col-->
			<div class="col-md-3  fv-row">
				<label for="ward" class="required fs-6 fw-bold mb-2">वार्ड नं </label>
				<input type="number" class="required form-control form_input form-control-solid"
					placeholder=" वार्ड नं   राख्नुहोस" id="ward" name="ward"
					value="{{ @$previousData->ward }}" />

			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-3  fv-row">
				<label for="tole" class="required fs-6 fw-bold mb-2">टोल </label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder=" टोल  राख्नुहोस" id="tole" name="tole"
					value="{{ @$previousData->tole }}" />
			</div>
			<div class="col-md-3  fv-row">
				<label for="marga" class=" fs-6 fw-bold mb-2">मार्ग </label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder=" मार्ग  राख्नुहोस" id="marga" name="marga"
					value="{{ @$previousData->marga }}" />
			</div>

			<!--end::Col-->
			<div class="col-md-3  fv-row">
				<label for="housenumber" class=" fs-6 fw-bold mb-2">
					घर नम्बर </label>
				<input type="text" class="form-control form_input form-control-solid" placeholder="
			घर नम्बर" id="housenumber" name="housenumber" value="{{ @$previousData->housenumber }}" />
			</div>
			<!--end::Col-->
		</div>

		<div class="row g2 mb-4">
			<span class="mx-0 px-0 mt-10 span_custom" style="border-bottom: 1px solid 83cef72e; display: inline;">अस्थायी
				ठेगाना
			</span>
		</div>

		<div class="row g2 mb-4">
			<!--begin::Col-->
			<div class="col-md-4  fv-row">
				<label for="tempoprovinceid" class="required fs-6 fw-bold mb-2">प्रदेश </label>
				<select class="tempoprovinceid" id="tempoprovinceid" name="tempoprovinceid"
				style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important;     height: 45px;
    color: #5e6278;">
					<option value="">प्रदेश छान्नुहोस्</option>
					@foreach ($provinces as $province)
					<option value="{{ @$province->id }}"
						{{ $province->id==@$previousData->tempoprovinceid ? "selected" : " "}}>
						{{ @$province->provincename }}</option>
					@endforeach
				</select>

			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-4  fv-row">
				<label for="tempodistrictid" class=" required fs-6 fw-bold mb-2">अस्थायी जिल्ला </label>
				<select class="tempodistrictid" id="tempodistrictid"
					name="tempodistrictid" style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important;    height: 45px;
    color: #5e6278;"
					data-tempodistrictid="{{@$previousData->tempodistrictid}}">
					<option value="" selected>जिल्ला छान्नुहोस्</option>
					@if(@$previousData->tempodistrictid)
					@foreach ($districts as $district)
					<option value="{{ @$district->id }}"
						{{ $district->id==@$previousData->tempodistrictid ? "selected" : " "}}>
						{{ @$district->districtname }}</option>
					@endforeach
					@endif
				</select>
			</div>
			<!--end::Col-->
			<div class="col-md-4  fv-row">
				<label for="tempomunicipalityid" class="required fs-6 fw-bold mb-2"> अस्थायी नगरपालिका </label>
				<select class="tempomunicipalityid"
					id="tempomunicipalityid" name="tempomunicipalityid" style="padding: 4px;border-radius: 3px;height: 45px;font-size: 16px;width: 100%;border: 1px solid #ddd;background: #fff !important;    height: 45px;
   					color: #5e6278;height: 45px;"
					data-municipalityid="{{@$previousData->tempomunicipalityid}}">
					<option value="" selected>पालिकाको नाम छान्नुहोस्</option>
					@if(@$previousData->tempomunicipalityid)
					@foreach ($vdcormunicipalities as $vdc)
					<option value="{{ @$vdc->id }}"
						{{ $vdc->id==@$previousData->tempomunicipalityid ? "selected" : " "}}>
						{{ @$vdc->vdcormunicipalitiename }}</option>
					@endforeach
					@endif
				</select>

			</div>



		</div>
		<div class="row g2 mb-4">

			<!--end::Col-->
			<div class="col-md-3  fv-row">

				<label for="tempoward" class=" fs-6 fw-bold mb-2">वार्ड नं </label>
				<input type="number" class="form-control form_input form-control-solid"
					placeholder=" वार्ड नं   राख्नुहोस" id="tempoward" name="tempoward"
					value="{{ @$previousData->tempoward }}" />

			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-3  fv-row">
				<label for="tempotole" class=" fs-6 fw-bold mb-2">टोल </label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder=" टोल  राख्नुहोस" id="tempotole" name="tempotole"
					value="{{ @$previousData->tempotole }}" />
			</div>
			<div class="col-md-3  fv-row">
				<label for="tempomarga" class=" fs-6 fw-bold mb-2">मार्ग </label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder=" मार्ग  राख्नुहोस" id="tempomarga" name="tempomarga"
					value="{{ @$previousData->tempomarga }}" />
			</div>

			<!--end::Col-->
			<div class="col-md-3  fv-row">

				<label for="tempohousenumber" class=" fs-6 fw-bold mb-2">
					घर नम्बर </label>
				<input type="text" class="form-control form_input form-control-solid" placeholder="घर नम्बर" id="tempohousenumber" name="tempohousenumber"
					value="{{ @$previousData->tempohousenumber }}" />

			</div>
			<!--end::Col-->
		</div>
		<div class="row g2 mb-4">


			<!--begin::Col-->
			<div class="col-md-4  fv-row">
				<label for="tempophonenumber" class=" fs-6 fw-bold mb-2">फोन नम्बर </label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder=" फोन नम्बर" id="tempophonenumber" name="tempophonenumber"
					value="{{ @$previousData->tempophonenumber }}" />
			</div>
			<div class="col-md-4  fv-row">
				<label for="mobilenumber" class=" fs-6 fw-bold mb-2">मोबाइल नम्बर </label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder=" मोबाइल नम्बर  राख्नुहोस" id="mobilenumber" name="mobilenumber"
					value="{{ @$previousData->mobilenumber }}" />
			</div>
			<!--end::Col-->
			<div class="col-md-4  fv-row">

				<label for="email" class=" fs-6 fw-bold mb-2">Email</label>
				<input type="text" class="form-control form_input form-control-solid" placeholder="Email"
					id="email" name="email" value="{{ @$previousData->email }}" readonly />

			</div>
			<!--end::Col-->
		</div>
		<div class="row g2 mb-4">


			<div class="col-md-6  fv-row">

				<label for="maillingaddress" class=" fs-6 fw-bold mb-2">पत्राचार ठेगाना</label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder="पत्राचार ठेगाना" id="maillingaddress" name="maillingaddress"
					value="{{ @$previousData->maillingaddress }}" />

			</div>

		</div>
		<div class="row">

		</div>
		@if ((auth()->user()->is_submitted == 0) || (auth()->user()->is_submitted == 1 and auth()->user()->contact_enabled == 1))
            <div class="btn_flx" style="justify-content: end;">
				{{-- <button class="prev_btn" type="button" onclick="gotToTab('#personal')" style="margin-top: 0px; padding: 8px 30px;">Previous</button> --}}
				<button class=" mr-12" type="button" id="saveContactDetail" style="float: right">Next</button>
			</div>
		@endif
	</div>
</form>


<script>
	// save contact details
	$('#saveContactDetail').off('click');
	$('#saveContactDetail').on('click', function() {
		var mobileNumber = $('#mobilenumber').val();
		// if (!nepaleseMobileNumberRegex.test(mobileNumber)) {
		// 	$.notify('कृपया वैध मोबाईल नं. राख्नुहोस् ।  ', 'error');
		// 	return false; // Prevent the form from submitting
		// }
		$('#saveContactDetailForm').ajaxSubmit({
			dataType: 'json',
			success: function(response) {
				responseData = response[0];
				if (responseData.success) {
					getProfileID();
					gotToTab('#education');
					$.notify(responseData.message, 'success');
				} else {
					$.notify(responseData.message, 'error');
				}
				$('#provinceid').trigger('click');
				$('#districtid').trigger('click');
				$('#tempoprovinceid').trigger('click');
				$('#tempodistrictid').trigger('click');
			}
		});
	});


	// get provinces
	$('#provinceid').off('change');
	$('#provinceid').on('change', function() {

		var provinceid = $(this).find('option:selected').val();
		var districtid = $('#districtid').data('districtid');
		var url = baseUrl + '/provincewisedistrict';
		var infoData = {
			'provinceid': provinceid,
			'districtid': districtid
		};
		$.post(url, infoData, function(response) {
			console.log(response);
			$('.districtid').html(response);
		});
	});


	// get districts
	$('#districtid').off('change');
	$('#districtid').on('change', function() {

		var districtid = $(this).find('option:selected').val();
		var municipalityid = $('#municipalityid').data('municipalityid');
		var did = $('#districtid').data('districtid');
		var url = baseUrl + '/districtwisevdcormunicipality';
		var infoData = {
			'districtid': districtid,
			'municipalityid': municipalityid,
			'did': did
		};
		$.post(url, infoData, function(response) {
			$('.municipalityid').html(response);

		});
	});


	// get temporaray provinces 
	$('#tempoprovinceid').off('change');
	$('#tempoprovinceid').on('change', function() {

		var provinceid = $(this).find('option:selected').val();
		var districtid = $('#tempodistrictid').data('districtid');
		var url = baseUrl + '/provincewisedistrict';
		var infoData = {
			'provinceid': provinceid,
			'districtid': districtid
		};
		$.post(url, infoData, function(response) {
			$('.tempodistrictid').html(response);
		});
	});


	// get temporary districts
	$('#tempodistrictid').off('change');
	$('#tempodistrictid').on('change', function() {

		var districtid = $(this).find('option:selected').val();
		var municipalityid = $('#tempomunicipalityid').data('municipalityid');
		var did = $('#tempodistrictid').data('tempodistrictid');
		var url = baseUrl + '/districtwisevdcormunicipality';
		var infoData = {
			'districtid': districtid,
			'municipalityid': municipalityid,
			'did': did
		};
		$.post(url, infoData, function(response) {
			$('.tempomunicipalityid').html(response);
		});
	});
</script>