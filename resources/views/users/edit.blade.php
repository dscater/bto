<!-- Edit User Modal -->
<div id="edit_user{{ $user->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Nombre(s) <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name='nombre' value="{{ $user->nombre }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Apellido Paterno <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="paterno" value="{{ $user->paterno }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Apellido Materno</label>
                                <input class="form-control" type="text" name="materno" value="{{ $user->materno }}">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>C.I. <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="ci" value="{{ $user->ci }}"
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
								],$user->ci_exp,['class'=>'select form-control','required'])}}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Direccción <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="dir" value="{{ $user->dir }}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="color:rgb(206, 10, 10);display:block" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Teléfono <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="fono" value="{{ $user->fono }}" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Celular <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="cel" value="{{ $user->cel }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tipo de Usuario <span class="text-danger">*</span></label>
								{{Form::select('tipo',
								[
									'' => 'Seleccione...',
									'ADMINISTRADOR' => 'ADMINISTRADOR',
									'AUXILIAR' => 'AUXILIAR',
								],$user->user->tipo,['class'=>'select form-control','required'])}}
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
<!-- /Edit User Modal -->
