@extends('layouts.maindesign')

@section('css')
    
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Designaciones</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('designacions.index')}}">Designaciones</a></li>
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_designacion"><i class="fa fa-plus"></i>Agregar Designación</a>
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
                        @foreach ($designacions as $designacion)
                            <tr>
                                <td>{{ $designacion->nombre }}</td>
                                <td>{{ $designacion->descripcion }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit_designacion{{ $designacion->id }}"><i
                                                    class="fa fa-pencil m-r-5"></i> Editar</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete_designacion{{ $designacion->id }}"><i
                                                    class="fa fa-trash-o m-r-5"></i> Eliminar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @include('designacions.edit')
                            @include('designacions.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('designacions.create')

    <script>     
    </script>

@endsection
@section('js')
    
@endsection
