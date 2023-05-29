
@extends('admin.layouts.admin_designs')
@section('css')
<style>
	canvas{
		display: none;
	}
	#profileChart {
	    overflow: hidden;
    	height: auto !important;
    	min-width: auto !important;
		height: 400px;
		margin: 0 auto;
	}
	.highcharts-container{
		width: 100% !important;
		height: 100% !important;
	} 
	.highcharts-root{
		position: relative;
		width: 150px !important;
		height: 150px !important;
	}
	path.highcharts-point.highcharts-color-0{
		fill:#3C2784 !important;
		
	}
	.highcharts-subtitle{
	    left: 51.5px !important;
    	top: 48px !important;
    	font-size: 13px !important;
	}
	.highcharts-subtitle div{
	    font-size: 19px !important;
	}
	.highcharts-credits{
		display: none;
	}

</style>
@endsection

@section('content')
	@if(session()->get('roleid')==1)
		<?php $data = Session::all(); 
			// print_r($data);
		?>
		{{-- <head> --}}
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
		{{-- </head> --}}

		{{-- <div class="container-fluid" style="padding: 0px 30px; margin-bottom: 30px;"> --}}
			<div class="row">
				@include('admin.layouts.alert')
				<div class="col-md-6 col-xl-3 dash_card">
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
											<span>{{$totalTodayRecs}}</span>
										</h3>
										<p class="text-muted mb-1 text-truncate" style="margin-left: -10px;">Today's Application</p>
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

				<div class="col-md-6 col-xl-3 dash_card">
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
										<h3 class="text-dark my-1"><span>{{$totalRecs}}</span></h3>
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

				<div class="col-md-6 col-xl-3 dash_card">
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
										<h3 class="text-dark my-1"><span>{{$totalPendingRecs}}</span></h3>
										<p class="text-muted mb-1 text-truncate" style="margin-left: -25px;">Pending Applications</p>
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
				
				<div class="col-md-6 col-xl-3 dash_card">
					<div class="card">
						<div class="card-body">
							<div class="dash_ct_flx" style="background-color: #3c2784">
								<div class="dash_ct">
									<div class="avatar-sm bg-soft-warning rounded">
										<i class="fa-solid fa-comments dash_icons"></i>
									</div>
								</div>
								<div class="col-6">
									<div class="text-end">
										<h3 class="text-dark my-1"><span>{{$totalRegisteredUsers}}</span></h3>
										<p class="text-muted mb-1 text-truncate" style="margin-left: -25px;">Total Registered Users</p>
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
		{{-- </div> --}}
	@else
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<div class="post d-flex flex-column-fluid" id="kt_post">

				<div id="kt_content_container" class="container-xxl">
					<!--begin::Card-->
					<div class="card mt-5">
						<div class="card-body p-3 d-flex flex-wrap align-items-center">

							
							<!--begin::Chart-->
							<div class="d-flex flex-center me-5">
								<div id="kt_card_widget_17_chart" style="min-width: 70px; min-height: 70px;display:none;" data-kt-size="70" data-kt-line="11">
									<!-- <span></span><canvas height="70" width="70"></canvas> -->
								</div>
								<div id="profileChart"></div>

							</div>
							<!--end::Chart-->
							
							<!--begin::Labels-->
							<div class="d-flex flex-column content-justify-center flex-row-fluid">
							<!--begin::Label-->
							<div class="d-flex fw-semibold align-items-center">
								<!--begin::Bullet-->
								<div class="bullet w-8px h-3px rounded-2 me-3" style="background-color: #E4E6EF"></div>
								<!--end::Bullet-->
								<!--begin::Label-->
								<div class="text-gray-500 flex-grow-1 me-4">
									@if(!empty($updatePercentage) && $updatePercentage<100)
										हल सम्म तपाईको प्रोफाईल पूर्ण रूपमा अपडेट नगरिएकोले कुनै पनि पदका लागि आवेदन दिनु पुर्व आफ्नो प्रोफाईलमा गएर अनिवार्य आवश्यक विवरणहरु अपडेट गर्नुहोला ।
									@else
										तपाईको प्रोफाईल भएको विवरण स्वयमं रुजु गरेर मात्र आवेदन दिनुहोला ।
									@endif								
								</div>
								
								<div class=" fw-bolder text-gray-700 text-xxl-end">
									<a class="text-white" href="{{ route('applicantprofile')}}" style="background: #3C2784;color: #fff;border: none;padding: 10px 20px;font-weight: 600;border-radius: 3px;cursor:pointer;"><i class="fa fa-user fa-xl"></i> मेरो प्रोफाईल </a>
								</div>
							</div>
							<!--end::Label-->
							</div>
							<!--end::Labels-->
						</div>
					</div>
					{{-- <div class="card mt-2">
						<!--begin::Card body-->
						
						<div class="card-body p-0">
							<!--begin::Table-->
							@if (!empty($appliedData))
								<label><b><u>Applied Vacancy Status:</u></b></label>
								<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
									<div class="table-responsive applicantCommonInfo">
										@foreach ($appliedData as $akey=>$aval)
											<ul class="registerInfo">
												<li>
													<p>दर्ता न‌.: <b>{{$aval['registrationnumber']}}</b></p>
												</li>
												<li>
													<p>आव‌ेदन मिति.: <b>{{$aval['applieddatead']}}</b></p>
												</li>
												<li>
													<p>रिसद न‌.: <b>{{$aval['receipnumber']}}</b></p>
												</li>
												<li>
													<p>रकम.: <b>{{$aval['applyamount']}}</b></p>
												</li>
												<li>
													<p>रकम भुक्तानीको श्रोत.: <b>{{$aval['paymentsource']}}</b></p>
												</li>
											</ul>
											@foreach($aval['applyDetails'] as $newkey=>$newval)
												<ul class="applyDetailInfo">
													<li>
														<p>पद.: <b>{{$newkey}}</b></p>
													</li>
													<li>
														<p>स्थिति.: <b>
															@if($newval['appliedstatus'] == 'Incomplete')
																<span class="badge rounded-pill bg-danger">{{$newval['appliedstatus']}}</span>
															@elseif($newval['appliedstatus'] == 'Rejected')
																<span class="badge rounded-pill bg-danger">{{$newval['appliedstatus']}}</span>
															@elseif($newval['appliedstatus'] == 'Pending')
																<span class="badge rounded-pill bg-warning">{{$newval['appliedstatus']}}</span>
															@elseif($newval['appliedstatus'] == 'Verified')
																<span class="badge rounded-pill bg-success">{{$newval['appliedstatus']}}</span>
															@endif
															</b></p>
													</li>
													<li>
														<p>टिप्पणी.: <b>{{$newval['remarks']}}</b></p>
													</li>
													<li>
														<p>प्रतिकृया.: <b>{{$newval['feedback']}}</b></p>
													</li>
													@if($newval['appliedstatus'] == 'Verified' && $newval['vacancycanceled'] != 'Y')
														<li id="admit-btn">
															@if(!empty($newval['symbolnumber']))
																<button class="btn btn-success btn-sm viewAdmitCardBtn" data-degid="{{ $newval['designationid'] }}"><i class="fa fa-id-card" aria-hidden="true"></i> &nbsp;प्रवेश पत्र</button>
															@else
																<button class="btn btn-danger btn-sm viewAdmitCardBtn" data-degid="{{ $newval['designationid'] }}"><i class="fa fa-id-card" aria-hidden="true"></i> &nbsp;SAMPLE प्रवेश पत्र</button>
															@endif
														</li>
													@endif
												</ul>

												<table class="table-bordered table-striped table-condensed cf" id="appliedVacancyTable"width="100%" style="margin-bottom: 20px;">
													<thead class="cf">
														<tr class="head">
															<th>क्रम संख्या</th>
															<th>विज्ञापन नं.</th> 
															<th>खुला र समावेशी</th>
															<th>स्थिति</th>
															<th>टिप्पणी</th>
														</tr>
													</thead>
													<tbody>
														@foreach($newval['jobCategories'] as $lastkey=>$lastval)
															<tr style="font-weight:normal;">
																<td>{{$loop->iteration }}</td>
																<td>{{$lastval['vacancynumber']}}</</td> 
																<td>{{$lastkey}}</td> 
																<td>
																	@if($newval['vacancycanceled'] == 'Y')
																		<span class="badge rounded-pill bg-danger">अस्वीकृत</span>
																	@endif
																<td>{{$lastval['vacancycanceledremarks']}}</td>
															</tr>
														@endforeach
													</tbody>
												</table>
											@endforeach
										@endforeach	
									</div>
								</div>
							@endif
							<!--end::Table-->
						</div>
						<!--end::Card body-->
						<!--- start::admitcard popup ---->
							
							<!-- Modal -->
							<div class="modal fade" id="admitCardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="admitCardModalLabel" aria-hidden="true">
								
							</div>
						<!--- End::admitcard popup ---->

						<!--begin::Card body-->
						<div class="card-body py-4">
						<label><b><h4 style="color: #3C2784; font-weight:600;">Available Vacancy:</h4></b></label>
							<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
								<div class="table-responsive">
									<table class="table-bordered table-striped table-condensed cf" id="experienceDetailTable"
										width="100%">
										<thead class="cf" style="background: #DFE1E5;">
											<tr style="color:#3C2784;">
												<th>क्रम संख्या </th>
												<th>विज्ञापन नं.</th>
												<th>तह</th>
												<th>पद </th> 
												<th>योग्यता</th>
												<th>सेवा/समूह</th>
												<th>खुला र समावेशी</th>
												<th>पद संख्या</th>
												<th>प्रकाशित मिति </th>
												<th>अन्तिम मिति  </th>
												<th>दोब्बर दस्तुर मिति  </th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; ?>
											@if(!empty($newvac))
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
														<td>{{@$rownewvac->vacancypublishdate}}</td>
														<td>{{@$rownewvac->vacancyenddate}}</td>
														<td>{{@$rownewvac->extendeddate}}</td>
													</tr>
													<?php $i++; ?>
												@endforeach
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!--end::Card body-->				
					</div> --}}
					<!--end::Card-->
				</div>
			</div>
		</div>
		<script>
			function getAdmitcardDetails(degid) {
				var url = "{{ route('applicantadmitcard') }}";
				var data = {degid:degid, viewAdmitCard:true};
				$.post(url, data, function (response) {
					$('#admitCardModal .modal-body').html(response);
				});
			}

			function previewAdmitCard(degid) {
				var url = "{{ route('getadmitcardholder') }}";
				var infoData = {degid:degid, viewAdmitCard:true};
				$.post(url, infoData, function(response) {
					$('#admitCardModal').html(response);
					$('#admitCardModal').modal('show');
					getAdmitcardDetails(degid);
				});
			}
			$('.viewAdmitCardBtn').on('click', function(e){
				e.preventDefault();
				var degid = $(this).data('degid');
				previewAdmitCard(degid);	
			});
		</script>
	@endif
@endsection

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
	var updatePercentage = '{{ $updatePercentage }}';

	Highcharts.chart('profileChart', {
		title: {
		  text: ''
		},
		subtitle: {
		  text: `<div style='font-size: 40px'>`+updatePercentage+`%</div> of Total`,
		  align: "center",
		  verticalAlign: "middle",
		  style: {
		    "textAlign": "center"
		  },
		  x: 0,
		  y: -2,
		  useHTML: true
		},
		series: [{
		  type: 'pie',
		  enableMouseTracking: false,
		  innerSize: '70%',
		  dataLabels: {
		    enabled: false
		  },
		  data: [{
		    y: 30
		  }, {
		    y: 50,
		    color: '#e3e3e3'
		  }]
		}]
	});
</script>

@endsection

