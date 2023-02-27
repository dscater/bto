<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Jobs - HRMS admin template</title>
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/admin/img/favicon.png')}}">
        <!-- Bootstrap CSS -->
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
    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}"  >
        <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/admin/js/html5shiv.min.js"></script>
			<script src="assets/admin/js/respond.min.js"></script>

		<![endif]-->

    </head>
    <body>

		<!-- Main Wrapper -->
        <div class="main-wrapper">

			<!-- Header -->
            <div class="header">

				<!-- Logo -->
                <div class="header-left">
                    <a href="index.html" class="logo">
						<img src="{{asset('assets/admin/img/logo.png')}}" width="40" height="40" alt="">
					</a>
                </div>
				<!-- /Logo -->

				<!-- Header Title -->
                <div class="page-title-box float-left">
					<h3>Bolivian technology outsourcing</h3>
                </div>
				<!-- /Header Title -->

				<!-- Header Menu -->
        @if(!auth()->check())
       <ul class="nav user-menu">
         <li class="nav-item">
           <a class="dropdown-item" href="{{route('dashboard')}}">Login</a>
         </li>
         <li class="nav-item">
             <a href="#" class="dropdown-item" data-toggle="modal" data-target="#add_user"> Register</a>
         </li>
       </ul>
       @else
         <ul class="nav user-menu">
       <li class="nav-item dropdown has-arrow main-drop">
         <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

           <span>{{ auth()->user()->email }}</span>
           <span class="user-img"><img src="{{asset('/images/usuarios')}}/{{ auth()->user()->picture}}"  alt="">
           <span class="status online"></span></span>

         </a>
         <div class="dropdown-menu">
           <a class="dropdown-item" href="profile.html">My Profile</a>
           <a class="dropdown-item" href="settings.html">Settings</a>
           <a class="dropdown-item" href="{{ route('logout') }}" >Logout</a>
         </div>
       </li>
     </ul>
     @endif
				<!-- /Header Menu -->

				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">



					</div>
				</div>
				<!-- /Mobile Menu -->

            </div>
			<!-- /Header -->

			<!-- Page Wrapper -->
            <div class="page-wrapper job-wrapper">

				<!-- Page Content -->
                <div class="content container">

					<!-- Page Title -->
					<div class="row">
						<div class="col-sm-12">
							<h4 class="page-title">Jobs</h4>
						</div>
					</div>
					<!-- /Page Title -->
          @if(session()->has('info'))
            <div class="alert alert-success">{{ session('info') }}</div>
          @endif
					<div class="row">
            @foreach ($jobs as $job)
            <div class="col-md-6">
							<a class="job-list" href="{{ route('job.listfull',$job->id)}}">
								<div class="job-list-det">
									<div class="job-list-desc">
										<h3 class="job-list-title">{{$job->job_title}}</h3>
										<h4 class="job-department">{{$job->departament->display_name}}</h4>
									</div>
                <div class="job-type-info">
          				<span class="job-types">{{$job->type_job}}</span>
							  </div>

								</div>
								<div class="job-list-footer">
									<ul>
										<li><i class="fa fa-map-signs"></i>{{ $job->job_location}}</li>
										<li><i class="fa fa-money"></i> ${{ $job->salary_from }}-$ {{ $job->salary_to }}</li>
										<li><i class="fa fa-clock-o"></i> {{ $job->created_at->diffForHumans() }}</li>
									</ul>
								</div>
							</a>
						</div>

            @endforeach
					</div>
          {!! $jobs->render() !!}
                </div>
            </div>
			<!-- /Page Wrapper -->
        </div>
               @include('applicant.create')
		<!-- /Main Wrapper -->
		<!-- Sidebar Overlay -->
		<div class="sidebar-overlay" data-reff=""></div>
		<!-- jQuery -->
    <script src="{{asset('assets/admin/js/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap Core JS -->
    <script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
<!-- Custom JS -->
    <script src="{{asset('assets/admin/js/app.js')}}"></script>
  <script src="{{asset('assets/admin/js/select2.min.js')}}"></script>
  <script src="{{asset('assets/validate/dist/bootstrap-validate.js')}}"></script>

    </body>
</html>
