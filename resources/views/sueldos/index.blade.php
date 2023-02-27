@extends('layouts.maindesign')

@section('css')
    
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Administrar Sueldos</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('sueldos.index')}}">Administrar Sueldos</a></li>
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_sueldo"><i class="fa fa-plus"></i>Agregar Sueldo</a>
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
        <div class="alert alert-info">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('info') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
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
                            <th>Designación</th>
                            <th>Sueldo</th>
                            <th>Moneda</th>
                            <th>Tipo Pago</th>
                            <th>Fecha Registro</th>
                            <th class="text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sueldos as $sueldo)
                            <tr>
                                <td> 
                                    <h2 class="table-avatar">
                                        <a href="{{route('empleados.show',$sueldo->empleado->id)}}" class="avatar"><img src="{{asset('imgs/users/'.$sueldo->empleado->user->foto)}}" alt=""></a>
                                        <a href="{{route('empleados.show',$sueldo->empleado->id)}}">{{ $sueldo->empleado->nombre }}<span>{{ $sueldo->empleado->paterno }} {{ $sueldo->empleado->materno }}</span></a>
                                    </h2>
                                </td>
                                <td>{{$sueldo->empleado->designacion->nombre}}</td>
                                <td>{{$sueldo->sueldo}}</td>
                                <td>{{$sueldo->moneda}}</td>
                                <td>{{$sueldo->tipo_pago}}</td>
                                <td>{{$sueldo->fecha_registro}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit_sueldo{{ $sueldo->id }}"><i
                                                    class="fa fa-pencil m-r-5"></i> Editar</a>
                                            @if(Auth::user()->tipo == 'ADMINISTRADOR')
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete_sueldo{{ $sueldo->id }}"><i
                                                    class="fa fa-trash-o m-r-5"></i> Eliminar</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @include('sueldos.edit')
                            @include('sueldos.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('sueldos.create')

@endsection
@section('js')
    
@endsection
