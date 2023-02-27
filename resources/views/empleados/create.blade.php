<!-- Add empleado Modal -->
<div id="add_empleado" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form data-toggle="validator" role="form" action="{{ route('empleados.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Nombre(s) <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name='nombre' value="{{old('nombre')}}" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Apellido Paterno <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="paterno" value="{{old('paterno')}}" required>
                            </div>
                        </div>

						<div class="col-sm-4">
                            <div class="form-group">
                                <label>Apellido Materno</label>
                                <input class="form-control" type="text" name="materno" value="{{old('materno')}}">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>C.I. <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="ci" value="{{old('ci')}}" required>
								@if ($errors->has('ci'))
								<span class="invalid-feedback" style="color:rgb(206, 10, 10);display:block" role="alert">
									<strong>{{ $errors->first('ci') }}</strong>
								</span>
								@endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Expedido <span class="text-danger">*</span></label>
								<select name="ci_exp" id="" class="select form-control" required>
									<option value="">Seleccione...</option>
									<option value="LP">LA PAZ</option>
									<option value="CB">COCHABAMBA</option>
									<option value="SC">SANTA CRUZ</option>
									<option value="PT">POTOSI</option>
									<option value="OR">ORURO</option>
									<option value="CH">CHUQUISACA</option>
									<option value="TJ">TARIJA</option>
									<option value="BN">BENI</option>
									<option value="PD">PANDO</option>
								</select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Direccción <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="dir" value="{{old('dir')}}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
								<input type="email" name="email" class="form-control" value="{{old('email')}}" required>
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
                                <input class="form-control" type="text" name="fono" value="{{old('fono')}}" required>
                            </div>
                        </div>
                      
						<div class="col-sm-4">
                            <div class="form-group">
                                <label>Celular <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="cel" value="{{old('cel')}}" required>
                            </div>
                        </div>

						<div class="col-sm-4">
                            <div class="form-group">
                                <label>Código de Empleado <span class="text-danger">*</span></label>
                                <input type="text" name="codigo_empleado" value="{{old('codigo_empleado')}}" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Fecha de Ingreso <span class="text-danger">*</span></label>
                                <input type="text" name="fecha_ingreso" value="{{old('fecha_ingreso')}}" class="form-control datetimepicker" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Empresa <span class="text-danger">*</span></label>
                                <select name="empresa_id" id="empresa_id" class="select form-control" required>
                                    <option value="">Seleccione...</option>
                                    @foreach($empresas as $value)
                                    <option value="{{$value->id}}">{{$value->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Departamento <span class="text-danger">*</span></label>
                                <select name="departamento_id" id="departamento_id" class="select form-control">
                                    <option value="">Seleccione...</option>
                                    @foreach($departamentos as $value)
                                    <option value="{{$value->id}}">{{$value->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Designación <span class="text-danger">*</span></label>
                                <select name="designacion_id" id="designacion_id" class="select form-control">
                                    <option value="">Seleccione...</option>
                                    @foreach($designacions as $value)
                                    <option value="{{$value->id}}">{{$value->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label>Foto <span class="text-danger">*</span></label>
							<input type="file" class="form-control" name="foto" required>
                        </div>

                        <div class="col-sm-4">
                            <label>Estado <span class="text-danger">*</span></label>
                            <select name="estado" id="estado" class="select form-control" required>
                                <option value="">Seleccione...</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
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
<!-- /Add empleado Modal -->
