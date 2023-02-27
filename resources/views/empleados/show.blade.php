@extends('layouts.maindesign')

@section('css')
    
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Empleados</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('empleados.index')}}">Empleados</a></li>
                    <li class="breadcrumb-item active">Empleado</li>
                </ul>
            </div>
        </div>
    </div>

    @if (session()->has('info'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('info') }}
        </div>
    @endif

    @if ($errors->has('ci'))
    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert">&times;</button>
        {{ $errors->first('ci') }}
    </div>
    @endif

    @if ($errors->has('email'))
    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert">&times;</button>
        {{ $errors->first('email') }}
    </div>
    @endif

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
        

    <div class="card mb-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#"><img alt="Foto" src="{{asset('imgs/users/'.$empleado->user->foto)}}"></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{$empleado->nombre}} {{$empleado->paterno}} {{$empleado->materno}}</h3>
                                        {{-- <h6 class="text-muted">UI/UX Design Team</h6> --}}
                                        <small class="text-muted">{{$empleado->designacion->nombre}}</small>
                                        <div class="staff-id">Código Empleado : {{$empleado->codigo_empleado}}</div>
                                        <div class="small doj text-muted">Fecha de Registro : {{date('d/m/Y',strtotime($empleado->fecha_ingreso))}}</div>
                                        <small class="text-muted">Empresa : {{$empleado->empresa->nombre}}</small><br>
                                        <small class="text-muted">Departamento : {{$empleado->departamento->nombre}}</small><br>
                                        <small class="text-muted">Estado : {{$empleado->estado}}</small>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Teléfono/Celuar:</div>
                                            <div class="text">{{$empleado->fono}} / {{$empleado->cel}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Email:</div>
                                            <div class="text">{{$empleado->user->email}}</div>
                                        </li>
                                        <li>
                                            <div class="title">C.I.:</div>
                                            <div class="text">{{$empleado->ci}} {{$empleado->ci_exp}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Dirección:</div>
                                            <div class="text">{{$empleado->dir}}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pro-edit">
                            <a href="#" class="edit-icon" data-toggle="modal" data-target="#edit_empleado{{ $empleado->id }}"><i class="fa fa-edit"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('empleados.edit')

@endsection
@section('js')
    
@endsection
