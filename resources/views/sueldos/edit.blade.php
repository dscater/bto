<!-- Edit sueldo Modal -->
<div id="edit_sueldo{{ $sueldo->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Sueldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('sueldos.update', $sueldo->id) }}" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Empleado <span class="text-danger">*</span></label>
                                {{Form::select('empleado_id',$array_empleados,$sueldo->empleado_id,['class'=>'select form-control','required'])}}
                            </div>
                        </div>

						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Monto Sueldo <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" step="0.01" name="sueldo" value="{{$sueldo->sueldo}}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo Moneda <span class="text-danger">*</span></label>
                                {{Form::select('moneda',[
                                    '' => 'Seleccione...',
                                    'BOLIVIANOS' => 'BOLIVIANOS',
                                    'DÓLARES' => 'DÓLARES',
                                ],$sueldo->moneda,['class'=>'select form-control','required'])}}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo de Pago <span class="text-danger">*</span></label>
                                {{Form::select('tipo_pago',[
                                    '' => 'Seleccione...',
                                    'DÍA' => 'DÍA',
                                    'HORA' => 'HORA',
                                ],$sueldo->tipo_pago,['class'=>'select form-control','required'])}}
                            </div>
                        </div>
                    </div>
					<div class="row">
						<div class="col-md-12">
							<div class="submit-section">
								<button class="btn btn-primary submit-btn"><i class="fa fa-spin"></i> Actualizar</button>
							</div>
						</div>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit sueldo Modal -->
