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
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_empleado"><i class="fa fa-plus"></i>Agregar Empleado</a>
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
                <label class="focus-label">Código / Nombre Empleado</label>
            </div>
        </div>
        {{-- <div class="col-sm-6 col-md-3"> 
            <div class="form-group form-focus select-focus focused">
                <select class="select floating select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true"> 
                    <option data-select2-id="3">Select Company</option>
                    <option>Global Technologies</option>
                    <option>Delta Infotech</option>
                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-5fru-container"><span class="select2-selection__rendered" id="select2-5fru-container" role="textbox" aria-readonly="true" title="Select Company">Select Company</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                <label class="focus-label">Company</label>
            </div>
        </div> --}}
        <div class="col-sm-6 col-md-3">  
            <button type="button" id="btnBuscar" class="btn btn-success btn-block"> Buscar </button>  
        </div>     
    </div>

    <div class="row staff-grid-row" id="lista_empleados">
        @foreach($empleados as $empleado)
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                    <a href="{{route('empleados.show',$empleado->id)}}" class="avatar"><img src="{{asset('imgs/users/'.$empleado->user->foto)}}" alt="Foto"></a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_empleado{{ $empleado->id }}"><i class="fa fa-edit m-r-5"></i> Editar</a>
                        @if(Auth::user()->tipo == 'ADMINISTRADOR')
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_empleado{{ $empleado->id }}"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                        @endif
                    </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{route('empleados.show',$empleado->id)}}">{{$empleado->nombre}} {{$empleado->paterno}} {{$empleado->materno}}</a></h4>
                <div class="small text-muted">{{$empleado->designacion->nombre}}</div>
            </div>
        </div>
        @include('empleados.edit')
        @include('empleados.delete')
        @endforeach
    </div>

    @include('empleados.create')

    <input type="hidden" id="urlListaEmpleados" value="{{route('empleados.index')}}">
@endsection
@section('js')
    <script>
        let lista_empleados = $('#lista_empleados');
        let txt_buscar = $('#txt_buscar');
        let btnBuscar = $('#btnBuscar');

        $(document).ready(function () {
            txt_buscar.on('change keyup',function(){
                listarEmpleados();
            });
            
            btnBuscar.click(function(){
                listarEmpleados();
            })
        });

        function listarEmpleados(){
            $.ajax({
                type: "GET",
                url: $('#urlListaEmpleados').val(),
                data: {
                    texto : txt_buscar.val(),
                },
                dataType: "json",
                success: function (response) {
                    lista_empleados.html(response.html);
                }
            });
        }
    </script>    
@endsection
