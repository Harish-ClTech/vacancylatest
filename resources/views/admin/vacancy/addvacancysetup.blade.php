<form id="vacancySetupForm" method="post" class="form" enctype="multipart/form-data" action="{{ @$saveurl }}">
	<input type="hidden" value="{{ @$previousData->id }}" name="vacancysetupid" />
	<!--begin::Heading-->
	<div class="mb-13 text-center">
		<!--begin::Title-->
		<h4 class="mb-3" style="    color: #3c2784;  font-weight: 600; margin-top: 5px;">रिक्तता सेटअप फारम</h4>
		<!--end::Title-->
	</div>
	<!--end::Heading-->
	<div class="custom_form">
		<div class="row g2 mb-2">
			<!--begin::Col-->
			<div class="col-md-3 fv-row">
				<label for="vacancynumber" class="required fs-6 fw-bold mb-2">विज्ञापन नं</label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder="विज्ञापन नं राख्नुहोस" id="vacancynumber" name="vacancynumber"
					value="{{ @$previousData->vacancynumber }}">

			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-3 fv-row">
				<label for="level" class="required fs-6 fw-bold mb-2"> तह </label>
				<select class="form-select form_input select2 form-select-solid" id="level" name="level"
					style="padding: 4px;">
					<option value="">तह छान्नुहोस्</option>
					@foreach ($levels as $level)
					<option value="{{ @$level->id }}" {{ $level->id==@$previousData->level ? "selected" : " "}}>
						{{ @$level->labelname }}</option>
					@endforeach
				</select>

			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-3 fv-row">
				<label for="designation" class="required fs-6 fw-bold mb-2"> पद </label>
				<select class="form-select form_input  select2 form-select-solid" id="designation" name="designation"
					style="padding: 4px;">
					<option value="">पद छान्नुहोस्</option>
					@foreach ($designations as $designation)
					<option value="{{ @$designation->id }}"
						{{ $designation->id==@$previousData->designation ? "selected" : " "}}>{{ @$designation->title }}
					</option>
					@endforeach
				</select>

			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-3 fv-row">
				<label for="academicid" class="required fs-6 fw-bold mb-2"> योग्यता </label>
				<select class="form-select form_input  select2 form-select-solid" id="academicid" name="academicid"
					style="padding: 4px;">
					<option value="">योग्यता छान्नुहोस्</option>
					@foreach ($academics as $academic)
					<option value="{{ @$academic->id }}"
						{{ $academic->id==@$previousData->academicid ? "selected" : " "}}>
						{{ @$academic->name }}</option>
					@endforeach
				</select>

			</div>
			<!--end::Col-->

		</div>
		<!--end::Input group-->

		<!--begin::Input group-->
		<div class="row g2 mb-2">
			<!--begin::Col-->
			<div class="col-md-3 fv-row">
				<label for="servicesgroup" class="required fs-6 fw-bold mb-2">सेवा÷समूह </label>
				<select class="form-select form_input  select2 form-select-solid" id="servicesgroup"
					name="servicesgroup" style="padding: 4px;">
					<option value="">सेवा÷समूह छान्नुहोस्</option>
					@foreach ($servicegroups as $service)
					<option value="{{ @$service->id }}"
						{{ $service->id==@$previousData->servicesgroup ? "selected" : " "}}>
						{{ @$service->servicegroupname }}</option>
					@endforeach
				</select>

			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-3 fv-row">
				<label for="jobcategory" class="required fs-6 fw-bold mb-2">खुला र समावेशी</label>
				<select class="form-select form_input  select2 form-select-solid" id="jobcategory" name="jobcategory"
					style="padding: 4px;">
					<option value="">खुला र समावेशी छान्नुहोस्</option>
					@foreach ($jobcategories as $jobcategory)
					<option value="{{ @$jobcategory->id }}"
						{{ $jobcategory->id==@$previousData->jobcategory ? "selected" : " "}}>{{ @$jobcategory->name }}
					</option>
					@endforeach
				</select>
			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-3 fv-row">
				<label for="vacancyrate" class="required fs-6 fw-bold mb-2">विज्ञापन दस्तुर </label>
				<input type="text" class="form-control form_input form-control-solid" placeholder="दरखास्त दस्तुर "
					id="vacancyrate" name="vacancyrate" value="{{ @$previousData->vacancyrate }}" />

			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-3 fv-row">
				<label for="numberofvacancy" class="required fs-6 fw-bold mb-2">विज्ञापन संख्या </label>
				<input type="text" class="form-control form_input form-control-solid" placeholder="विज्ञापन संख्या "
					id="numberofvacancy" name="numberofvacancy" value="{{ @$previousData->numberofvacancy }}" />

			</div>
			<!--end::Col-->

		</div>
		<!--end::Input group-->

		<!--begin::Input group-->
		<div class="row g2 mb-2">
			<!--end::Col-->
			<div class="col-md-3 fv-row">
				<label for="vacancypublishdate" class="required fs-6 fw-bold mb-2">विज्ञापन प्रकाशित मिति </label>
				<input type="text"
					class="form-control form_input form-control-solid nepali-calendar ndp-nepali-calendar"
					placeholder="मिति राख्नुहोस" id="vacancypublishdate" name="vacancypublishdate"
					value="{{@$previousData->vacancypublishdate}}" />

			</div>
			<!--end::Col-->
			<!--end::Col-->
			<div class="col-md-3 fv-row">
				<label for="vacancyenddate" class="required fs-6 fw-bold mb-2">विज्ञापन समाप्ति मिति</label>
				<input type="text"
					class="form-control form_input form-control-solid nepali-calendar ndp-nepali-calendar"
					placeholder="मिति राख्नुहोस" id="vacancyenddate" name="vacancyenddate"
					value="{{@$previousData->vacancyenddate}}" />

			</div>
			<!--end::Col-->
			<!--end::Col-->
			<div class="col-md-3 fv-row">
				<label for="extendeddate" class="required fs-6 fw-bold mb-2">विज्ञापन विस्तारित मिति</label>
				<input type="text"
					class="form-control form_input form-control-solid nepali-calendar ndp-nepali-calendar"
					placeholder="मिति राख्नुहोस" id="extendeddate" name="extendeddate"
					value="{{@$previousData->extendeddate}}" />

			</div>
			<!--end::Col-->
			<!--end::Col-->
			<div class="col-md-3 fv-row">
				<label for="jobstatus" class="required fs-6 fw-bold mb-2">विज्ञापन स्थिति</label>
				<select class="form-select form_input  select2 form-select-solid" id="jobstatus" name="jobstatus"
					style="padding: 4px;">
					<option value="Active" {{ @$previousData->jobstatus == 'Active' ? 'selected' : '' }} selected>
						Active</option>
					<option value="Inactive" {{ @$previousData->jobstatus == 'Inactive' ? 'selected' : '' }}>Inactive
					</option>

				</select>
			</div>
			<!--end::Col-->
			<!--end::Col-->
			<div class="col-md-3 fv-row">
				<label for="extendeddate" class="fs-6 fw-bold mb-2">उमेर हद</label>
				<input type="text" class="form-control form_input form-control-solid" placeholder="उमेर हद" id="agelimit" name="agelimit" value="{{@$previousData->agelimit}}" />
			</div>
			<!--end::Col-->
			<div class="col-md-4 fv-row">
				<label for="isinternalvacancy" class="fs-6 fw-bold mb-2">
					<?php 
					$isInternalVacancy = '';
					if(@$previousData->isinternalvacancy == 'Y'){
						$isInternalVacancy = 'checked';
					}	
					?>
					<input type="checkbox" name="isinternalvacancy" id="isinternalvacancy" class="isinternalvacancy" {{ $isInternalVacancy }}> आन्तरिक प्रतियोगिता हो ?
				</label>
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