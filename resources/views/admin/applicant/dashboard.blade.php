@extends('admin.layouts.admin_designs')
@section('siteTitle')
विज्ञापन
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	@include('admin.layouts.alert')
	<!--begin::Toolbar-->
	<div class="toolbar" id="kt_toolbar" style="padding-top: 0px; background-color: #fff;">
		<!--begin::Container-->
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<!--begin::Page title-->
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend"
				data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
				class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<!--begin::Title-->
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Dashboard</h1>
				<!--end::Title-->
			</div>
			<!--end::Page title-->
		</div>
		<!--end::Container-->
	</div>
    
	<div class="post d-flex flex-column-fluid" id="kt_post" style="margin-top: 40px;">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card toolbar-->
					@foreach($summary as $row)
					<div class="card-toolbar">

						@if($row->appliedstatus=='Pending')
							<?php $color = "#90ee90"; ?>
						@elseif($row->appliedstatus=='Rejected')
							<?php $color = "#ff0000"; ?>
						@elseif($row->appliedstatus=='Incomplete')
							<?php $color = "#4CB5E3"; ?>
						@elseif($row->appliedstatus=='Verified')
							<?php $color = "green"; ?>
						@endif
                        <h1 class="d-flex fw-bolder fs-3 align-items-center my-1" style="color:{{$color}};">Total {{$row->appliedstatus}} ({{$row->total}}) </h1>
					</div>
					@endforeach
					<!--end::Card toolbar-->
				</div>
				<!--end::Card header-->

				<!--begin::Card body-->
				<div class="card-body p-0">
					<!--begin::Table-->
					<div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
						<div class="table_form">
							<table class="table-bordered table-striped table-condensed cf" id="registeredCandidatesTable"
								width="100%">
								<thead class="cf">
									<tr>
									<th>S.N.</th>
									<th>User Name</th>
									<th>Contact Number</th>
									<th>Email Address</th>
									<th>Label</th>
									<th>Task Details</th>
												</tr>
											</thead>
											<tbody>
												<?php $i = 1; ?>
												@foreach($userdetails as $key=>$rowd)
												<tr>
													<th>{{$i}}</th>
													<th>{{$rowd['fullname']}}</th>
													<th>{{$rowd['contactnumber']}}</th>
									<th>{{$rowd['email']}}</th>
									<th>{{$rowd['userlevel']}}</th>
									<th>
										@if(!empty($rowd['appliedstatus']))
											@foreach($rowd['appliedstatus'] as $keyd=>$rows)
												@if($keyd=='Pending')
													<?php $color = "#90ee90"; ?>
												@elseif($keyd=='Rejected')
													<?php $color = "#ff0000"; ?>
												@elseif($keyd=='Incomplete')
													<?php $color = "#4CB5E3"; ?>
												@elseif($keyd=='Verified')
													<?php $color = "green"; ?>
												@endif
												<span style="color:{{$color}};">
												{{$keyd}} ({{$rows}})</span> </br >
											@endforeach	
										@endif
										</th>
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
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
</div>
@endsection

@section('scripts')
@endsection