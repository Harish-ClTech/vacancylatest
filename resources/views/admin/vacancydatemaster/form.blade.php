<form id="vacancyDateSetupForm" method="post" class="form" enctype="multipart/form-data" action="{{ @$saveurl }}">
	<input type="hidden" value="{{ @$previousData->id }}" name="vacancysetupid" />
	<div class="mb-13 text-center">
		<h4 class="mb-3" style="    color: #08c;  font-weight: 600; margin-top: 5px;">विज्ञापन मिति सेटअप</h4>
	</div>
	<div class="row g2 mb-2">
		<input type="hidden" name="vacancydatemasterid" value="{{@$previousData->id}}">
		<div class="col-md-3 form-group">
			<label for="fiscalyear" class="required fs-6 fw-bold mb-2"> आर्थिक बर्ष </label>
			<select class="form-select form_input select2 form-select-solid" id="fiscalyear" name="fiscalyearid"
				style="padding: 4px;">
				<option value="">आर्थिक बर्ष छान्नुहोस्</option>
				@if(!empty($fiscalyears))
					@foreach ($fiscalyears as $fiscalyear)
					<option value="{{ @$fiscalyear->id }}" {{ $fiscalyear->id==@$previousData->fiscalyearid ? "selected" : " "}}>
						{{ @$fiscalyear->fiscalyearname }}</option>
					@endforeach
				@endif
			</select>
		</div>
		<div class="col-md-3 form-group">
			<label for="vacancypublishdate" class="required fs-6 fw-bold mb-2">विज्ञापन प्रकाशित मिति </label>
			<input type="text"
				class="form-control form_input form-control-solid nepali-calendar ndp-nepali-calendar"
				placeholder="मिति राख्नुहोस" id="vacancypublishdate" name="vacancypublishdate"
				value="{{@$previousData->vacancypublishdate}}" />
		</div>
		<div class="col-md-3 form-group">
			<label for="vacancyenddate" class="required fs-6 fw-bold mb-2">विज्ञापन समाप्ति मिति</label>
			<input type="text"
				class="form-control form_input form-control-solid nepali-calendar ndp-nepali-calendar"
				placeholder="मिति राख्नुहोस" id="vacancyenddate" name="vacancyenddate"
				value="{{@$previousData->vacancyenddate}}" />
		</div>
		<div class="col-md-3 form-group">
			<label for="vacancyextendeddate" class="required fs-6 fw-bold mb-2">विज्ञापन विस्तारित मिति</label>
			<input type="text"
				class="form-control form_input form-control-solid nepali-calendar ndp-nepali-calendar"
				placeholder="मिति राख्नुहोस" id="vacancyextendeddate" name="vacancyextendeddate"
				value="{{@$previousData->vacancyextendeddate}}" />

		</div>
		<div class="col-md-9 form-check pl-5">
			<input type="checkbox" class="form-check-input" id="allow_registration" name="allow_registration" value="Y" {{ (!empty($previousData->allow_registration)&& $previousData->allow_registration=='Y')?'checked':''}}/>
			<label for="allow_registration" class="form-check-label text-danger text-bold mt-2"> फारम भर्न दिने ? </label>
		</div>
		<div class="col-md-3 text-right">
			<button type="button" id="saveVacancyDate" class="btn btn-primary btn-sm">
				सेभ गर्नुहोस्
			</button>
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
</script>