@extends('layouts.maindesign')

@section('css')

@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Exámenes</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('examen_empleados.index',$empleado->id) }}">Exámenes</a></li>
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
        </div>
    </div>

    @if (session('bien'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('bien') }}
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('info') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('error') }}
        </div>
    @endif

    <!-- /Search Filter -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Exámenes Pendientes</h4>

                    <div class="row">
                        @foreach($examens as $examen)
                        @php
                            $preguntas = App\Pregunta::where('examen_id',$examen->id)->get();
                            $total_puntaje = App\Pregunta::where('examen_id',$examen->id)->sum('preguntas.valor');
                        @endphp
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body bg-primary text-white">
                                    <a href="{{route('examen_empleados.evaluacion',$examen->id)}}" class="card-title text-white">{{$examen->nombre}}</a><br><br>
                                    <span><strong>Nro. Preguntas</strong>: {{count($preguntas)}}</span><br>
                                    <span><strong>Evaluado sobre</strong>: {{$total_puntaje}}</span><br>
                                    <a href="{{route('examen_empleados.evaluacion',$examen->id)}}" class="btn btn-sm btn-secondary mr-auto ml-auto">Ir al examen</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Exámenes Completos</h4>
                    <div class="row">
                        @foreach($completos as $examen)
                        @php
                            $preguntas = App\Pregunta::where('examen_id',$examen->examen_id)->get();
                            $total_puntaje = App\Pregunta::where('examen_id',$examen->examen_id)->sum('preguntas.valor');
                        @endphp
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body bg-primary text-white">
                                    <h4 class="card-title text-white">{{$examen->examen->nombre}}</h4>
                                    <span><strong>Resultado</strong>: {{$examen->resultado}} / {{$total_puntaje}}</span><br>
                                    <span><strong>Nro. Preguntas</strong>: {{count($preguntas)}}</span><br>
                                    <span><strong>Fecha Evaluación</strong>: {{date('d/m/Y',strtotime($examen->fecha))}}</span><br>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

@endsection
