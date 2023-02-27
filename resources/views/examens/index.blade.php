@extends('layouts.maindesign')

@section('css')
    <link rel="stylesheet" href="{{asset('css/examens/index.css')}}">
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Exámenes</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('examens.index')}}">Exámenes</a></li>
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_examen"><i class="fa fa-plus"></i>Agregar Examen</a>
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
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Departamento</th>
                            <th>Designación</th>
                            <th class="text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="lista_examenes">
                        @foreach ($examens as $examen)
                            <tr>
                                <td>{{ $examen->nombre }}</td>
                                <td>{{ $examen->empresa->nombre }}</td>
                                <td>{{ $examen->departamento->nombre }}</td>
                                <td>{{ $examen->designacion->nombre }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item edit" href="#" data-toggle="modal"
                                                data-target="#edit_examen" data-id="{{$examen->id}}" data-url="{{route('examens.form_examen_edit')}}" data-urlEU="{{route('examens.update',$examen->id)}}"><i
                                                    class="fa fa-pencil m-r-5"></i> Editar</a>
                                            @if(Auth::user()->tipo == 'ADMINISTRADOR')
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete_examen{{ $examen->id }}"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @include('examens.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('examens.edit')

    @include('examens.create')

    <script>     
    </script>

@endsection
@section('js')
    <script src="{{asset('js/examens/index.js')}}"></script>
@endsection
