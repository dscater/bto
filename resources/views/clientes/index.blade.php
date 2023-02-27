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
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_cliente"><i class="fa fa-plus"></i>Agregar Cliente</a>
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

    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">  
            <div class="form-group form-focus">
                <input type="text" class="form-control floating" id="txt_buscar">
                <label class="focus-label">Nombre</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">  
            <button type="button" id="btnBuscar" class="btn btn-success btn-block"> Buscar </button>  
        </div>     
    </div>

   
    <div class="row staff-grid-row" id="lista_clientes">
        @foreach($clientes as $cliente)
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                    <a href="{{route('clientes.show',$cliente->id)}}" class="avatar"><img src="{{asset('imgs/clientes/'.$cliente->foto)}}" alt="Foto"></a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_cliente{{ $cliente->id }}"><i class="fa fa-edit m-r-5"></i> Editar</a>
                        @if(Auth::user()->tipo == 'ADMINISTRADOR')
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_cliente{{ $cliente->id }}"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                        @endif
                    </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{route('clientes.show',$cliente->id)}}">{{$cliente->nombre}} {{$cliente->apellidos}}</a></h4>
                <div class="small text-muted">{{$cliente->empresa}}</div>
            </div>
        </div>
        @include('clientes.edit')
        @include('clientes.delete')
        @endforeach
    </div>

    @include('clientes.create')
    <input type="hidden" id="urlListaclientes" value="{{route('clientes.index')}}">

@endsection
@section('js')

<script>
    let lista_clientes = $('#lista_clientes');
    let txt_buscar = $('#txt_buscar');
    let btnBuscar = $('#btnBuscar');

    $(document).ready(function () {
        txt_buscar.on('change keyup',function(){
            listarclientes();
        });
        
        btnBuscar.click(function(){
            listarclientes();
        })
    });

    function listarclientes(){
        $.ajax({
            type: "GET",
            url: $('#urlListaclientes').val(),
            data: {
                texto : txt_buscar.val(),
            },
            dataType: "json",
            success: function (response) {
                lista_clientes.html(response.html);
            }
        });
    }
</script> 

@endsection
