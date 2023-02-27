@extends('layouts.maindesign')

@section('css')
    
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Usuarios</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i>Agregar Usuario</a>
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

   
    <div class="row staff-grid-row" id="lista_usuarios">
        @foreach($usuarios as $user)
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                    <a href="{{route('users.show',$user->id)}}" class="avatar"><img src="{{asset('imgs/users/'.$user->user->foto)}}" alt="Foto"></a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_user{{ $user->id }}"><i class="fa fa-edit m-r-5"></i> Editar</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_user{{ $user->id }}"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                    </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{route('users.show',$user->id)}}">{{$user->nombre}} {{$user->paterno}} {{$user->materno}}</a></h4>
                <div class="small text-muted">{{$user->user->tipo}}</div>
            </div>
        </div>
        @include('users.edit')
        @include('users.delete')
        @endforeach
    </div>

    @include('users.create')
    <input type="hidden" id="urlListaUsuarios" value="{{route('users.index')}}">

@endsection
@section('js')

<script>
    let lista_usuarios = $('#lista_usuarios');
    let txt_buscar = $('#txt_buscar');
    let btnBuscar = $('#btnBuscar');

    $(document).ready(function () {
        txt_buscar.on('change keyup',function(){
            listarUsuarios();
        });
        
        btnBuscar.click(function(){
            listarUsuarios();
        })
    });

    function listarUsuarios(){
        $.ajax({
            type: "GET",
            url: $('#urlListaUsuarios').val(),
            data: {
                texto : txt_buscar.val(),
            },
            dataType: "json",
            success: function (response) {
                lista_usuarios.html(response.html);
            }
        });
    }
</script> 

@endsection
