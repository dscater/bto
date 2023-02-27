@extends('maindesign')
@section('cs')
	<link rel="stylesheet" href="{{asset('assets/admin/css/font-awesome.min.css')}}">
	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="{{asset('assets/admin/css/line-awesome.min.css')}}">
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{asset('assets/admin/css/dataTables.bootstrap4.min.css')}}">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/admin/css/select2.min.css')}}">
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-datetimepicker.min.css')}}">
	<!-- Main CSS -->
	<link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
@endsection
@section('content')
  <!-- Page Title -->
					<div class="row">
						<div class="col-sm-12">
							<h4 class="page-title">Job Applicants</h4>
						</div>
					</div>
					<!-- /Page Title -->
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Email</th>
											<th>CI</th>
											<th>Phone</th>
											<th>Apply Date</th>
											<th class="text-center">Status</th>
											<th>Resume</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($applicants as $applicant)
										<tr>
											<td>{{$applicant->id}}</td>
											<td>{{$applicant->name}}</td>
											<td>{{$applicant->email}}</td>
											<td>{{$applicant->ci}}
											<td>{{$applicant->phone}}</td>
											<td>{{$applicant->created_at}}</td>
											<td class="text-center">
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
														<i class="fa fa-dot-circle-o text-info"></i> New
													</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> New</a>
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Hired</a>
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Rejected</a>
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Interviewed</a>
													</div>
												</div>
											</td>
											<td><a href="{{ route('applicants.list',$applicant->id) }}" class="btn btn-sm btn-primary "> {{$applicant->contar}} Applications</a></td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#"><i class="fa fa-clock-o m-r-5"></i> Schedule Interview</a>
													</div>
												</div>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
@endsection

@section('js')
  <!-- jQuery -->
  <script src="{{asset('assets/admin/js/jquery-3.2.1.min.js')}}"></script>
  <!-- Bootstrap Core JS -->
  <script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
  <!-- Slimscroll JS -->
  <script src="{{asset('assets/admin/js/jquery.slimscroll.min.js')}}"></script>
  <!-- Select2 JS -->
  <script src="{{asset('assets/admin/js/select2.min.js')}}"></script>
  <!-- Datatable JS -->
  <script src="{{asset('assets/admin/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/dataTables.bootstrap4.min.js')}}"></script>
  <!-- Datetimepicker JS -->
  <script src="{{asset('assets/admin/js/moment.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/bootstrap-datetimepicker.min.js')}}"></script>
  <!-- Custom JS -->
  <script src="{{asset('assets/admin/js/app.js')}}"></script>
@endsection
