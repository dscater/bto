@extends('layouts.maindesign')

@section('css')
    
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Horarios</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('horarios.index')}}">Horarios</a></li>
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_horario"><i class="fa fa-plus"></i>Agregar Horario</a>
            </div>
        </div>
    </div>

    @if(session('bien'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('bien') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('info') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('error') }}
        </div>
    @endif

    <!-- /Search Filter -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table datatable" name='myTable' id='myTable'>
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th class="text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                            <tr>
                                <td> 
                                    <h2 class="table-avatar">
                                        <a href="{{route('horarios.horarios_empleado',$empleado->id)}}" class="avatar"><img src="{{asset('imgs/users/'.$empleado->user->foto)}}" alt=""></a>
                                        <a href="{{route('horarios.horarios_empleado',$empleado->id)}}">{{ $empleado->nombre }}<span>{{ $empleado->paterno }} {{ $empleado->materno }}</span></a>
                                    </h2>
                                </td>
                                <td class="text-right">
                                    <a href="{{route('horarios.horarios_empleado',$empleado->id)}}" class="text-blue" title="Horarios"><i class="fa fa-list"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>     
    </script>

@endsection
@section('js')
    
@endsection
