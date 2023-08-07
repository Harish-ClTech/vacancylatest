<form id="userSetupForm" method="post" class="form" enctype="multipart/form-data" action="{{ @$saveurl }}">
	<input type="hidden" value="{{ @$previousData[0]->userid }}" name="usersetupid" />
	<!--begin::Heading-->
	<div class="mb-13 text-center">
		<!--begin::Title-->
		<h3 class="mb-3" style=" color: #3C2784;  font-weight: 600; margin-top: 5px;">प्रयोगकर्ता थप गर्ने फारम</h3>
		<!--end::Title-->
	</div>
	<!--end::Heading-->
	<div class="custom_form">
		<div class="row g2 mb-2">
			<!--begin::Col-->
			<div class="col-md-4 fv-row">
				<label for="firstname" class="required fs-6 fw-bold mb-2"> पहिलो नाम</label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder="प्रयोगकर्ताको पहिलो नाम" id="firstname" name="firstname"
					value="{{ @$previousData[0]->firstname }}">

			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-4 fv-row">
				<label for="middlename" class="fs-6 fw-bold mb-2"> बीचको नाम</label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder="प्रयोगकर्ताको बीचको नाम" id="middlename" name="middlename"
					value="{{ @$previousData[0]->middlename }}">

			</div>
			<!--end::Col-->

			<!--begin::Col-->
			<div class="col-md-4 fv-row">
				<label for="lastname" class="required fs-6 fw-bold mb-2">अन्तिमको नाम</label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder="प्रयोगकर्ताको अन्तिमको नाम" id="lastname" name="lastname"
					value="{{ @$previousData[0]->lastname }}">

			</div>
			<!--end::Col-->

			<!--begin::Col-->
			<div class="col-md-4 fv-row">
				<label for="designationid" class="required fs-6 fw-bold mb-2"> पद </label>
				<select class="form-select form_input  select2 form-select-solid" id="designationid" name="designationid"
					style="padding: 4px;">
					<option value="">हाल कार्यरत पद छान्नुहोस्</option>
					@if (!empty($designations))
						@foreach ($designations as $designation)
						<option value="{{ @$designation->id }}"
							{{ $designation->id==@$previousData[0]->designationid ? "selected" : " "}}>{{ @$designation->title }}
						</option>
						@endforeach
					@endif
				</select>
			</div>
			<!--end::Col-->

				<!--begin::Col-->
				<div class="col-md-4 fv-row">
					<label for="roleid" class="required fs-6 fw-bold mb-2"> भूमिका </label>
					<select class="form-select form_input  select2 form-select-solid" id="roleid" name="roleid"
						style="padding: 4px;">
						<option value="">प्रयोगकर्ताको भूमिका छान्नुहोस्</option>
						@if (!empty($roles))
							@foreach ($roles as $role)
							<option value="{{ @$role->id }}"
								{{ $role->id==1 ? "selected" : " "}}>{{ @$role->name }}
							</option>
							@endforeach
						@endif
					</select>
				</div>
				<!--end::Col-->

			<!--begin::Col-->
			<div class="col-md-4 fv-row">
				<label for="contactnumber" class="required fs-6 fw-bold mb-2">सम्पर्क नम्बर</label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder="सम्पर्क नम्बर" id="contactnumber" name="contactnumber"
					value="{{ @$previousData[0]->contactnumber }}">

			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-md-4 fv-row">
				<label for="email" class="required fs-6 fw-bold mb-2">प्रयोगकर्ताको इमेल ठेगाना</label>
				<input type="text" class="form-control form_input form-control-solid"
					placeholder="प्रयोगकर्ताको इमेल ठेगाना" id="email" name="email"
					value="{{ @$previousData[0]->email }}">

			</div>
			<!--end::Col-->

			<!--begin::Col-->
			<div class="col-md-4 fv-row">
				<label for="gender" class="required fs-6 fw-bold mb-2"> लिङ्ग </label>
				<select class="form-select form_input  select2 form-select-solid" id="gender" name="gender" style="padding: 4px;">
					<option value="">लिङ्ग छान्नुहोस्</option>
					<option value="Male" {{ @$previousData[0]->gender=="Male" ? "selected" : " "}}>पुरुष</option>
					<option value="Female" {{ @$previousData[0]->gender=="Female" ? "selected" : " "}}>महिला</option>
					<option value="Others" {{ @$previousData[0]->gender=="Others" ? "selected" : " "}}>अन्य</option>
				</select>
				</select>
			</div>
			<!--end::Col-->

			<!--begin::Col-->
			<div class="col-md-4 fv-row">
				<label for="level" class="required fs-6 fw-bold mb-2">व्यवस्थापन गर्नुपर्ने विज्ञापन</label>
				<?php $levelArray = explode(',', @$previousData[0]->userlevel); ?>

				<select id="level" class="form-select form_input form-select-solid autotext-multiple"  name="level[]" multiple="multiple"
					style="padding: 4px; width: 100%;z-index:999999;">
					<option value="">विज्ञापन (तह) छान्नुहोस्</option>
					@if (!empty($levels))
						@foreach ($levels as $level)
						<option value="{{ @$level->id }}"
							@foreach ($levelArray as $key=>$value)
								{{ $level->id==@$value ? "selected" : " "}}
							@endforeach>{{ @$level->labelname }}
						</option>
						@endforeach
					@endif
				</select>
			</div>
			<!--end::Col-->
			@isset($previousData)

			@else
				<!--begin::Col-->
				<div class="col-md-4 fv-row">
					<label for="password" class="required fs-6 fw-bold mb-2">पासवर्ड</label>
					<input type="text" class="form-control form_input form-control-solid"
						placeholder="पासवर्ड राख्नुहोस" id="password" name="password"
						value="{{ @$previousData[0]->password }}">

				</div>
				<!--end::Col-->

				<!--begin::Col-->
				<div class="col-md-4 fv-row">
					<label for="retypepassword" class="required fs-6 fw-bold mb-2">पुन: पासवर्ड</label>
					<input type="text" class="form-control form_input form-control-solid"
						placeholder="पासवर्ड पुन: राख्नुहोस" id="retypepassword" name="retypepassword"
						value="{{ @$previousData[0]->retypepassword }}">

				</div>
				<!--end::Col-->
			@endisset

		</div>
		<!--end::Input group-->

</form>
<script>
$('.nepali-calendar').nepaliDatePicker({
	npdMonth: true,
	npdYear: true,
	language: 'nepali',
	unicodeDate: true,
	npdYearCount: 100 // Options | Number of years to show
});

$(document).ready(function() {
    $('.autotext-multiple').select2();
});
</script>
