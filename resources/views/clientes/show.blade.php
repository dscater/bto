@extends('layouts.maindesign')

@section('css')
    
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Clientes</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('clientes.index')}}">Clientes</a></li>
                    <li class="breadcrumb-item active">Cliente</li>
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
                                <a href="#"><img alt="Foto" src="{{asset('imgs/clientes/'.$cliente->foto)}}"></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="cliente-name m-t-0 mb-0">{{$cliente->nombre}} {{$cliente->paterno}} {{$cliente->materno}}</h3>
                                        {{-- <h6 class="text-muted">UI/UX Design Team</h6> --}}
                                        <small class="text-muted">{{$cliente->empresa}}</small>
                                        <div class="small doj text-muted">Fecha de Registro : {{date('d/m/Y',strtotime($cliente->created_at))}}</div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Teléfono/Celuar:</div>
                                            <div class="text">{{$cliente->fono}} / {{$cliente->cel}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Email:</div>
                                            <div class="text">{{$cliente->email}}</div>
                                        </li>
                                        <li>
                                            <div class="title">C.I.:</div>
                                            <div class="text">{{$cliente->ci}} {{$cliente->ci_exp}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Dirección:</div>
                                            <div class="text">{{$cliente->dir}}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pro-edit">
                            <a href="#" class="edit-icon" data-toggle="modal" data-target="#edit_cliente{{ $cliente->id }}"><i class="fa fa-edit"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('clientes.edit')

@endsection
@section('js')
    
@endsection
