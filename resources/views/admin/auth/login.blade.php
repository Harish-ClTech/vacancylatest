<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
@include('admin.layouts.head')
<!-- 03c75e green -->
<!-- #06c blue -->
<style>
	.footer{
		background-color: #505050;
		padding: 10px 0px !important;
	}
	.footer .text-dark span{
		color: !important;
	}
	.footer .text-dark a{
		color: #ffffff8c !important;
		font-weight: 600;
	}
</style>

<body id="kt_body" class="bg-dark">
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
			style="background-image: url(assets/media/illustrations/sketchy-1/14-dark.png">
			<div class="d-flex flex-center log_flx">
				<div class="log_img">
				<div class="modal-body">
				<p><u>दरखास्त फाराम भर्ने प्रकृया</u>:</p>
				<ol>
					<li>सर्वप्रथम Registration गर्नुपर्नेछ ।  त्यसको लागि Screen मा Registration मा Click गर्नुपर्नेछ । </li>
					<ul type="square">
						<li>Password कम्तिमा ६ Character को हुनु पर्नेछ, जसमध्ये कम्तिमा एउटा Capital Letter, एउटा Symbol र एउटा Numeric digit हुनुपर्नेछ ।</li>
						<li>Captcha Code राख्दा देखिए अनुरुप लेखी Continue मा Click गर्नुपर्नेछ ।</li>
						<li>Register गर्दा राखिने ईमेल र मोबाइल नम्बरमा दरखास्त स्वीकृत वा अस्वीकृत भएको जानकारी प्राप्त हुने भएकोले प्रयोग भइरहने आफ्नै ईमेल र मोबाइल राख्नु पर्नेछ ।</li>
						<li>Register  मा  Click  गरेपछि आफ्नो Email मा OTP प्राप्त हुनेछ ।  उक्त OTP प्रयोग गरेर Login Process सम्पन्न भएपश्चात Dashboard मा प्रवेश गर्न सक्नुहुनेछ । </li>
					</ul>
					<li>Login Process पहिले नै सम्पन्न भईसकेको भए सोझै आफ्नो Email र Password को प्रयोग गरी Login गर्न सक्नुहुनेछ ।</li>
					<li>Dashboard मा Click गरी हाल चालू रहेका विज्ञापनहरूको विवरण हेर्न सक्नुहुनेछ ।</li>
					<li>यसपछि <b>मेरो प्रोफाईल</b> भन्ने मेनुमा क्रमशः व्यक्तिगत विवरण, अन्य विवरण, सम्पर्क विवरण, शैक्षिक विवरण, अनुभव सम्बन्धि विवरण, तालिम सम्बन्धि विवरण भन्ने ट्याबमा आवश्यक विवरणहरु भर्नुका साथै र कागजात भन्ने ट्याबमा आवश्यक कागजातहरु अनिवार्य रूपमा Upload गर्नुपर्नेछ ।</li>
					<li>यस पश्चात आफूले भरेका सम्पूर्ण विवरणहरूको पुनरावलोकन (Preview) गर्ने । </li>
					<li> अन्तिममा रहेको "<b>आवेदन दिने</b>" भन्ने ट्याबमा गएर उपलब्ध बिज्ञापनहरू मध्ये एक पटकमा एक पदको दर्खास्तमा Apply गरी सो पदको लागि खुलेको बिज्ञापन नम्बरहरू Select गरी तोकिएको परीक्षा दस्तुर  e-Sewa वा Connect IPS मध्ये कुनै एक माध्यमको प्रयोग गरि बुझाउनु पर्नेछ ।</li>
					<li>दरखास्त Accept वा Incomplete वा Cancel भएको जानकारी Email वा Mobile मार्फत प्राप्त हुनेछ वा Login गरी पनि हेर्न सकिनेछ । </li>
					<li> कारणबस Incomplete दरखास्तहरू दरखास्त दिने अन्तिम दिनसम्ममा सोही Login बाट आफैले सच्याउनु पर्ने भएमा सच्याएर पूनः पेश गर्न सकिनेछ ।</li>
					<li>दरखास्त दस्तुर भुक्तानी गर्दा कुनै समस्या आएमा e-Sewa : 16600102121 र Connect IPS : 16600155306 मा सम्पर्क गर्न सक्नुहुनेछ । </li>
					<li>दरखास्त फारम भर्दा कुनै द्विविधा भएमा नागरिक लगानी कोषको टेलिफोन नं. ०१–५९७०२०१ मा सम्पर्क गरी वा कोषको Email: hrs@nlk.org.np  मार्फत बुझ्न सकिनेछ ।</li>
				</ol>

			</div>
				</div>
				<div class="bg-body shadow-sm log_form">
					<form class="form w-100" method="post" novalidate="novalidate" id="loginForm"
						action="{{route('loginadmin')}}">
						@csrf
						<div class="text-center mb-10 log_text_heading d-flex align-items-center justify-content-center">
						<img style="width:50px;height:50px;" src="<?php echo url('/') . '/adminAssets/assets/images/log_bk.png'; ?>" alt="">
							<h1 class="head_txt">नागरिक लगानी कोष</h1>
						</div>
						
						@include('admin.layouts.alert')

						<div class="form_grouping">
							<div class="fv-row mb-10 form_group">
								<div class="log_icons">
									<i class="fa-solid fa-user"></i>
								</div>
								<label for="email" class="form-label fs-6 fw-bolder text-dark fs-4">Email</label>
								<input class="form_input form-control form-control-sm form-control-solid" type="text"
									id="email" name="email" autocomplete="off" style="font-size: 16px;"/>
							</div>
							<div class="fv-row mb-10 form_group">
								<div class="log_icons">
									<i class="fa-solid fa-lock"></i>
								</div>
								<div class="d-flex flex-stack mb-2">
									<label id="password"
										class="form-label fw-bolder text-dark fs-4 mb-0">Password</label>
								</div>
								<input class="form_input form-control form-control-sm form-control-solid"
									type="password" id="password" name="password" autocomplete="off" />
							</div>

							{{-- <div class="rows d-flex justify-content-start">
								<a href="#" style="color:#505050;" class="me-2">Show Password</a>
								<input type="checkbox" onclick="myFunction()" name="" id="">
							</div> --}}

							<div class="fv-row mb-10 fg_pw">
								<a href="{{route('forgotPassword')}}">Forgot Password?</a>
							</div>

							<div class="text-center">
								<button type="submit" class="btn btn-lg log_btn">
									<span>Login</span>
								</button>


							</div>
						</div>


					</form>
					<div class="reg_group">
						<h5 class="reg_txt">Don't have an account? </h5>
						<div class="text-center sign_btn_btn">
							<a href="{{route('userRegister')}}"><button type="button">
									<span>Register</span>
								</button></a>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

