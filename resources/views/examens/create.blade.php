<!-- Add examen Modal -->
<div id="add_examen" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Examen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form data-toggle="validator" role="form" action="{{ route('examens.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nombre Examen <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name='nombre' value="{{old('nombre')}}" required>
                            </div>
                        </div>

						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Empresa <span class="text-danger">*</span></label>
                                {{Form::select('empresa_id',$array_empresas,null,['class'=>'select form-control','required'])}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Departamento <span class="text-danger">*</span></label>
                                {{Form::select('departamento_id',$array_departamentos,null,['class'=>'select form-control','required'])}}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Designación <span class="text-danger">*</span></label>
                                {{Form::select('designacion_id',$array_designacions,null,['class'=>'select form-control','required'])}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h3 styl="text-align:center;">Preguntas</h3>
                        <div class="col-md-12 mb-3">
                            <button type="button" class="btn btn-secondary btn-sm" id="btnAgregarCreate">Agregar</button>
                        </div>
                        <div class="col-md-12">
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
                                <tbody id="bodyCreate">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
						<div class="col-sm-12">
							<div class="submit-section">
								<button class="btn btn-primary submit-btn" type="submit" id="btnGuardarCreate"><i class="fa fa-save"></i> Guardar</button>
							</div>
						</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add examen Modal -->
