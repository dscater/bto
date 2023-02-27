@extends('layouts.maindesign')

@section('css')
    
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Departamentos</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('departamentos.index')}}">Departamentos</a></li>
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_departamento"><i class="fa fa-plus"></i>Agregar Departamento</a>
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
                            <th>Descripción</th>
                            <th class="text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departamentos as $departamento)
                            <tr>
                                <td>{{ $departamento->nombre }}</td>
                                <td>{{ $departamento->descripcion }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit_departamento{{ $departamento->id }}"><i
                                                    class="fa fa-pencil m-r-5"></i> Editar</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete_departamento{{ $departamento->id }}"><i
                                                    class="fa fa-trash-o m-r-5"></i> Eliminar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @include('departamentos.edit')
                            @include('departamentos.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('departamentos.create')

    <script>     
    </script>

@endsection
@section('js')
    
@endsection
