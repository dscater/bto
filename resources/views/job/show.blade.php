@extends('maindesign')

@section('cs')
  <!-- Bootstrap CSS -->
		<!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
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



  <div class="row">
    <div class="col-md-8">
      <div class="job-info job-widget">
        <h3 class="job-title">{{ $jobs->job_title}}</h3>
        <span class="job-dept">{{$jobs->departament->display_name}}</span>
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



        <div class="info-list">
          <span><i class="fa fa-bar-chart"></i></span>
          <h5>Job Type</h5>
          <p> {{$jobs->type_job}}</p>
        </div>
        <div class="info-list">
          <span><i class="fa fa-money"></i></span>
          <h5>Salary</h5>
          <p>${{ $jobs->salary_from}} - ${{$jobs->salary_to}}</p>
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





@endsection




@section('js')
  <!-- jQuery -->
  <script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
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
