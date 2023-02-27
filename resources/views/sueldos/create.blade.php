<!-- Add sueldo Modal -->
<div id="add_sueldo" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Sueldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form data-toggle="validator" role="form" action="{{ route('sueldos.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Empleado <span class="text-danger">*</span></label>
                                {{Form::select('empleado_id',$array_empleados,null,['class'=>'select form-control','required'])}}
                            </div>
                        </div>

						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Monto Sueldo <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" step="0.01" name="sueldo" value="{{old('sueldo')}}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo Moneda <span class="text-danger">*</span></label>
                                {{Form::select('moneda',[
                                    '' => 'Seleccione...',
                                    'BOLIVIANOS' => 'BOLIVIANOS',
                                    'DÓLARES' => 'DÓLARES',
                                ],null,['class'=>'select form-control','required'])}}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo de Pago <span class="text-danger">*</span></label>
                                {{Form::select('tipo_pago',[
                                    '' => 'Seleccione...',
                                    'DÍA' => 'DÍA',
                                    'HORA' => 'HORA',
                                ],null,['class'=>'select form-control','required'])}}
                            </div>
                        </div>

						<div class="col-sm-12">
							<div class="submit-section">
								<button class="btn btn-primary submit-btn" type="submit"><i class="fa fa-save"></i>	Guardar</button>
							</div>
						</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add sueldo Modal -->
