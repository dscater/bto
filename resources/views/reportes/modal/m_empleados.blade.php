<div class="modal fade" id="m_empleados">
    <div class="modal-dialog">
        <div class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Lista de empleados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'reportes.empleados', 'method' => 'get', 'target' => '_blank', 'id' =>
                'formUsuarios']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Filtro:</label>
                            <select class="form-control" name="filtro" id="filtro">
                                <option value="todos">Todos</option>
                                <option value="empresa">Empresa</option>
                                <option value="departamento">Departamento</option>
                                <option value="designacion">Designación</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione:</label>
                            {{Form::select('empresa',$array_empresas,null,['class'=>'select','id'=> 'empresa'])}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione:</label>
                            {{Form::select('departamento',$array_departamentos,null,['class'=>'select','id'=> 'departamento'])}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione:</label>
                            {{Form::select('designacion',$array_designacions,null,['class'=>'select','id'=> 'designacion'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Generar reporte</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
