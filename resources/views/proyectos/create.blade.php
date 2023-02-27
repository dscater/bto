<!-- Add User Modal -->
<div id="add_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Proyecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form data-toggle="validator" role="form" action="{{ route('proyectos.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nombre Proyecto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Cliente <span class="text-danger">*</span></label>
                                {{Form::select('cliente_id',$array_clientes,null,['class'=>'select form-control', 'required'])}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de Inicio <span class="text-danger">*</span></label>
                                <input type="text" name="fecha_ini" class="form-control datetimepicker" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de Finalización <span class="text-danger">*</span></label>
                                <input type="text" name="fecha_fin" class="form-control datetimepicker" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tarifa <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="tarifa" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Prioridad <span class="text-danger">*</span></label>
                                {{Form::select('prioridad',[
                                    '' => 'Seleccione...',
                                    'ALTO' => 'ALTO',
                                    'MEDIO' => 'MEDIO',
                                    'BAJO' => 'BAJO'
                                ],null,['class'=>'select form-control','required'])}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Elegir lider Proyecto <span class="text-danger">*</span></label>
                                {{Form::select('lider_proyecto',$array_empleados,null,['class'=>'select form-control','id' => 's_lider_proyecto_create','required'])}}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Lider del Proyecto</label>
                                <div class="project-members" id="lider_proyecto_create">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Equipo de proyecto <span class="text-danger">*</span></label>
                                {{Form::select('empleado_id',$array_empleados,null,['class'=>'select form-control','id' => 's_equipo_proyecto_create'])}}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Equipo Proyecto</label>
                                <div class="project-members" id="equipo_proyecto_create">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Descripción <span class="text-danger">*</span></label>
                        <textarea rows="4" name="descripcion" class="form-control summernote" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Archivo <span class="text-danger">*</span></label>
                        <input type="file" name="archivo" id="archivo" class="form-control" required>
                    </div>

                    <div class="row">
						<div class="col-sm-12">
							<div class="submit-section">
								<button class="btn btn-primary submit-btn" type="submit" id="btnGuardaProyectoCreate"><i class="fa fa-save"></i>	Guardar</button>
							</div>
						</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add User Modal -->