{{-- <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content"> 
			<div class="modal-header">
				<h5 class="modal-title">कोषको मिति २०७९।०३।२८ गते प्रकाशित सूचना अनुसारका विभिन्न पदहरुमा आवेदन गर्न दरखास्त फाराम भर्ने प्रकृया:</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</div>
			<div class="modal-body">
				<p>
				<ol>
					<li>सर्वप्रथम Registration गर्नुपर्नेछ ।  त्यसको लागि Screen मा Registration मा Click गर्नुपर्नेछ । </li>
					<ul type="square">
						<li>Password कम्तिमा ६ Character को हुनु पर्नेछ, जसमध्ये कम्तिमा एउटा Capital Letter, एउटा Symbol र एउटा Number हुनुपर्नेछ ।</li>
						<li>Captcha Code राख्दा देखिए अनुरुप लेखी Continue मा Click गर्नुपर्नेछ ।</li>
						<li>Registration गर्दा राखिने ईमेल र मोबाइल दरखास्त स्वीकृत वा अस्वीकृत भएको जानकारी प्राप्त हुने भएकोले प्रयोग भइरहने आफ्नै ईमेल र मोबाइल राख्नु पर्नेछ ।</li>
						<li>Register  मा  Click  गरेपछि आफ्नो Email मा OTP प्राप्त हुनेछ ।  उक्त OTP प्रयोग गरेर Login Process सम्पन्न भएपश्चात Dashboard मा प्रवेश गर्न सक्नुहुनेछ । </li>
					</ul>
					<li>Login Process पहिले नै सम्पन्न भईसकेको भए सोझै आफ्नो Email र Password को प्रयोग गरी Login गर्न सक्नुहुनेछ ।</li>
					<li>Dashboard मा Click गरी हाल चालू रहेका विज्ञापनहरूको विवरण हेर्न सक्नुहुनेछ ।</li>
					<li>यसपछि क्रमशः Personal Details, Other Details, Contact Details, Education, Training तथा Experience को विवरण नेपाली युनिकोडमा भरी आवश्यक Document हरु अनिवार्य रूपमा Upload गर्नुपर्नेछ ।</li>
					<li>यस पश्चात आफूले भरेका सम्पूर्ण विवरणहरूको Preview हेरी Submit मा Click गरेर उपलब्ध बिज्ञापनहरू मध्य एक पटकमा एक पदको दर्खास्तमा Apply गरी सो पदको लागि खुलेको बिज्ञापन नम्बर/हरू Select गरी तोकिएको परीक्षा दस्तुर Khalti, e-Sewa वा Connect IPS मध्य कुनै एक माध्यम को  प्रयोग गरि बुझाउनु पर्नेछ ।</li>
					<li>दरखास्त Accept वा Incomplete वा Cancel भएको जानकारी Email वा Mobile मार्फत प्राप्त हुनेछ वा Login गरी पनि हेर्न सकिनेछ । कारणबस Incomplete दरखास्तहरू दरखास्त दिने अन्तिम दिनसम्ममा सोही Login बाट आफैले सच्याउनु पर्ने भएमा सच्याएर पूनः पेश गर्न सकिनेछ ।</li>
					<li>दरखास्त दस्तुर भुक्तानी गर्दा कुनै समस्या आएमा e-Sewa : 16600102121, Khalti : 16600158888 र Connect IPS : 16600155306 मा सम्पर्क गर्न सक्नुहुनेछ । </li>
					<li>दर्खास्त फारम भर्दा कुनै द्विविधा भएमा कोषको टेलिफोन नं. ०१–५०१०१३२ र ०१–५०१०१७२ मा सम्पर्क गरी वा कोषको Email: hrs@epf.org.np  मार्फत बुझ्न सकिनेछ ।</li>
				</ol>
				</p>
			</div>
		</div>
	</div>
</div> --}}

	<!--begin::Javascript-->
	@include('admin.layouts.scripts')
	<!--end::Javascript-->

	
	<!--begin::Footer-->
	<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
		<!--begin::Container-->
		<div class="container d-flex flex-column flex-md-row align-items-center" style="justify-content: space-between;">
			<!--begin::Copyright-->
			<div class="text-dark order-2 order-md-1">
				<span class="text-muted fw-bold me-1"><?php echo date('Y'); ?>©</span>
				<a class="text-gray-800 text-hover-primary" href="https://www.nlk.org.np/home" target="_new">नागरिक लगानी कोष</a>
			</div>
			<div class="text-dark order-2 order-md-1">
				Developed By: <a href="https://cltech.com.np" target="_new"  class="text-gray-800 text-hover-primary">Code Logic Technologies Pvt. Ltd.</a>
			</div>
			<!--end::Copyright-->
				</div>
		<!--end::Container-->
	</div>
	<!--end::Footer-->
</body>
<!--end::Body-->

</html>
<script>
	$(document).ready(function() {
		$('.modal').modal('show');

		$('.close').on('click', function() {
			$('.modal').modal('hide');
		});
	});

</script>

{{-- <script>
	 $(document).off('click', '#loginSubmit');
    $(document).on('click', '#loginSubmit', function() {
    $('#loginForm').ajaxSubmit({
        dataType: 'json'
        , success: function(response) {
            if (response.type == 'success') {
				var url=response.response;
                $.notify(response.message, 'success');
				window.location.href=url;
            } else {
				$('#error_msg').show();
				$('#error_msg_text').html(response.message);
            }
        }
    })
    })

	function myFunction() {
  const x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script> --}}
