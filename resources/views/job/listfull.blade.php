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
            <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}"  >

		<!-- Fontawesome CSS -->
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

        <link href="{{asset('/toastr/build/toastr.min.css')}}" rel="stylesheet">
        <script type="text/javascript" src="{{asset('/toastr/toastr.js')}}"></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- Bootstropa validate -->
    <!--toastr -->

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
                    <a href="#" class="logo">

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
                @if(session()->has('info'))
                  <div class="alert alert-success">{{ session('info') }}</div>
                @endif

        <div class="row">
          <div class="col-md-8">
            <div class="job-info job-widget">
              <h3 class="job-title">{{ $jobs->job_title}}</h3>
              <span class="job-dept">{{$jobs->job_department}}</span>
              <ul class="job-post-det">
                <li><i class="fa fa-calendar"></i> Post Date: <span class="text-blue">{{ $jobs->start_date}}</span></li>
                <li><i class="fa fa-calendar"></i> Last Date: <span class="text-blue">{{ $jobs->experied_date}}</span></li>
                <li><i class="fa fa-user-o"></i> Applications: <span class="text-blue">{{$counts}}</span></li>
                <li><i class="fa fa-eye"></i> Views: <span class="text-blue">3806</span></li>
              </ul>
            </div>
            <div class="job-content job-widget">
              <div class="job-desc-title"><h4>Job Description</h4></div>
              <div class="job-description">
                <p>
                  {{ $jobs->description}}
                </p>
                  </div>

            </div>
          </div>
          <div class="col-md-4">
            <div class="job-det-info job-widget">


                @if(auth()->check())

                    @if($confirmation==false)
                      <a class="btn job-btn" href="{{ route('applicant.create','$jobs->job_id') }}" data-toggle="modal" data-target="#apply_job{{$jobs->id}}">Apply For This Job</a>
                    @else
                      <a class="btn job-btn" href="#" data-toggle="modal" data-target="#">Reply Sent</a>
                    @endif
                @else
                      <a href="#" class="btn job-btn" data-toggle="modal" data-target="#add_user"> Register</a>
                @endif
              <div class="info-list">
                <span><i class="fa fa-bar-chart"></i></span>
                <h5>Job Type</h5>
                <p> {{$jobs->type_job}}</p>
              </div>
              <div class="info-list">
                <span><i class="fa fa-money"></i></span>
                <h5>Salary</h5>
                <p>${{ $jobs->salary_from}}k - ${{$jobs->salary_to}}k</p>
              </div>
              <div class="info-list">
                <span><i class="fa fa-suitcase"></i></span>
                <h5>Experience</h5>  <p>{{ $jobs->experience}} Years</p>
              </div>

              <div class="info-list">
                <span><i class="fa fa-ticket"></i></span>
                <h5>Vacancy</h5>
                <p>{{$jobs->num_vacancies}}</p>
              </div>
              <div class="info-list">
                <span><i class="fa fa-map-signs"></i></span>
                <h5>Location</h5>
                <p> {{ $jobs->job_location}}
                <br> 3864 Quiet Valley Lane,
                <br> Sherman Oaks,
                <br> California, 91403</p>
              </div>
              <div class="info-list">
                <p> 818-978-7102
                <br> admin@admin.com
                <br> https://www.bto_system.com
                </p>
              </div>
              <div class="info-list text-center">

                <a class="app-ends" href="#">Application ends in {{$jobs->created_at->diffInDays(now()) }}d</a>
              </div>
            </div>
          </div>
        </div>
              </div>
      <!-- /Page Content -->
				<!-- Apply Job Modal -->
				<div class="modal custom-modal fade" id="apply_job{{ $jobs->id }}" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Your Details</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action ="{{ route('applicant.guardPost', ['job_id' => $jobs->id] )}}" method="post" enctype="multipart/form-data">
                {{ csrf_field()}}
									<div class="form-group">
										<label for="message">Message</label>
										<textarea class="form-control" id="message" name='message' required></textarea>
									</div>
									<div class="form-group">
										<label>Upload your CV</label>
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="upload_cv" name="upload_cv" onchange="return fileValidation()" required >
											<label class="custom-file-label" for="cv_upload">Choose file</label>
										</div>
									</div>

									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type='submit' >Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Apply Job Modal -->
        @include('applicant.create')

        <script>

        function fileValidation(){
            var fileInput = document.getElementById('upload_cv');
            var filePath = fileInput.value;
            var allowedExtensions = /(.pdf)$/i;
            if(!allowedExtensions.exec(filePath)){
                alert('Please upload file having extensions .pdf only.');
                fileInput.value = '';
                return false;
            }else{
                //Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
        </script>


            </div>
			<!-- /Page Wrapper -->
        </div>
		<!-- /Main Wrapper -->
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
