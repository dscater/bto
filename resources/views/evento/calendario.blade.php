@extends('maindesign')
@section('cs')
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
  <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">

 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
 <link href="https://fonts.googleapis.com/css?family=Exo&display=swap" rel="stylesheet">
<style>
 body{
   font-family: 'Exo', sans-serif;
 }
 .header-col{
   background: #E3E9E5;
   color:#536170;
   text-align: center;
   font-size: 20px;
   font-weight: bold;
 }
 .header-calendar{
   background: #764ba2;color:white;
 }
 .box-day{
   border:1px solid #E3E9E5;
   height:150px;
 }
 .box-dayoff{
   border:1px solid #E3E9E5;
   height:150px;
   background-color: #ccd1ce;
 }
 </style>
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-sm-5 col-4">
          <h4 class="page-title">
          Interview Schedule
          </h4>

       </div>

        <div class="col-sm-7 col-8 text-right m-b-30">
          <a href="#" class="btn add-btn" data-toggle="modal" data-target="#CreateEvent"><i class="fa fa-plus"></i> New Event</a>
        </div>
      </div>
      @if(session()->has('info'))
      <div class="alert alert-success">{{ session('info') }}</div>
      @endif
    <div class="row header-calendar"  >
      <div class="col" style="display: flex; justify-content: space-between; padding: 10px;">
        <a  href="{{ asset('/Evento/index/') }}/<?= $data['last']; ?>" style="margin:10px;">
          <i class="fas fa-chevron-circle-left" style="font-size:30px;color:white;"></i>
        </a>
        <h2 style="font-weight:bold;margin:10px;"><?= $mespanish; ?> <small><?= $data['year']; ?></small></h2>
        <a  href="{{ asset('/Evento/index/') }}/<?= $data['next']; ?>" style="margin:10px;">
          <i class="fas fa-chevron-circle-right" style="font-size:30px;color:white;"></i>
        </a>
      </div>
    </div>
      <div class="row">
        <div class="col header-col">Monday</div>
        <div class="col header-col">Tuesday</div>
        <div class="col header-col">Wednesday</div>
        <div class="col header-col">Thursday</div>
        <div class="col header-col">Friday</div>
        <div class="col header-col">Saturday</div>
        <div class="col header-col">Sunday</div>
      </div>
      @foreach ($data['calendar'] as $weekdata)
        <div class="row">
          <!-- ciclo de dia por semana -->
          @foreach  ($weekdata['datos'] as $dayweek)

          @if  ($dayweek['mes']==$mes)
            <div class="col box-day">
              {{ $dayweek['dia']  }}
              <!-- evento -->
              @foreach  ($dayweek['evento'] as $event)
                  <td class="text-right">
                    <div class="dropdown dropdown-action">
                      <a href="#" class="" data-toggle="dropdown" aria-expanded="false">{{$event->titulo}}</a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#Details{{$event->id}}">Show </a>
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit_event{{$event->id}}">Edit</a>
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#delete_event{{$event->id}}"> Delete</a>
                      </div>
                    </div>
                  </td>
                  @include('evento.edit')
                  @include('evento.details')
                  @include('evento.delete')
              @endforeach
            </div>
          @else
          <div class="col box-dayoff">
          </div>
          @endif
    @endforeach
        </div>
      @endforeach
    </div> <!-- /container -->
    @include('evento.create')
  @endsection
  @section('js')
  <script src="{{asset('assets/admin/js/jquery-3.2.1.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/jquery.slimscroll.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/app.js')}}"></script>
@endsection
