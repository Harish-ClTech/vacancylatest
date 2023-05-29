<!--begin::Toolbar-->
@if (!empty(session()->get('roleid') != 1))

<div class="toolbar" id="kt_toolbar" style="box-shadow: none; border: none;">
	<!--begin::Container-->
	<div class="w-100 mt-25">
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<!--begin::Page Toolbar-->

			<nav class="col-12 navbar navbar-expand-lg navbar-light bg-light tab_navbar"
				style="background-color: #1472d0!important">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li id="dashboardDetails" onclick="navigaterTo('dashboardDetails')"
							class="nav-item {{ request()->is('dashboardDetails') ? 'active' : '' }}">
							<a class="nav-link" href="javascript:;">Dashboard</a>
						</li>
						<li id="personal" onclick="navigaterTo('personal')"
							class="nav-item {{ request()->is('personal') ? 'active' : '' }}">
							<a class="nav-link" href="javascript:;">Personal</a>
						</li>
						<li id="otherdetailForm" onclick="navigaterTo('otherdetailForm')"
							class="nav-item {{ request()->is('otherdetailForm') ? 'active' : '' }}">
							<a class="nav-link" href="javascript:;">Other Detail</a>
						</li>
						<li id="contactdetailForm" onclick="navigaterTo('contactdetailForm')"
							class="nav-item {{ request()->is('contactdetailForm') ? 'active' : '' }}">
							<a class="nav-link" href="javascript:;">Contact Detail</a>
						</li>
						<li id="education" onclick="navigaterTo('education')"
							class="nav-item {{ request()->is('education') ? 'active' : '' }}">
							<a class="nav-link" href="javascript:;">Education</a>
						</li>
						<li id="training" onclick="navigaterTo('training')"
							class="nav-item {{ request()->is('training') ? 'active' : '' }}">
							<a class="nav-link" href="javascript:;">Training</a>
						</li>
						<li id="experience" onclick="navigaterTo('experience')"
							class="nav-item {{ request()->is('experience') ? 'active' : '' }}">
							<a class="nav-link" href="javascript:;">Experience</a>
						</li>
						<li id="document" onclick="navigaterTo('document')"
							class="nav-item {{ request()->is('document') ? 'active' : '' }}">
							<a class="nav-link" href="javascript:;">Document</a>
						</li>
						<li id="preview" onclick="navigaterTo('preview')"
							class="nav-item {{ request()->is('preview') ? 'active' : '' }}">
							<a class="nav-link" href="javascript:;">Preview</a>
						</li>
						<li id="submit" onclick="navigaterTo('submit')"
							class="nav-item {{ request()->is('submit') ? 'active' : '' }}">
							<a class="nav-link" href="javascript:;">Submit</a>
						</li>
					</ul>
				</div>
			</nav>
			<!--end::Page Toolbar-->
		</div>
		<!--end::Container-->
		<div class="kt_toolbar_container mx-2" style="display: none">
			<div class="progress ">
				<div class="progress-bar" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0"
					aria-valuemax="100">

				</div>
			</div>
		</div>
	</div>
</div>
@endif
<!--end::Toolbar-->
<div id="urlView">

</div>

<!-- Toobar CSS -->
<style type="text/css">
.toolbar .active {
	color: white;
	background-color: #037bfe;
	border: 0.2px solid black;
	border-radius: 5px;
}

.toolbar li {
	margin: 0.5em;
	font-size: 1.1em;
}
</style>
<!-- Toobar CSS -->

<script>

function navigaterTo (route) {

	var url = route;
	var infoData = {
		personaldetailid: "{{session()->get('personalid')}}",
		userid: "{{auth()->user()->id}}"
	};
	
	$.ajax({
		type: 'POST',
		url: url,
		data: infoData,
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success: function(response) {
			$("#urlView").empty();
			$("#urlView").html(response);
			$(".nav-item").removeClass("active");
			$("#" + route).addClass("active");
		}
    });

	if (url == 'contactdetailForm') {
		$('#provinceid').trigger('change');
		$('#districtid').trigger('change');
		$('#tempoprovinceid').trigger('change');
		$('#tempodistrictid').trigger('change');
	}
}

$('#dashboardDetails').trigger('click');

</script>