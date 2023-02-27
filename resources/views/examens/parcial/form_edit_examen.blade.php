{!! method_field('PUT') !!}
{!! csrf_field() !!}
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Nombre Examen <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name='nombre' value="{{$examen->nombre}}" required>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Empresa <span class="text-danger">*</span></label>
            {{Form::select('empresa_id',$array_empresas,$examen->empresa_id,['class'=>'select form-control','required'])}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Departamento <span class="text-danger">*</span></label>
            {{Form::select('departamento_id',$array_departamentos,$examen->departamento_id,['class'=>'select form-control','required'])}}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Designación <span class="text-danger">*</span></label>
            {{Form::select('designacion_id',$array_designacions,$examen->designacion_id,['class'=>'select form-control','required'])}}
        </div>
    </div>
</div>

<div class="row cont_preguntas_row">
    <h3 styl="text-align:center;">Preguntas</h3>
    <div class="col-md-12 mb-3">
        <button type="button" class="btn btn-secondary btn-sm btnAgregarEdit">Agregar</button>
    </div>
    <div class="col-md-12 cont_preguntas_edit" id="cont_preguntas_edit{{$examen->id}}">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripción</th>
                    <th>Opción A</th>
                    <th>Opción B</th>
                    <th>Opción C</th>
                    <th>Opción D</th>
                    <th>Valor</th>
                    <th>Respuesta</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="bodyCreate">
                @php
                    $cont = 1;
                @endphp
                @foreach($examen->preguntas as $pregunta)
                <tr class="pregunta existe">
                    <td>{{$cont++}}</td>
                    <td class="descripcion editable">
                        <input type="text" name="descripcion_p" value="{{$pregunta->descripcion}}" data-urlU ="{{route('preguntas.update',$pregunta->id)}}" data-col="descripcion" class="form-control" required>
                    </td>
                    <td class="oA editable">
                        <input type="text" name="opcionA_p" value="{{$pregunta->a}}" data-urlU ="{{route('preguntas.update',$pregunta->id)}}" data-col="a" class="form-control" required>
                    </td>
                    <td class="oB editable">
                        <input type="text" name="opcionB_p" value="{{$pregunta->b}}" data-urlU ="{{route('preguntas.update',$pregunta->id)}}" data-col="b" class="form-control" required>
                    </td>
                    <td class="oC editable">
                        <input type="text" name="opcionC_p" value="{{$pregunta->c}}" data-urlU ="{{route('preguntas.update',$pregunta->id)}}" data-col="c" class="form-control" required>
                    </td>
                    <td class="oD editable">
                        <input type="text" name="opcionD_p" value="{{$pregunta->d}}" data-urlU ="{{route('preguntas.update',$pregunta->id)}}" data-col="d" class="form-control" required>
                    </td>
                    <td class="valor editable">
                        <input type="number" name="valor_p" value="{{$pregunta->valor}}" data-urlU ="{{route('preguntas.update',$pregunta->id)}}" data-col="valor" class="form-control" required>
                    </td>
                    <td class="resp editable">
                        {{Form::select('respuesta[]',[
                            'A' => 'A',
                            'B' => 'B',
                            'C' => 'C',
                            'D' => 'D',
                        ],$pregunta->respuesta,['class'=>'select form-control','required','data-urlU'=>route('preguntas.update',$pregunta->id),'data-col'=>'respuesta'])}}
                    </td>
                    <td class="opcion">
                        <span class="eliminar" title="Eliminar Fila" data-urlD="{{route('preguntas.destroy',$pregunta->id)}}"><i class="fa fa-trash"></i></span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="submit-section">
            <button class="btn btn-primary submit-btn btnGuardarEdit"><i class="fa fa-spin"></i> Actualizar</button>
        </div>
    </div>
</div>