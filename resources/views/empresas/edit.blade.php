<!-- Edit empresa Modal -->
<div id="edit_empresa{{ $empresa->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eidtar Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('empresas.update', $empresa->id) }}" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nombre Empresa <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name='nombre' value="{{$empresa->nombre}}" required>
                            </div>
                        </div>

						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Descripción</label>
                                <input class="form-control" type="text" name="descripcion" value="{{$empresa->descripcion}}">
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
<!-- /Edit empresa Modal -->
