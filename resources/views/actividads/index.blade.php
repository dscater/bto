@extends('layouts.maindesign')

@section('css')
    
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Actividades / Tareas</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('actividads.index')}}">Actividades / Tareas</a></li>
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
            {{-- <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_empresa"><i class="fa fa-plus"></i>Agregar Empresa</a>
            </div> --}}
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
                            <th>Tareas</th>
                            <th class="text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $proyecto)
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="{{route('proyectos.show',$proyecto->id)}}">
                                            {{ $proyecto->nombre }}
                                        </a>
                                    </h2>
                                </td>
                                <td>{!! $proyecto->descripcion !!}</td>
                                <td>
                                    {{count($proyecto->actividads)}}
                                </td>
                                <td class="text-right">
                                    <a href="{{route('proyectos.show',$proyecto->id)}}" data-toggle="tooltip" title="Ver proyecto">
                                        <i class="fa fa-list-alt"></i>
                                    </a>
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
