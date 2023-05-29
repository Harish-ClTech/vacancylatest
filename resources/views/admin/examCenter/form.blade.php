<form id="examCenterForm" method="post" class="form" action="{{ @$saveurl }}">
	<input type="hidden" value="{{ @$previousData->id }}" name="examcenterid" />
	<!--begin::Heading-->
	<div class="mb-5">
		<!--begin::Title-->
		<h4 class="mb-3" style=" color: #3C2784;  font-weight: 600; margin-top: 5px;">परिक्षा केन्द्र सेटअप फारम</h4>
		<!--end::Title-->
	</div>
	<!--end::Heading-->
	<div class="custom_form">
		<div class="row g2 mb-2">
			<div class="col-md-5 fv-row">
				<label for="examcentername" class="required fs-6 fw-bold mb-2">परिक्षा केन्द्रको नाम</label>
				<input type="text" class="form-control form_input form-control-solid" placeholder="परिक्षा केन्द्रको नाम राख्नुहोस" id="examcentername" name="examcentername" value="{{ @$previousData->examcentername }}">
			</div>
			<div class="col-md-5 fv-row">
				<label for="address" class="required fs-6 fw-bold mb-2">परिक्षा केन्द्रको ठेगाना</label>
				<input type="text" class="form-control form_input form-control-solid" placeholder="परिक्षा केन्द्रको ठेगाना राख्नुहोस" id="address" name="address" value="{{ @$previousData->address }}">
			</div>
			<div class="col-md-2 fv-row">
				<label for="status" class="required fs-6 fw-bold mb-2">स्थिति</label>
				<select class="form-select form_input  select2 form-select-solid" id="status" name="status" style="padding: 4px;">
					<option value="Y" {{ @$previousData->status == 'Y' ? 'selected' : '' }}> सकृय</option>
					<option value="D" {{ @$previousData->status == 'D' ? 'selected' : '' }}>निस्कृय </option>
				</select>
			</div>
		</div>

</form>
<script>
$('.nepali-calendar').nepaliDatePicker({
	npdMonth: true,
	npdYear: true,
	language: 'nepali',
	unicodeDate: true,
	npdYearCount: 100 // Options | Number of years to show
});
var examCenterFormValid = $('#examCenterForm').validate({
	rules: {
		examcentername: {
			required: true
		},
		address: {
			required: true
		},
		status: {
			required: true
		},
	},
	messages: {
		examcentername: {
			required: "कृपया परिक्षा केन्द्रको नाम प्रविष्ट गर्नुहोस् ।"
		},
		address: {
			required: "कृपया परिक्षा केन्द्रको ठेगाना प्रविष्ट गर्नुहोस् ।"
		},
		status: {
			required: "कृपया परिक्षाकेन्द्रको स्थिति छान्न्होस् ।"
		},
	},
	highlight: function(element) {
		$(element).addClass('border-danger');
	},
	unhighlight: function(element) {
		$(element).removeClass('border-danger');
	},
});

</script>