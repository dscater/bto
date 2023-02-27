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
		<link rel="stylesheet" href="assets/admin/css/select2.min.css">
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets/admin/css/bootstrap-datetimepicker.min.css">
		<!-- Main CSS -->
          <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="assets/admin/css/style.css">


@endsection

@section('content')
            <div class="row">
  						<div class="col-sm-5 col-4">
  							<h4 class="page-title">Jobs</h4>
  						</div>
  						<div class="col-sm-7 col-8 text-right m-b-30">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_job"><i class="fa fa-plus"></i> Add Job</a>
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#CreateEvent"><i class="fa fa-plus"></i> New Event</a>
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#CreateDepartament"><i class="fa fa-plus"></i> New Departament</a>
  						</div>
  					</div>
            @if(session()->has('info'))
             <div class="alert alert-success">{{ session('info') }}</div>
            @endif
  					<!-- /Page Title -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" id="myInput" onkeyup="myFunction()" class="form-control floating" >
                        <label class="focus-label">Job ID</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" id="myInput2" onkeyup="myFunction2()" class="form-control floating" >
                        <label class="focus-label">Job title Name</label>
                    </div>
                </div>
            </div>
  					<div class="row">
  						<div class="col-md-12">
  							<div class="table-responsive">
  								<table class="table table-striped custom-table datatable" name="myTable" id="myTable">
  									<thead>
  										<tr>
  											<th>#</th>
  											<th>Job Title</th>
  											<th>Department</th>
  											<th>Start Date</th>
  											<th>Expire Date</th>
  											<th class="text-center">Job Type</th>
  											<th class="text-center">Status</th>
  											<th>Applicants</th>
  											<th class="text-right">Actions</th>
  										</tr>
  									</thead>
  									<tbody>
                    @foreach ($jobs as $job)
                      <tr>
  											<td>{{ $job->id }}</td>
  											<td><a href="{{ route('job.show',$job->id)}}">{{ $job->job_title }}</a></td>
  											<td>{{ $job->display_name}}</td>
  											<td>{{ $job->start_date }}</td>
  											<td>{{ $job->experied_date }}</td>
  											<td class="text-center">
                                @if($job->type_job=='Full Time' )
  														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Full Time</a>
                              @endif
  														  @if($job->type_job=='Part Time' )
                                  <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Part Time</a>
                                  @endif
                                  @if($job->type_job=='Internship' )
                              <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Internship</a>
                              @endif
                              @if($job->type_job=='Temporary' )
                              <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-warning"></i> Temporary</a>
                              @endif
                                @if($job->type_job=='Others' )
                                  <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Others</a>
  													  @endif
                              @if($job->type_job=='Remote' )
                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-warning"></i> Remote</a>
                            @endif

  											</td>
  											<td class="text-center">
  												<div class="dropdown action-label">
                            @if($job->status=='Closed' )
                          <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Closed</a>
                            @endif
                            @if($job->status=='Open' )
                          	<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Open</a>
                            @endif
                            @if($job->status=='Cancelled' )
                            	<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Cancelled</a>
                            @endif
  												</div>
  											</td>
                        	<td><a href="{{route('applicant.show',$job->id)}}" class="btn btn-sm btn-primary"> Candidates</a>


                          </td>
                        <td class="text-right">
  												<div class="dropdown dropdown-action">
  													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
  													<div class="dropdown-menu dropdown-menu-right">
  														<a class="dropdown-item" data-toggle="modal" data-target="#edit_job{{$job->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                              <a href="#" class="dropdown-item" data-toggle="modal" data-target="#delete_job{{$job->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
  													</div>
  												</div>
  											</td>
  										</tr>

                      @include('job.edit')
                      @include('job.delete')
                    @endforeach
                    @include('job.events.newEvent')
                    @include('job.events.newDepartament')

  									</tbody>
  								</table>

  							</div>
  						</div>
  					</div>


  				<!-- /Page Content -->
          @include('job.create')
          {{-- Con este condicional abrimos el modal si hay un error de validacion en el backend --}}

          <script>
              function myFunction() {
                  var input, filter, table, tr, td, i, txtValue;
                  input = document.getElementById('myInput');
                  filter = input.value.toUpperCase();
                  table = document.getElementById("myTable");
                  tr = table.getElementsByTagName("tr");
                  for (i = 0; i < tr.length; i++) {
                      td = tr[i].getElementsByTagName("td")[0];
                      if (td) {
                          txtValue = td.textContent || td.innerText;
                          if (txtValue.toUpperCase().indexOf(filter) > -1) {
                              tr[i].style.display = "";
                          } else {
                              tr[i].style.display = "none";
                          }
                      }
                  }
              }


              function myFunction2() {
                  var input, filter, table, tr, td, i, txtValue;
                  input = document.getElementById('myInput2');
                  filter = input.value.toUpperCase();
                  table = document.getElementById("myTable");
                  tr = table.getElementsByTagName("tr");
                  for (i = 0; i < tr.length; i++) {
                      td = tr[i].getElementsByTagName("td")[1];
                      if (td) {
                          txtValue = td.textContent || td.innerText;
                          if (txtValue.toUpperCase().indexOf(filter) > -1) {
                              tr[i].style.display = "";
                          } else {
                              tr[i].style.display = "none";
                          }
                      }
                  }
              }
              document.getElementById('job_title').onchange = function() {
              window.location.href = this.children[this.selectedIndex].getAttribute('href');
            }

          </script>



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
  <script src="assets/admin/js/select2.min.js"></script>

  <!-- Datatable JS -->
  <script src="assets/admin/js/jquery.dataTables.min.js"></script>
  <script src="assets/admin/js/dataTables.bootstrap4.min.js"></script>
  <!-- Datetimepicker JS -->
  <script src="assets/admin/js/moment.min.js"></script>
  <script src="assets/admin/js/bootstrap-datetimepicker.min.js"></script>
  <!-- Custom JS -->
  <script src="assets/admin/js/app.js"></script>
  <script src="{{ asset('js/script.js') }}"></script>

@endsection
