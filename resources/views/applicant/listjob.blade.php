@extends('maindesign')
@section('cs')
		<!-- Fontawesome CSS -->
    <!-- Bootstrap CSS -->
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
@endsection
@section('content')
            <div class="row">
  						<div class="col-sm-5 col-4">
  							<h4 class="page-title">User applications</h4>
  						</div>
  					</div>
            @if(session()->has('info'))
              <div class="alert alert-success">{{ session('info') }}</div>
            @endif
  					<!-- /Page Title -->
  					<div class="row">
  						<div class="col-md-12">
  							<div class="table-responsive">
  								<table class="table table-striped custom-table datatable" name="myTable" id="myTable">
  									<thead>
  										<tr>
                        <th>#</th>
  											<th>User Name</th>
  											<th>Job Title</th>
  											<th>Message</th>
  											<th>Start Date</th>
  											<th class="text-center" colspan="2">CV</th>
  											<th class="text-right">Actions</th>
  										</tr>
  									</thead>
  									<tbody>
                    @foreach ($applicants as $applicant)
                      <tr>
                        <td>{{$applicant->id }}</td>
  											<td>{{$applicant->name }}</td>
  											<td>{{$applicant->job_title}}</td>
  											<td>{{ $applicant->message }}</td>
  											<td>{{ $applicant->created_at }}</td>
                        <td>
                          <a data-toggle="modal"   data-target="#viewpdf{{$applicant->id}}"><i class="fa fa-pencil m-r-5"></i> View</a>
                        </td>
                        <td class="text-center">
                          <a href="{{ asset('images/applicants/')}}/{{$applicant->upload_cv}} "  download="BTO_{{$applicant->name}}_CV" class="btn btn-xs btn-primary"><i class="fa fa-download"></i> Download</a>
                        </td>

                        <td class="text-right">
  												<div class="dropdown dropdown-action">
  													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
  													<div class="dropdown-menu dropdown-menu-right">
  														<a href="#" data-toggle="modal" data-target="#CreateEvent{{$applicant->id}}"> Schedule Interview</a>
  													</div>
  												</div>
  											</td>
  										</tr>
										@include('applicant.NewEvent')
							      @include('applicant.viewpdf')
                    @endforeach
  									</tbody>
  								</table>
  							</div>
  						</div>
  					</div>
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
