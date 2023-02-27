<!-- Edit proyecto Modal -->
<div id="edit_proyecto{{ $proyecto->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('proyectos.update', $proyecto->id) }}" enctype="multipart/form-data" class="form_editar_proyecto">
                    {!! method_field('PUT') !!}
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nombre Proyecto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombre" value="{{$proyecto->nombre}}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Cliente <span class="text-danger">*</span></label>
                                {{Form::select('cliente_id',$array_clientes,$proyecto->cliente_id,['class'=>'select form-control', 'required'])}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de Inicio <span class="text-danger">*</span></label>
                                <input type="text" name="fecha_ini" value="{{date('d/m/Y',strtotime($proyecto->fecha_ini))}}" class="form-control datetimepicker" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de Finalización <span class="text-danger">*</span></label>
                                <input type="text" name="fecha_fin" value="{{date('d/m/Y',strtotime($proyecto->fecha_fin))}}" class="form-control datetimepicker" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tarifa <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="tarifa" value="{{$proyecto->tarifa}}" class="form-control" required>
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
                                ],$proyecto->prioridad,['class'=>'select form-control','required'])}}
                            </div>
                        </div>
                    </div>

                    <div class="row contenedor_lider_proyecto">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Elegir lider Proyecto <span class="text-danger">*</span></label>
                                {{Form::select('lider_proyecto',$array_empleados,$proyecto->lider_proyecto,['class'=>'select form-control s_lider_proyecto_edit','id' => 's_lider_proyecto_edit'.$proyecto->id,'required'])}}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Lider del Proyecto</label>
                                <div class="project-members lider_proyecto_edit" id="lider_proyecto_edit{{$proyecto->id}}">
                                    <a href="{{route('empleados.show',$proyecto->lider->id)}}" data-toggle="tooltip" title="" class="avatar empleado" data-original-title="{{$proyecto->lider->nombre}} {{$proyecto->lider->paterno}} {{$proyecto->lider->materno}}">
                                        <img src="{{asset('imgs/users/'.$proyecto->lider->user->foto)}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Equipo de proyecto <span class="text-danger">*</span></label>
                                {{Form::select('empleado_id',$array_empleados,null,['class'=>'select form-control s_equipo_proyecto_edit','id' => 's_equipo_proyecto_edit'.$proyecto->id])}}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Equipo Proyecto</label>
                                <div class="project-members equipo_proyecto_edit" id="equipo_proyecto_edit{{$proyecto->id}}">
                                    @foreach($proyecto->equipo as $equipo)
                                    <a href="{{route('empleados.show',$equipo->empleado->id)}}" data-toggle="tooltip" title="" class="avatar empleado existe" data-url="{{route('proyectos_equipos.destroy',$equipo->id)}}" data-original-title="{{$equipo->empleado->nombre}} {{$equipo->empleado->paterno}} {{$equipo->empleado->materno}}" id="create_{{$equipo->empleado->id}}">
                                        <img src="{{asset('imgs/users/'.$equipo->empleado->user->foto)}}" alt="">
                                        <span class="eliminar"><i class="fa fa-times"></i></span>
                                        <input type="hidden" name="empleado_equipo" value="{{$equipo->empleado->id}}" class="existe" readonly>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Descripción <span class="text-danger">*</span></label>
                        <textarea rows="4" name="descripcion" class="form-control summernote" required>{!!$proyecto->descripcion!!}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Archivo </label>
                        <input type="file" name="archivo" id="archivo" class="form-control">
                    </div>
					<div class="row btnActualizaProyectoEdit">
						<div class="col-md-12">
							<div class="submit-section">
								<button class="btn btn-primary submit-btn" id="btnActualizaProyectoEdit{{$proyecto->id}}"><i class="fa fa-spin"></i> Actualizar</button>
							</div>
						</div>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit proyecto Modal -->
