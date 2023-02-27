<!-- Edit cliente Modal -->
<div id="edit_cliente{{ $cliente->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Nombre(s) <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name='nombre' value="{{$cliente->nombre}}" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Apellidos <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="apellidos" value="{{$cliente->apellidos}}" required>
                            </div>
                        </div>

						<div class="col-sm-4">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" value="{{$cliente->email}}" requried>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>C.I. <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="ci" value="{{ $cliente->ci }}"
                                    required>
                                @if ($errors->has('ci'))
                                    <span class="invalid-feedback" style="color:rgb(206, 10, 10);display:block"
                                        role="alert">
                                        <strong>{{ $errors->first('ci') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Expedido <span class="text-danger">*</span></label>
								{{Form::select('ci_exp',
								[
									'' => 'Seleccione...',
									'LP' => 'LA PAZ',
									'CB' => 'COCHABAMBA',
									'SC' => 'SANTA CRUZ',
									'PT' => 'POTOSI',
									'OR' => 'ORURO',
									'CH' => 'CHUQUISACA',
									'TJ' => 'TARIJA',
									'BN' => 'BENI',
									'PD' => 'PANDO',
								],$cliente->ci_exp,['class'=>'select form-control','required'])}}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Direccción <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="dir" value="{{ $cliente->dir }}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Teléfono <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="fono" value="{{ $cliente->fono }}" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Celular <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="cel" value="{{ $cliente->cel }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Nombre Empresa <span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="{{$cliente->empresa}}" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="foto">
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
<!-- /Edit cliente Modal -->
