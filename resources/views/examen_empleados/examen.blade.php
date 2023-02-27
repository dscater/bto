@extends('layouts.maindesign')

@section('css')
<link rel="stylesheet" href="{{asset('css/examen_empleados/examen.css')}}">
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Exámenes</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('examen_empleados.index',Auth::user()->empleado->id) }}">Exámenes</a></li>
                    <li class="breadcrumb-item active">Examen</li>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Evaluación Examen - {{$examen->nombre}}</h4>
                    {{Form::open(['method'=>'post','route'=>'examen_empleados.evaluacion_store', 'id'=>'formExamen'])}}
                    <input type="hidden" name="ei" value="{{$examen->id}}">
                    <input type="hidden" name="emi" value="{{Auth::user()->empleado->id}}">
                    @php
                        $cont = 1;
                    @endphp
                    @foreach($examen->preguntas as $pregunta)
                    <input type="hidden" name="pregunta[]" value="{{$pregunta->id}}">
                    <p><strong>{{$cont}}. {{$pregunta->descripcion}}</strong></p>
                    <p class="contenedor_preguntas">
                        <label>A) {{$pregunta->a}} <input type="radio" value="A" name="resp{{$pregunta->id}}" id=""></label> 
                        <label>B) {{$pregunta->b}} <input type="radio" value="B" name="resp{{$pregunta->id}}" id=""></label>
                        <label>C) {{$pregunta->c}} <input type="radio" value="C" name="resp{{$pregunta->id}}" id=""></label>
                        <label>D) {{$pregunta->d}} <input type="radio" value="D" name="resp{{$pregunta->id}}" id=""></label>    
                    </p>
                    @endforeach
                    {{Form::close()}}
                    <button type="button" class="btn btn-primary" id="btnConfirmaEnvio">Enviar Examen</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete designacion Modal -->
    <div class="modal custom-modal fade" id="enviar_examen" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Enviar Examen</h3>
                        <p>¿Estás seguro(a) de enviar el examen?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary continue-btn btn-block" type="button" id="btnEnviar"> Si, enviar</button>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-dismiss="modal"
                                    class="btn btn-primary cancel-btn">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
<script>
    let btnConfirmaEnvio = $('#btnConfirmaEnvio');
    let btnEnviar = $('#btnEnviar');
    let enviar_examen = $('#enviar_examen');
    $(document).ready(function () {
       btnConfirmaEnvio.click(function(){
           enviar_examen.modal('show')
       }); 

       btnEnviar.click(function(){
            formExamen.submit();
       });
    });
</script>
@endsection
