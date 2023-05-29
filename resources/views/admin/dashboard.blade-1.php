@if(session()->get('roleid')==1)
<head>
	<style>
	.right_icons {
		color: #06c;
		font-size: 18px;
	}

	.dash_btn_flx {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 15px;

	}

	.dash_btn_flx h6 {
		color: #06c;
		font-weight: 600;
		margin: 0px;
	}

	.dash_btn_flx button {
		background-color: transparent;
		border: none;
	}

	.card-body {
		padding: 0px !important;
	}

	.dash_ct_flx {
		display: flex;
		justify-content: space-between;
		padding: 20px;
		background: #06c;
		border-top-left-radius: 10px;
		border-top-right-radius: 10px;
	}



	.dash_ct_flx h3 {
		color: #fff !important;
	}

	.dash_ct_flx p {
		color: #fff !important;
	}

	.dash_icons {
		font-size: 45px;
		color: #fff;
	}
	</style>
</head>
<div class="container-fluid" style="    padding: 0px 30px;
    margin-bottom: 30px;">
	<div class="row">
		<div class="col-md-6 col-xl-4 dash_card">
			<div class="card">
				<div class="card-body">
					<div class="dash_ct_flx">
						<div class="dash_ct">
							<div class="avatar-sm bg-soft-danger rounded">
								<i class="fa-solid fa-comments dash_icons"></i>
							</div>
						</div>
						<div class="col-6">
							<div class="text-end">
								<h3 class="text-dark my-1">
									<span>12,145</span>
								</h3>
								<p class="text-muted mb-1 text-truncate">Today's Application</p>
							</div>
						</div>
					</div>
					<div class="dash_btn_flx">
						<h6 class="text-uppercase">View Details</h6>
						<div class="view_arrow">
							<button>
								<i class="fa-solid fa-circle-arrow-right right_icons"></i>
							</button>
						</div>
					</div>
				</div>
			</div> <!-- end card-->
		</div> <!-- end col -->

		<div class="col-md-6 col-xl-4 dash_card">
			<div class="card">
				<div class="card-body">
					<div class="dash_ct_flx">
						<div class="dash_ct">
							<div class="avatar-sm bg-soft-warning rounded">
								<i class="fa-solid fa-comments dash_icons"></i>
							</div>
						</div>
						<div class="col-6">
							<div class="text-end">
								<h3 class="text-dark my-1"><span>8947</span></h3>
								<p class="text-muted mb-1 text-truncate">Total Application</p>
							</div>
						</div>
					</div>
					<div class="dash_btn_flx">
						<h6 class="text-uppercase">View Details</h6>
						<div class="view_arrow">
							<button>
								<i class="fa-solid fa-circle-arrow-right right_icons"></i>
							</button>
						</div>
					</div>
				</div>
			</div> <!-- end card-->
		</div> <!-- end col -->

		<div class="col-md-6 col-xl-4 dash_card">
			<div class="card">
				<div class="card-body">
					<div class="dash_ct_flx">
						<div class="dash_ct">
							<div class="avatar-sm bg-soft-dark rounded">
								<i class="fa-solid fa-comments dash_icons"></i>
							</div>
						</div>
						<div class="col-6">
							<div class="text-end">
								<h3 class="text-dark my-1"><span>4</span></h3>
								<p class="text-muted mb-1 text-truncate">Pending Applications</p>
							</div>
						</div>
					</div>
					<div class="dash_btn_flx">
						<h6 class="text-uppercase">View Details</h6>
						<div class="view_arrow">
							<button>
								<i class="fa-solid fa-circle-arrow-right right_icons"></i>
							</button>
						</div>
					</div>
				</div>
			</div> <!-- end card-->
		</div> <!-- end col -->
	</div>
</div>
@else


<div class="post d-flex flex-column-fluid" id="kt_post">
	<div class="post d-flex flex-column-fluid" id="kt_post">

		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
						<div class="d-flex justify-content-end">
							Dashboard
						</div>
						<!--end::Toolbar-->
					</div>
					<!--end::Card toolbar-->
				</div>
				<!--end::Card header-->

				<!--begin::Card body-->
				<div class="card-body py-4">
					<!--begin::Table-->
					<label>Available Vacancy</label>
					<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
						<div class="table-responsive">
							<table class="table-bordered table-striped table-condensed cf" id="experienceDetailTable"
								width="100%">
								<thead class="cf">
									<tr>
										<th>क्रम संख्या </th>
										<th>विज्ञापन नं</th>
										<th>तह</th>
										<th>पद </th> 
										<th>योग्यता</th>
										<th>सेवा÷समूह</th>
										<th>खुला र समावेशी</th>
										<th>विज्ञापन संख्या</th>
										<th>विज्ञापन विस्तारित मिति</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									@foreach($newvac as $key=>$rownewvac)
									<tr>
										<td>{{$i}}</td>
										<td>{{$rownewvac->vacancynumber}}</td>
										<td>{{$rownewvac->labelname}}</</td>
										<td>{{$rownewvac->designation}}</</td> 
										<td>{{$rownewvac->academic}}</td> 
										<td>{{$rownewvac->servicegroupname}}</td> 
										<td>{{$rownewvac->jobcategoryname}}</td>
										<td>{{$rownewvac->numberofvacancy}}</td>
										<td>{{$rownewvac->vacancyenddate}}</td>
									</tr>
								<?php $i++; ?>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<!--end::Table-->
				</div>
				<!--end::Card body-->


				<!--begin::Card body-->
				<div class="card-body py-4">
				</div>
				<!--end::Card body-->				
		</div>
			<!--end::Card-->
		</div>
	</div>
</div>
@endif
